<div class="row">
    <div class="col-md-4">
        <img src="{{ $user->profile_picture }}" alt="photo" class="img-fluid img-thumbnail">

        <hr>

        <form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="profile_picture">Change photo</label>
                <input
                    type="file"
                    name="profile_picture"
                    id="profile_picture"
                    accept="image/*"
                    class="form-control @error('profile_picture') is-invalid @enderror"
                    required
                >
                @error('profile_picture')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <input type="submit" value="Update Photo" class="btn btn-success">
        </form>
    </div>
    <div class="col-md-8">
        <form action="{{ route('update-profile') }}" method="post">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Full name"
                    value="{{ $user->name }}"
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
                    value="{{ $user->email }}"
                    required
                >
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <input type="submit" value="Update" class="btn btn-success">
        </form>
    </div>
</div>
