@csrf

<div class="mb-3">
    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $user->name ?? old('name') }}">
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email ?? old('email') }}">

    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

@if(request()->is('users/create'))
<div class="mb-3">
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
</div>
@error('password')
    <small class="text-danger">{{ $message }}</small>
@enderror
@endif

<div class="mb-3">
    <select class="form-select" aria-label="Default select example" name="role" id="role">
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @if($user->role->id == $role->id) selected @endif >{{ $role->name }}</option>
        @endforeach
    </select>
    @error('role')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<button class="btn btn-primary w-100">Submit</button>
