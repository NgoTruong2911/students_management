@extends('master.layout')
@section('content')
<div class="content-wrapper">
<div class="container">

    <!-- Content Header (Page header) -->
    <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name<a class="text-danger">*</a></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                placeholder="Enter name">
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="dateofbirth">Birthday<a class="text-danger">*</a></label>
            <input type="date" class="form-control birthday" value="{{ old('birthday') }}" id="dateofbirth"
                name="birthday">
            @error('birthday')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Phone number<a class="text-danger">*</a></label>
            <input type="text" class="form-control" id="phone_number" value="{{ old('phone_number') }}"
                name="phone_number">
            @error('phone_number')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email<a class="text-danger">*</a></label>
            <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email">
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="faculty_id">Faculty name<a class="text-danger">*</a></label>
            <select class="form-control" name="faculty_id" id="faculty_id">
                @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}" }}>
                    {{ $faculty->name }}
                </option>
                @endforeach
            </select>
            @error('faculty_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="gender">Gender : <a class="text-danger">*</a></label>
            <input type="radio" name="gender" value="1">Female
            <input type="radio" name="gender" value="2">Male
            @error('gender')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="avatar">Avatar<a class="text-danger">*</a></label>
            <input type="file" id="avatar" name="avatar">
        </div>
        @error('avatar')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="form-group">
            <label for="roles">Roles :<a class="text-danger">*</a> </label>
            @foreach($roles as $role =>$val)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="roles[]" id="inlineRadio1" value="{{$role}}">
                <label class="form-check-label" for="inlineRadio">{{$val}}</label>
              </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="password">Password<a class="text-danger">*</a></label>
            <input type="password" name="password" class="form-control" id="password" value="{{old('password')}}"
                placeholder="Enter Password">
        </div>
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="password">Confirm Password<a class="text-danger">( * )</a></label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                value="{{old('password')}}" placeholder="Enter Password">
        </div>
        @error('password_confirmation')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="subject_id">Subject</label>
              <select class="form-control" name="subject_id" id="subject_id">
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" }}>
                    {{ $subject->name }}
                </option>
                @endforeach
            </select>
            </div>
            <div class="form-group col-md-6">
              <label for="point">Point</label>
              <input type="number" class="form-control" id="point" placeholder="point">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <!-- /.content -->
</div>
</div>
@endsection
<script>
</script>
