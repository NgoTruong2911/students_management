@extends('master.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="form-group">
            <label for="name"> Name </label>
            <p>{{$faculty->name}}</p>
        </div>
        <div class="form-group">
            <label for="description"> Description </label>
            <p>{{$faculty->description}}</p>
        </div>
        <button type="button" class="btn btn-warning"><a href="{{route('faculties.index')}}">Back</a></button>
    </div>
@endsection
<script>
</script>
