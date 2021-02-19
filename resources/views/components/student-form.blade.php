<form
    action="{{ $action == 'post' ? route('students.store') : route('students.update', [
        'student' => $user->id
    ]) }}"
    method="post"
>
    @csrf
    @method($action)

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input
            type="text"
            name="first_name"
            id="first_name"
            class="form-control @error('first_name') is-invalid @enderror"
            placeholder="First name"
            value="{{ $user->first_name ?? '' }}"
            required
        >
        @error('first_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input
            type="text"
            name="last_name"
            id="last_name"
            class="form-control @error('last_name') is-invalid @enderror"
            placeholder="Last name"
            value="{{ $user->last_name ?? '' }}"
            required
        >
        @error('last_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input
            type="email"
            name="email"
            id="email"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="Email address"
            value="{{ $user->email ?? '' }}"
            required
        >
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <input type="submit" value="{{ $user ? 'Update' : 'Create' }} Student" class="btn btn-success">
</form>
