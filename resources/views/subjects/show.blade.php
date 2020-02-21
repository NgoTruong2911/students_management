@extends('master.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="form-group">
            <div class="row">
                <label for="name"> Name : </label>
                <p>{{ $subject->name }}</p>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="description"> Description : </label>
                <p>{{ $subject->description }}}</p>
            </div>
        </div>
        <button type="button" class="btn btn-warning"><a href="{{route('subjects.index')}}">Back</a></button>
    </div>
@endsection
<script>
</script>
