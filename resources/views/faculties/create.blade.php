@extends('master.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="container">
            {!! Form::open(array('route'=>'faculties.store'),array('method' => 'POST ')) !!}
            <div class="form-group">
                {!! Form::label('name', 'Enter name here') !!}
                {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'enter name faculty']) !!}
            </div>
            @error('name')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="form-group">
                {!! Form::label('description', 'Enter description') !!}
                {!! Form::textarea('description', $value=null, ['class' => 'form-control'],['row' =>'3']) !!}
            </div>
            @error('description')
                <p class="text-danger">{{$message}}</p>
            @enderror
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        <!-- /.content -->
        </div>
    </div>
@endsection
<script>
</script>
