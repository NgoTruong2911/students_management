@extends('master.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <form action="{{route('subjects.update',[$subject->id])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" class="form-control" value="{{ old('name',$subject->name) }}" id="name" name="name"
                       placeholder="Enter name">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description : </label>
                <textarea class="form-control" name="description" id="description"
                          rows="3">{{old('description',$subject->description)}}</textarea>
                @error('description')
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
