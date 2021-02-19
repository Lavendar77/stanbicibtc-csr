@extends('layouts.student')

@section('student-content')
@if ($students && $students->count())
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="15%">S/N</th>
                    <th>Name</th>
                    <th>Email</th>
                    @if (Auth::user()->hasRole('program coordinator'))
                    <th>Applied</th>
                    @endif
                    @if (Auth::user()->hasRole('admin'))
                    <th>No of programs</th>
                    @endif
                    <th>Date Created</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    @if (Auth::user()->hasRole('program coordinator'))
                    <td class="font-weight-bold">
                        {{
                            $student->programs
                                ->filter(fn ($program) => $program->id == Auth::user()->program->id)
                                ->first()
                                ->pivot
                                ->applied ? 'YES' : 'NO'
                        }}
                    </td>
                    @endif
                    @if (Auth::user()->hasRole('admin'))
                    <td>{{ $student->programs()->count() }}</td>
                    @endif
                    <td>{{ $student->created_at->format('d F, Y') }}</td>
                    <td>
                        <a href="{{ route('students.edit', [
                            'student' => $student->id
                        ]) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                    <td>
                        <form
                            action="{{ route('students.destroy', [
                                'student' => $student->id
                            ]) }}"
                            method="post"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $students->links() }}
    </div>
@else
    <div class="alert alert-info">
        No students found!
    </div>
@endif
@endsection
