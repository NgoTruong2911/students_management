@extends('master.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Amount student</th>
                @if(Auth::user()->hasRole('admin'))
                <th scope="col"><a href="{{route('subjects.create')}}" class="btn btn-success">Add +</a></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->description }}</td>
                    <td>{{ count($subject->user_subject) }}</td>
                    @if(Auth::user()->hasRole('admin'))
                    <td><a href="{{ route('subjects.edit',[$subject->id]) }}" class="btn btn-primary">Update</a></td>
                    @endif
                    <td><a href="{{ route('subjects.show',[$subject->id]) }}" class="btn btn-primary">Show</a></td>
                    @if(Auth::user()->hasRole('admin'))
                    <td>
                        <form action="{{route('subjects.destroy',$subject->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" id="remove" type="submit">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>{{ $subjects->links() }}</div>
        <!-- /.content -->
    </div>
@endsection
@section('script')
    <script>
        $('#remove').click(function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
                .then((result) => {
                    if (result.value) {
                        $(this).parent().submit();
                    }
                })
        })
    </script>
@endsection
