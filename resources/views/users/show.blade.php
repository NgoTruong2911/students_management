@extends('master.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <form action="{{route('users.update',[$user->id])}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name : </label>
                {{$user->name}}
            </div>
            <div class="form-group">
                <label for="birthday">Birthday : </label>
                {{$user->birthday}}
            </div>
            <div class="form-group">
                <label for="phone_number">Phone number : </label>
                {{$user->email}}
            </div>
            <div class="form-group">
                <label for="email">Email : </label>
                {{$user->email}}
            </div>
            <div>
                <label for="faculty_id">Faculty name : </label>
                @if(!empty($user->faculty))
                    {{$user->faculty->name}}
                @endif
            </div>
            <div class="form-group">
                <label for="gender">Gender : </label>
                <p>{{$user->gender==2?'Female':'Male'}}</p>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar : </label>
                <img src="{{asset($user->avatar)}}" alt="avatar" width="100px" height="100px">
            </div>
            <button type="button" class="btn btn-warning"><a href="{{route('users.index')}}">Back</a></button>
        </form>
        <!-- /.content -->
    </div>
@endsection
<script>
</script>
