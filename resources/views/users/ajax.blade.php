<form id="update_user" enctype='multipart/form-data'>
    {{-- <input type="hidden" name="_method" value="PUT"> --}}

    @method('PUT')
    <div class="modal-body">
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
        <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name" placeholder="Enter name">
        </div>

        <div class="form-group">
            <label for="birthday">Birthday</label>
        <input type="date" class="form-control" value="{{$user->birthday}}" id="birthday" name="birthday">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input type="text" class="form-control" value="{{$user->phone_number}}" id="phone_number" name="phone_number">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" value="{{$user->email}}" id="email" name="email">
        </div>
        <div>
            <label for="faculty_id">Faculty name</label>
            <select class="form-control" name="faculty_id" id="faculty_id">
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}"
                        {{ $user->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="gender">Gender : </label>
            @if($user->gender==1)
                    <label class="checkbox-inline"><input type="radio" name="gender" checked value="1">Female</label>
                    <label class="checkbox-inline"><input type="radio" name="gender" value="2">Male</label>
            @endif
            @if($user->gender==2)
                    <label class="checkbox-inline"><input type="radio" name="gender" value="1">Female</label>
                    <label class="checkbox-inline"><input type="radio" name="gender" checked value="2">Male</label>
            @endif
        </div>
        {{-- {{dd($user->id)}} --}}
        @if( (!empty ( $user->password ) && Auth::user()->hasRole('user')) || ( Auth::user()->hasRole('admin') &&
        Auth::user()->id == $user->id && !empty ( Auth::user()->password )) )
        <div class="form-group">
            <label for="current_password">Current password : </label>
            <input type="password" name="current_password" class="form-control" id="current_password"
        placeholder="Enter your Password">
        </div>
        @endif
        <div class="form-group">
            <label for="password">Password : </label>
            <input type="password" name="password" class="form-control" id="password"
    placeholder="Enter your new Password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password : </label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
    placeholder="Enter your confirm new Password">
        </div>
        <div class="form-group">
            <label for="avatar">Avatar : </label>
            <input type="file" id="avatar" name="avatar">
            <img src="{{asset( $user->avatar )}}" class="rounded-lg ml-2 avatar" alt="avatar" width="100px" height="100px">
        </div>
        <input type="hidden" value="{{$user->id}}" name="id">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-update">Save changes</button>
    </div>
</form>
