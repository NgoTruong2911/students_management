@extends('master.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                placeholder="Enter name">
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="dateofbirth">Birthday</label>
            <input type="date" class="form-control birthday" value="{{ old('birthday') }}" id="dateofbirth"
                name="birthday">
            @error('birthday')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input type="text" class="form-control" id="phone_number" value="{{ old('phone_number') }}"
                name="phone_number">
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
        <div class="form-group">
            <label for="faculty_id">Faculty name</label>
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
            <a class="btn btn-primary  mb-3 mt-3" data-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                Role
            </a>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    @foreach($roles as $role =>$val)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="roles[]" id="inlineRadio1"
                            value="{{$role}}" }}>
                        <label class="form-check-label" for="inlineRadio1">{{$val}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" value="{{old('password')}}"
                placeholder="Enter Password">
        </div>
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="password">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                value="{{old('password')}}" placeholder="Enter Password">
        </div>
        @error('password_confirmation')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <!-- /.content -->
</div>
@endsection
<script>
</script>
