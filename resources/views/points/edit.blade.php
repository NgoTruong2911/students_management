@extends('master.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<form action="{{route('points.update',[$point->id])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="user_id">Name student : </label>
        <input type="text" class="form-control" disabled value="{{ $point->user->name }}" id="name" name="user_id" placeholder="Enter name">
    @error('user_id')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <div class="form-group">
        <label for="user_id">Name subject : </label>
        <input type="text" class="form-control" disabled value="{{ $point->subject->name }}" id="name" name="user_id" placeholder="Enter name">
    @error('user_id')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <div class="form-group">
        <label for="description">Point :  </label>
        <input type="number" class="form-control" value="{{ $point->point }}" id="name" name="point" placeholder="Enter name">
    @error('point')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <!-- /.content -->
</div>
@endsection
<script>
</script>
