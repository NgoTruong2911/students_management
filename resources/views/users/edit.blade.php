@extends('master.layout')
<div class="container">
    @section('content')

    <div>
</div>
<div class="content-wrapper">

    <div class="container">
        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        @if(!empty($user->id))
        <form action="{{ route('users.update',[$user->id]) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            @else
            <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @endif
                <input type="hidden" name="id" value="{{$user->id}}">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name',$user->name) }}" id="name" name="name" placeholder="Enter name">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="dateofbirth">Birthday</label>
                    <input type="date" class="form-control birthday" value="{{ old('birthday',$user->birthday) }}"
                        id="dateofbirth" name="birthday">
                    @error('birthday')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone number</label>
                    <input type="text" class="form-control" value="{{ old('phone_number',$user->phone_number) }}"
                        id="phone_number" name="phone_number">
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
                <div>
                    <div class="form-group">
                        <label for="faculty_id">Faculty name</label>
                        <select class="form-control" name="faculty_id" id="faculty_id">
                            @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}"
                                {{ $user->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @if(empty($user->id)||$user->gender==null)
                <div class="form-group">
                    <label for="gender">Gender : </label>
                    <input type="radio" name="gender" value="1">Female
                    <input type="radio" name="gender" value="2">Male
                    @error('gender')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                @else
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
                    @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endif

                @if(empty( $user->id ))
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                        value="{{old('password')}}" placeholder="Enter Password">
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
                @endif
                {{-- {{dd($user->password)}} --}}
                @if(!empty( $user->id ))
                @if((!empty ( $user->password ) && Auth::user()->hasRole('user')) || ( Auth::user()->hasRole('admin') &&
                Auth::user()->id == $user->id && !empty ( Auth::user()->password )))
                <div class="form-group">
                    <label for="current_password">Old Password</label>
                    <input type="password" name="current_password" class="form-control" id="current_password"
                        value="{{old('current_password')}}" placeholder="Enter your Password">
                </div>
                @endif
                @error('current_password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control" id="password_confirmation"
                        value="{{old('password')}}" placeholder="Enter new Password">
                </div>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                        value="{{old('password_confirmation')}}" placeholder="Enter confirm new Password">
                </div>
                @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @endif

                <div class="form-group">
                    <label for="avatar">Avatar : </label>
                    <input type="file" id="avatar" class=" form-control @error('avatar') is-invalid @enderror" name="avatar">
                    @if(!empty($user->id))
                    <img src="{{asset ( $user->avatar ) }}" class="rounded-lg ml-2" alt="avatar" width="100px"
                        height="100px">
                    @endif
                </div>
                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if(empty($user->id) )
                <div class="form-group">
                    <a class="btn btn-primary  mb-3 mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Role
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            @foreach($roles as $role =>$val)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="roles[]" id="inlineRadio1" value="{{$role}}" }}>
                                    <label class="form-check-label" for="inlineRadio1">{{$val}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                <br/>
                @elseif( empty($userRole) || empty($roles))
                @else
                <a class="btn btn-primary mb-3 mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Role
                </a>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        @foreach($roles as $role =>$val)
                        @foreach ($userRole as $rl)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="roles[]" id="inlineRadio" value="{{ $role }}" {{ $rl->id == $role ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio">{{$val}}</label>
                            </div>
                        @endforeach
                        @endforeach
                    </div>
                </div>
            <br/>
                @endif
                @error('roles')
                <div class="text-danger"> {{$message}} </div>
                @enderror

                <button type="submit" class="btn btn-primary ">Submit</button>
            </form>
            {{-- {{ json_encode($errors->all()) }} --}}
            {{-- Update Point --}}
            @if(!empty($user->id))

            @foreach ($errors->all() as $error)
            <div class="text-danger">{{ $error }}</div>
            @endforeach

            @endif
            <div class="row">
                @if(!empty($user->id))
                <form class="col mt-4" action="{{ route('users.createPoint',[$user->id]) }}" method="POST">
                    @csrf
                    <div class="list-edit-subjects">
                        @if(empty(old()['subject_point']) && Auth::user()->hasRole('admin'))
                        @foreach ($user_subjects as $user_subject)
                        <div class="form-group">
                            <ul class="list-group w-45">
                                <li class="remove_input"><label for="point">{{$user_subject->name}}</label></li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center remove_input">
                                    <input type="number"
                                        name="subject_point[{{ $user_subject->pivot->subject_id }}][point]"
                                        value="{{ old('subject_point.'. $user_subject->pivot->subject_id . '.point', $user_subject->pivot->point) }}"
                                        data-subject_id="{{$user_subject->pivot->subject_id}}"
                                        data-subject_name="{{$user_subject->name}}"
                                        class="form-control mt-4 remove_input ">
                                    <input type="hidden" value="{{$user_subject->name}}" name="subject_name_hidden[]">
                                    <input type="hidden" value="{{$user_subject->pivot->subject_id}}"
                                        name="subject_id[]">
                                    <input type="hidden" value="{{$user_subject->pivot->point}}" name="point[]">
                                    <button class="remove btn btn-link "><span class="badge badge-primary badge-pill"><i
                                                class="fa fa-times" aria-hidden="true"></i></span></button>
                                </li>
                            </ul>
                        </div>
                        @endforeach
                        @elseif(!empty(old()['subject_point']) && Auth::user()->hasRole('admin'))
                        {{-- {{dd(old())}} --}}
                        @for ($i = 0; $i < count(old()['subject_id']); $i++) @php
                            $old_subject_id=old()['subject_id'][$i]; $old_point=old()['point'][$i];
                            $old_subject_name=old()['subject_name_hidden'][$i]; @endphp <div class="form-group">
                            <ul class="list-group w-45">
                                <li class="remove_input"><label for="point">{{ $old_subject_name }}</label>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center remove_input">
                                    <input type="number" name="subject_point[{{strval( $old_subject_id )}}][point]"
                                        value="{{ old('subject_point.'. strval($old_subject_id) . '.point', strval($old_point)) }}"
                                        data-subject_id={{strval($old_subject_id)}}
                                        data-subject_name="{{$old_subject_name}}"
                                        class="form-control mt-4 remove_input">
                                    <input type="hidden" value="{{$old_subject_name}}" name="subject_name_hidden[]">
                                    <input type="hidden" value="{{strval($old_subject_id)}}" name="subject_id[]">
                                    <input type="hidden" value="{{strval($old_point)}}" name="point[]">
                                    <button class="remove btn btn-link "><span class="badge badge-primary badge-pill"><i
                                                class="fa fa-times" aria-hidden="true"></i></span></button>
                                </li>
                    </div>
                    @endfor

                    @endif
            </div>
            @error('points')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Update Point</button>
        </form>
        <div class="w-50 ml-5">
            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button"
                    aria-expanded="false" aria-controls="multiCollapseExample1">Các môn đã học</a>
                <button class="btn btn-primary" type="button" data-toggle="collapse"
                    data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Các
                    môn chưa học</button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse"
                    aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Đóng
                    elements</button>
            </p>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body">
                            <div class="learned_subject col mt-4">
                                <ul class="list-group">
                                    @foreach ($user_subjects as $user_subject)
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        value="{{ $user_subject->id }}">
                                        {{ $user_subject->name }}
                                        <span
                                            class="badge badge-primary badge-pill">{{$user_subject->pivot->point}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <div class="card card-body">
                            <div class="subject-list">
                                @if(Auth::user()->hasRole('admin'))
                                <ul>
                                    @if(isset(old()['subject_id']))
                                        @php
                                        $subject_id = [];
                                        // dd(old());
                                        foreach ($subjects as $subject) {
                                        $subject_id[] = $subject->id;
                                        }
                                        $result_diff = array_diff($subject_id,old()['subject_id']);
                                        // dd($result_diff);
                                        @endphp
                                    @foreach ( $subjects as $subject )
                                    <li class="subject"
                                        value="{{ in_array($subject->id,$result_diff) ? $subject->id : '' }}"
                                        {{ in_array($subject->id,$result_diff) ?  : " style = display:none; " }}>
                                        <input type="checkbox">
                                        {{ $subject->name }}
                                    </li>
                                    @endforeach
                                    {{-- no bug here --}}
                                    {{-- {{var_dump($user_subjects)}} --}}
                                    @foreach ( $user_subjects as $user_subject )
                                    <li class="subject"
                                        value="{{ in_array($user_subject->pivot->subject_id,old()['subject_id']) ? '' : $user_subject->pivot->subject_id }}"
                                        {{ in_array($user_subject->pivot->subject_id,old()['subject_id']) ? " style = display:none; " : '' }}>
                                        <input type="checkbox">
                                        {{ $user_subject->name }}
                                    </li>
                                    @endforeach
                                    {{-- bug here --}}
                                    @else
                                    @foreach ($subjects as $subject)
                                    <li class="subject" value="{{ $subject->id }}"><input type="checkbox">
                                        {{ $subject->name }}
                                    </li>
                                    @endforeach
                                    {{-- no bug here --}}
                                    @endif
                                </ul>
                                @else
                                <ul>
                                    @foreach ($subjects as $subject)
                                    <li class="subject" value="{{ $subject->id }}"><input type="checkbox">
                                        {{ $subject->name }}
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- endnew --}}

        @endif
    </div>
</div>
<!-- /.content -->
</div>
@endsection
{{-- {{dd(old())}} --}}
@if(Auth::user()->hasRole('admin'))
@section('script')
<script src="{{asset('js/users/edit-admin.js')}}"></script>
@endsection
@else
@section('script')
<script src="{{asset('js/users/edit-user.js')}}"></script>
@endsection
@endif
</div>
