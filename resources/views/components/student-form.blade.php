<form
    action="{{ $action == 'post' ? route('students.store') : route('students.update', [
        'student' => $user->id
    ]) }}"
    method="post"
>
    @csrf
    @method($action)

    <div class="form-group">
        <label for="name">Name</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Full name"
            value="{{ $user->name ?? '' }}"
            required
        >
        @error('name')
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

    <input type="submit" value="Update" class="btn btn-success">
</form>
