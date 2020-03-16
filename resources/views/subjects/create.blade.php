@extends('master.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <form action="{{route('subjects.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name : <a class="text-danger">*</a></label>
                <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name"
                       placeholder="Enter name">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description : <a class="text-danger">*</a></label>
                <textarea class="form-control" name="description" id="description"
                          rows="3">{{old('description')}}</textarea>
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
