<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyToProgramRequest;
use App\Models\Program;
use App\Models\ProgramUser;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Apply to the specified program.
     *
     * @param ApplyToProgramRequest $request
     * @param Program $program
     * @return \Illuminate\Http\Response
     */
    public function apply(ApplyToProgramRequest $request, Program $program)
    {
        // Alter the 'applied' attribute of the ProgramUser
        ProgramUser::whereUserId($request->user()->id)
            ->whereProgramId($program->id)
            ->update([
                'applied' => true
            ]);

        $request->session()->flash('status', 'You have applied to the program successfully!');

        return redirect()->route('home');
    }
}
