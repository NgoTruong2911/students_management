@extends('master.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name Student</th>
                <th scope="col">Name subject</th>
                <th scope="col">Point</th>
              </tr>
            </thead>
            <tbody>
              @foreach($points as $point)
              <tr>
                  <td>{{ $point->id }}</td>
                  <td>{{ $point->user->name }}</td>
                  <td>{{ $point->subject->name }}</td>
                  <td>{{ $point->point }}</td>

                  <td><a href="{{ route('points.show',[$point->id]) }}" class="btn btn-primary">Show</a></td>
                  <td><form action="{{route('points.destroy',$point->id)}}" method="POST">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger" id="remove" type="submit">Delete</button>
                      </form>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>

    <!-- /.content -->
  </div>
@endsection
@section('script')
  <script>
    $('#remove').click(function(){
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
        if(result.value) {
          $(this).parent().submit();
        }
      })
    })
  </script>
@endsection
