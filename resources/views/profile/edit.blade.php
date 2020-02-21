@extends('master.layout')
<div class="container">
    @section('content')
        <div>

            {{-- @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach --}}

        </div>
        <div class="content-wrapper">
            <div class="container">
                <h1>Edit Profile</h1>
                  <hr>
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-3">
                    <div class="text-center">
                    <img src="{{$user->avatar}}" class="avatar img-circle img-responsive w-25" alt="avatar">
                      <h6>Upload a different photo...</h6>

                      <input type="file" name="avatar" class="form-control">
                    </div>
                  </div>

                  <!-- edit form column -->
                  <div class="col-md-9 personal-info">
                    <div class="alert alert-info alert-dismissable">
                      <a class="panel-close close" data-dismiss="alert">×</a>
                      <i class="fa fa-coffee"></i>
                      Please <strong> enter</strong> Your information</div>
                    <h3>Personal info</h3>
                        <div class="form-group">
                            <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name',$user->name) }}" id="name" name="name"
                                   placeholder="Enter name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                        </div>
                      <div class="form-group">
                            <label for="dateofbirth">Birthday</label>
                                <input type="date" class="form-control birthday"
                                           value="{{ old('birthday',$user->birthday) }}" id="dateofbirth"
                                           name="birthday">
                                    @error('birthday')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone number</label>
                            <input type="text" class="form-control"
                                   value="{{ old('phone_number',$user->phone_number) }}" id="phone_number"
                                   name="phone_number">
                            @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email',$user->email) }}" id="email" name="email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                                        <label for="faculty_id">Faculty name</label>
                                        <select class="form-control" name="faculty_id" id="faculty_id">
                                            @foreach($faculties as $faculty)
                                                <option
                                                    value="{{ $faculty->id }}" {{ $user->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('faculty_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender : </label>
                            @if($user->gender==1)
                                <label class="checkbox-inline"><input type="radio" name="gender" checked
                                                                      value="1">Female</label>
                                <label class="checkbox-inline"><input type="radio" name="gender" value="2">Male</label>
                            @endif
                            @if($user->gender==2)
                                <label class="checkbox-inline"><input type="radio" name="gender" value="1">Female</label>
                                <label class="checkbox-inline"><input type="radio" name="gender" checked
                                                                      value="2">Male</label>
                            @endif
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(!empty(Auth::User()->password))
                        <div class="form-group">
                            <label>Old Password:</label>
                              <input class="form-control" name="old_password" type="password" value="11111122333">
                          </div>
                          <div class="form-group">
                            <label >New password:</label>
                              <input class="form-control" name="password" type="password" value="11111122333">
                          </div>
                          <div class="form-group">
                            <label >Confirm password:</label>
                              <input class="form-control" name="password_confirmation" type="password" value="11111122333">
                          </div>
                        @endif
                      <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div>
                          <button type="button" class="btn btn-primary">Save Changes</button>
                          <span></span>
                          <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
            </div>
            <hr>
            <!-- /.content -->

        </div>
    @endsection
    @section('script')
    @endsection
</div>

