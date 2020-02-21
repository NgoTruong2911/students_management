@extends('master.layout')
@section('content')
<div class="content-wrapper">
    <div class="container">
        <section class="content-header">
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
        <div class="col-md-10 offset-md-1">

            <!-- Profile Image -->
            <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle mt-5" src={{$user->avatar}} alt="User profile picture">

            <h3 class="profile-username text-center">{{$user->name}}</h3>

            <p class="text-muted text-center">{{$user->email}}</p>
            </div>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if($user->faculty)
                <strong><i class="fa fa-book margin-r-5"></i> Faculty: </strong>

                <p class="text-muted">
                    {{$user->faculty->name}}
                </p>
                @endif
                @if($user->phone_number)
                <strong><i class="fa fa-book margin-r-5"></i> Phone: </strong>

                <p class="text-muted">
                    {{$user->phone_number}}
                </p>
                @endif
                <strong><i class="fa fa-book margin-r-5"></i> Email: </strong>

                <p class="text-muted">
                    {{$user->email}}
                </p>

                <hr>
                @if($user->birthday)
                <strong><i class="fa fa-map-marker margin-r-5"></i> Birthday</strong>

                    <p class="text-muted">{{$user->birthday}}</p>
                @endif
            </div>
            <!-- /.box-body -->
            </div>
        <a href="{{route('users.edit',[$user->id])}}" class="btn btn-primary btn-block"><b>Update</b></a>
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
        </div>
        <!-- /.row -->

        </section>
    </div>
</div>
@endsection
