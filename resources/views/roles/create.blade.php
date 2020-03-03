@extends('master.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <form action="{{route('roles.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name"
                placeholder="Enter name">
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">

            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                Permisson
            </a>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    @foreach($permission as $value)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="permission[]" id="inlineRadio1"
                            value={{$value->id}}>
                        <label class="form-check-label" for="inlineRadio1">{{$value->name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
<!-- /.content -->
</div>
@endsection
<script>
</script>
