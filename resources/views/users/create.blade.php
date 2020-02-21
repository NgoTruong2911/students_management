@extends('master.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">
    @error('name')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <div class="form-group">
        <label for="birthday">Birthday</label>
        <input type="date" class="form-control" id="birthday" value="{{ old('birthday') }}" name="birthday">
    @error('birthday')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <div class="form-group">
        <label for="phone_number">Phone number</label>
        <input type="text" class="form-control" id="phone_number" value="{{ old('phone_number') }}" name="phone_number">
    @error('phone_number')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email">
    @error('email')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <div>
        <label for="faculty_id">Faculty name</label>
            <input list="{{ $faculties }}" name="faculty_id">
            <datalist id="{{ $faculties }}">
                @foreach( $faculties as $faculty )
                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                @endforeach
        </datalist>
    @error('faculty_id')
                <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <div class="form-group">
        <label for="gender">Gender : </label>
        <input type="radio" name="gender" value="1">Female
        <input type="radio" name="gender" value="2">Male
    @error('gender')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <input type="file" id="avatar" name="avatar">
    </div>
    @error('avatar')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" value{{old('password')}} placeholder="Enter Password">
    </div>
    @error('password')
        <p class="text-danger">{{ $message }}</p>
    @enderror
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <!-- /.content -->
</div>
@endsection
<script>
</script>
