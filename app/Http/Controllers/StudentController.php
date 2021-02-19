<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use App\Notifications\WelcomeUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $students = User::role(UserRole::STUDENT)->with(['programs']);

        // Get all students for UserRole::ADMIN
        if ($user->hasRole(UserRole::ADMIN)) {
            $students = $students->paginate();
        } else {
            // Get users for program for UserRole::PROGRAMCOORDINATOR
            $students = $students->whereHas('programs', function (Builder $query) use ($user) {
                $query->where('program_id', $user->program->id);
            })->paginate();
        }

        return view('students.index', [
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        DB::beginTransaction();

        $password = Str::random(8);

        // Create the user account if not exist
        if (!$student = User::where('email', $request->email)->first()) {
            $student = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($password)
            ]);
        };

        // Notify the student of new password
        $student->notify(new WelcomeUser($password));

        // Give student role
        $student->assignRole(UserRole::STUDENT);

        // Attach student to program
        $student->programs()->attach($request->user()->program);

        DB::commit();

        $request->session()->flash('status', 'Student created successfully!');

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $student
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        return view('students.edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStudentRequest $request
     * @param User $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, User $student)
    {
        $student->update([
            'first_name' => $request->first_name ?? $student->first_name,
            'last_name' => $request->last_name ?? $student->last_name,
            'email' => $request->email ?? $student->email,
        ]);

        // Regenerate password and welcome new 'email' if it was changed
        if ($student->wasChanged('email')) {
            $password = Str::random(8);
            $student->password = Hash::make($password);
            $student->save();

            $student->notify(new WelcomeUser($password));
        }

        $request->session()->flash('status', 'Student updated successfully!');

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param User $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $student)
    {
        $user = $request->user();
        $status = 'deleted';

        // Delete user completely for UserRole::PROGRAMCOORDINATOR
        if ($user->hasRole(UserRole::ADMIN)) {
            $student->delete();
        } else {
            // Detach student from program if initiated by UserRole::PROGRAMCOORDINATOR
            $student->programs()->detach($request->user()->program);
            $status = 'removed from program';
        }

        $request->session()->flash('status', "Student {$status} successfully!");

        return redirect()->route('students.index');
    }
}
