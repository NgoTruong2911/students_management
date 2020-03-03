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
                <th scope="col"><a href="{{route('roles.create')}}" class="btn btn-success">Add +</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                {{-- <td>{{ count($subject->user_subject) }}</td> --}}
                <td><a href="{{route('roles.edit',[$role->id])}}" class="btn btn-primary">Update</a></td>
                <td><a href="{{route('roles.show',[$role->id])}}" class="btn btn-primary">Show</a></td>
                <td>
                    <form action="{{route('roles.destroy',[$role->id])}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" id="remove" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div>{{ $subjects->links() }}</div> --}}
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
