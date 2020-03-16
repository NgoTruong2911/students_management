@extends('master.layout')
@section('content')


{{ \Request::get('point_min')}}
<div class="content-wrapper">
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <!-- Content Header (Page header) -->
    <div class="container">
        <form id="index-form" action="{{route('users.index')}}" method="GET" role="search">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="point_number_form">Point min</label>
                    <input type="number" step="0.01" class="form-control" id="point_number_from" name="point_min"
                        value="{{ old('point_min') }}" placeholder="Point from ">
                </div>
                <div class="form-group col-md-6">
                    <label for="point_number_to">Point max</label>
                    <input type="number" step="0.01" class="form-control" value="{{old('point_max')}}"
                        id="point_number_to" name="point_max" placeholder="Point at ">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="age_form">Age Min</label>
                    <input type="number" class="form-control" min="0" step="1" id="age_form" value="{{old('age_min')}}"
                        name="age_min" placeholder="Age from ">
                </div>
                <div class="form-group col-md-6">
                    <label for="age_to">Age Max</label>
                    <input type="number" class="form-control" min="0" step="1" id="age_to" value="{{old('age_max')}}"
                        name="age_max" placeholder="Age to">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Phone number : </label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="phone_number[]" @if(is_array(old('phone_number')) &&
                        in_array('^0{1}([3]{1}[2-9]{1}|[9]{1}[6-8]{1})[0-9]{7}$', old('phone_number'))) checked @endif
                        type="checkbox" id="inlineCheckbox1" value="^0{1}([3]{1}[2-9]{1}|[9]{1}[6-8]{1})[0-9]{7}$">
                    <label class="form-check-label" for="inlineCheckbox1">Viettel</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="phone_number[]" @if(is_array(old('phone_number')) &&
                        in_array('^0{1}([9]{1}[1,4]{1}|[8]{1}[8]{1}|[8]{1}[1-5]{1})[0-9]{7}$', old('phone_number')))
                        checked @endif type="checkbox" id="inlineCheckbox2"
                        value="^0{1}([9]{1}[1,4]{1}|[8]{1}[8]{1}|[8]{1}[1-5]{1})[0-9]{7}$">
                    <label class="form-check-label" for="inlineCheckbox2">Vinaphone</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="phone_number[]" @if(is_array(old('phone_number')) &&
                        in_array('^0{1}([9]{1}[0,3]{1}|[7]{1}[0,1,2,6,8,9,7]{1})[0-9]{7}$', old('phone_number')))
                        checked @endif type="checkbox" id="inlineCheckbox3"
                        value="^0{1}([9]{1}[0,3]{1}|[7]{1}[0,1,2,6,8,9,7]{1})[0-9]{7}$">
                    <label class="form-check-label" for="inlineCheckbox3">Mobiphone</label>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Điểm :</label>
                <select class="form-control" name="filter_point" id="exampleFormControlSelect1">
                    <option value="">Tất cả</option>
                    <option @if(old('filter_point') && old('filter_point')==1) selected="selected" @endif value="1">Đã
                        hoàn thành</option>
                    <option @if(old('filter_point') && old('filter_point')==2) selected="selected" @endif value="2">Còn
                        nợ môn</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <div class="form-group mt-4" style="width:15%">
        <form id="index-form">
            <select id="paginate" name="paginate" class="form-control">
                <option value="15" @if($paginate==15) selected @endif>Default</option>
                <option value="50" @if($paginate==50) selected @endif>50</option>
                <option value="100" @if($paginate==100) selected @endif>100</option>
                <option value="200" @if($paginate==200) selected @endif>200</option>
            </select>
        </form>
    </div>
    <div class="mt-4">{{ $users->links() }}</div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Stt</th>
                <th scope="col">Name</th>
                <th scope="col">Birthday</th>
                <th scope="col">Phone number</th>
                <th scope="col">Email</th>
                <th scope="col">Avatar</th>
                <th scope="col">Gender</th>
                <th scope="col">Age</th>
                <th scope="col">Role</th>
                @if(Auth::user()->hasPermissionTo('users-create'))
                <th scope="col"><a href="{{ route('users.create') }}" class="btn btn-success">Add +</a></th>
                @endif
                @if(Auth::user()->hasRole('admin'))
                <th scope="col"><a href="{{ route('users.sendEmail') }}" class="btn btn-success">Send email</a></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach( $users as $key => $user )
            <tr id="user-update-{{ $user->id }}">
                <td>{{ $key+1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->birthday }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->email }}</td>
                <td><img src="{{ asset($user->avatar) }}" alt="image" height="50" width="50"></td>
                <td>{{ $user->gender==2?'Male':'Female' }}</td>
                <td>
                    @if(!empty($user->birthday))
                    {{ \Carbon\Carbon::parse($user->birthday)->age }}
                    @else
                    {{ 0 }}
                    @endif
                </td>
                <td>
                    @foreach($user->rolesName as $role)
                    <a>{{$role->name}}</a>
                    @endforeach
                </td>
                @if(Auth::user()->hasPermissionTo('users-update'))
                <td><a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-primary">Update</a></td>
                @endif
                @if((Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('user') && Auth::user()->id == $user->id
                ) )
                <td>
                    <button type="button" class="btn btn-primary edit-modal" data-user-id="{{ $user->id }}"
                        data-toggle="modal" data-target="#exampleModal">Update ajax
                    </button>
                </td>
                @endif
                <td><a href="{{ route('users.show',[$user->slug]) }}" class="btn btn-primary">Show</a></td>
                @if(Auth::user()->hasAnyPermission(['users-delete','users-show']))
                <td>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" class="remove" type="submit">Delete</button>
                    </form>
                </td>
                @else
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                {{-- form ajax here --}}
                {{-- end-form-ajax-here --}}
            </div>
        </div>
    </div>
    <div>
        <p>Showing {{$users->firstItem()}} to {{$users->lastItem()}} of {{$users->total()}} </p>
    </div>
    <div>{{ $users->links() }}</div>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script src="{{asset('js/users/index.js')}}"></script>
<script>
    document.getElementById('paginate').onchange = function() {
    window.location = "{!!$users->url(1)!!}&paginate=" + this.value;
    console.log(this.value);
 }
</script>
@endsection
