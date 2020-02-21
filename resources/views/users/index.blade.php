@extends('master.layout')
@section('content')


{{ \Request::get('point_min')}}
    <div class="content-wrapper">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
    @endif
    <!-- Content Header (Page header) -->
        <div class="container">
            <form action="{{route('users.index')}}" method="GET" role="search">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="point_number_form">Point min</label>
                    <input type="number" step="0.01" class="form-control" id="point_number_from" name="point_min" value="{{ old('point_min') }}"
                               placeholder="Point from ">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="point_number_to">Point max</label>
                        <input type="number" step="0.01" class="form-control" value="{{old('point_max')}}" id="point_number_to" name="point_max"
                               placeholder="Point at ">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="age_form">Age Min</label>
                        <input type="number" class="form-control" min="0" step="1" id="age_form" value="{{old('age_max')}}" name="age_min"
                               placeholder="Age from ">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="age_to">Age Max</label>
                        <input type="number" class="form-control" min="0" step="1" id="age_to" value="{{old('age_min')}}" name="age_max"
                               placeholder="Age to">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Phone number : </label>
                    {{-- <select class="form-control" name="network" id="exampleFormControlSelect1">
                    <option value="^0{1}([3]{1}[2-9]{1}|[9]{1}[6-8]{1})[0-9]{7}$">Viettel</option>
                    <option value="^0{1}([9]{1}[1,4]{1}|[8]{1}[8]{1})[0-9]{7}$">Vinaphone</option>
                    <option value="^0{1}([9]{1}[0,3]{1}|[7]{1}[0,1,2,6,8]{1})[0-9]{7}$">Mobifone</option>
                    </select> --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="phone_number[]" type="checkbox" id="inlineCheckbox1"
                               value="^0{1}([3]{1}[2-9]{1}|[9]{1}[6-8]{1})[0-9]{7}$">
                        <label class="form-check-label" for="inlineCheckbox1">Viettel</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="phone_number[]" type="checkbox" id="inlineCheckbox2"
                               value="^0{1}([9]{1}[1,4]{1}|[8]{1}[8]{1})[0-9]{7}$">
                        <label class="form-check-label" for="inlineCheckbox2">Vinaphone</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="phone_number[]" type="checkbox" id="inlineCheckbox3"
                               value="^0{1}([9]{1}[0,3]{1}|[7]{1}[0,1,2,6,8]{1})[0-9]{7}$">
                        <label class="form-check-label" for="inlineCheckbox3">Mobiphone</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Điểm :</label>
                    <select class="form-control" name="filter_point" id="exampleFormControlSelect1">
                        <option value="">Tất cả</option>
                        <option value="1">Đã hoàn thành</option>
                        <option value="2">Còn nợ môn</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="mt-4">{{ $users->links() }}</div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Stt</th>
                <th scope="col">Name</th>
                <th scope="col">Birthday</th>
                <th scope="col">Phone number</th>
                <th scope="col">Email</th>
                <th scope="col">Avatar</th>
                <th scope="col">Gender</th>
                <th scope="col">Role</th>
                @if(Auth::user()->hasPermissionTo('users-create'))
                    <th scope="col"><a href="{{ route('users.create') }}" class="btn btn-success">Add +</a></th>
                @endif
                @if(Auth::user()->hasRole('admin'))
                <th scope="col"><a href="{{ route('users.sendEmail') }}" class="btn btn-success">Send email</a></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach( $users as $key => $user )
                <tr id="user-update-{{ $user->id }}">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->birthday }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->email }}</td>
                    <td><img src="{{ asset($user->avatar) }}" alt="image" height="50" width="50"></td>
                    <td>{{ $user->gender==2?'Male':'Female' }}</td>
                    <td>{{ $user->roles->first()->name }}</td>
                    @if(Auth::user()->hasPermissionTo('users-update'))
                        <td><a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-primary">Update</a></td>
                    @endif
                    @if((Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('user') && Auth::user()->id == $user->id ) )
                    <td>
                        <button type="button" class="btn btn-primary edit-modal" data-user-id="{{ $user->id }}"
                                data-toggle="modal" data-target="#exampleModal">Update ajax
                        </button>
                    </td>
                    @endif
                    <td><a href="{{ route('users.show',[$user->id]) }}" class="btn btn-primary">Show</a></td>
                        @if(Auth::user()->hasAnyPermission(['users-delete','users-show']))
                    <td>
                        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" class="remove" type="submit">Delete</button>
                        </form>
                    </td>
                    @else
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="update_user" enctype='multipart/form-data'>
                        {{-- <input type="hidden" name="_method" value="PUT"> --}}

                        @method('PUT')
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            </div>

                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div>
                                <label for="faculty_id">Faculty name</label>
                                <select class="form-control" name="faculty_id" id="faculty_id">
                                </select>
                            </div>
                            <div>
                                <label for="roles">Role</label>
                                <select class="form-control" name="roles" id="roles">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender : </label>
                                <input type="radio" name="gender" class="female" value="1">Female
                                <input type="radio" name="gender" class="male" value="2">Male
                            </div>
                            {{-- {{dd($user->id)}} --}}
                            @if( (Auth::user()->roles[0]->name = 'user' && Auth::user()->password) || (Auth::user()->roles[0]->name = 'admin' && Auth::user()->password && Auth::user()->id == $user->id ) )
                            <div class="form-group">
                                <label for="current_password">Current password : </label>
                                <input type="password" name="current_password" class="form-control" id="current_password"
                            placeholder="Enter your Password">
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="password">Password : </label>
                                <input type="password" name="password" class="form-control" id="password"
                        placeholder="Enter your new Password">
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password : </label>
                                <input type="password" name="confirm_password" class="form-control" id="password"
                        placeholder="Enter your confirm new Password">
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar : </label>
                                <input type="file" id="avatar" name="avatar">
                                <img src="" class="rounded-lg ml-2 avatar" alt="avatar" width="100px" height="100px">
                            </div>
                            <input type="hidden" name="id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary save-update">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div><p>Showing {{$users->firstItem()}} to {{$users->lastItem()}}  of {{$users->total()}} </p></div>
        <div class="form-group" style="width:15%">
            <input type="text" class="form-control">
        </div>
        <div>{{ $users->links() }}</div>
        <!-- /.content -->
    </div>
@endsection
@section('script')
    <script>
        $('.remove').click(function () {
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

    {{-- popup ajax update user --}}
    <script>
        const API = "http://localhost:8000/";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.edit-modal', function () {
            var id = $(this).data('user-id');
            $.ajax({
                type: 'get',
                url: API + `users/${id}/edit`,
                success: function (response) {
                    console.log(response)
                    let user = response.user;
                    // console.log(response.user);
                    let faculties = response.faculties;
                    let subjects = response.subjects;
                    let user_subjects = response.user_subjects;
                    let roles = response.roles;
                    console.log(response.roles);
                    let user_role = response.userRole;
                    console.log(user_role)
                    $('input[name="email"]').val(user.email);
                    $('input[name="name"]').val(user.name);
                    $('input[name="birthday"]').val(user.birthday);
                    $('input[name="phone_number"]').val(user.phone_number);
                    $('input[name="age"]').val(user.age);
                    $('input[name="id"]').val(user.id);
                    $('#faculty_id').find('option').remove();
                    $('#roles').find('option').remove();
                    // let toReturn = false;
                    faculties.map((faculty) => {
                        $('select[name="faculty_id"]').append(
                            `<option value="${faculty.id}" ${user.faculty_id == faculty.id ? 'selected' : ''}>${faculty.name}</option>`
                        );
                        if (user.gender == 1) {
                            $('.female').prop("checked", true);
                        } else {
                            $('.male').prop("checked", true);
                        }
                    // toReturn = true;
                    })
                    // return toReturn;
                    $('.avatar').attr("src", API + user.avatar);
                    console.log(API + user.avatar);
                    $.each( roles, function( key, value ) {
                        $('select[name="roles"]').append(
                            `<option value="${key}" ${key === user_role[0].id ? 'selected' : ''}>${value}</option>`
                        );
                    });
                },
                error: function (e) {
                    console.log('err', e);
                }
            });
        });

        $(document).on('click', '.save-update', function () {
            let form = document.getElementById('update_user');
            let formData = new FormData(form);
            let id = $('input[name="id"]').val();
            $.ajax({
                type: 'POST',
                url: API + `users/${id}`,
                data: formData,
                contentType: false,
                enctype: 'multipart/form-data',
                cache: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    let row = $(`#user-update-${id} td`);
                    $(row[1]).text(data.name);
                    $(row[2]).text(data.birthday);
                    $(row[3]).text(data.phone_number);
                    $(row[4]).text(data.email);
                    $(row[5]).children().attr("src", API + data.avatar);
                    if (data.gender == 1) {
                        $(row[6]).text('Female');
                    } else {
                        $(row[6]).text('Male');
                    }
                    $(row[7]).text(data.roles[0].name);
                    $('#exampleModal').modal('toggle');

                },
                error: function printErrorMsg (msg) {
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display','block');
                        $.each( msg.responseJSON.errors, function( key, value ) {
                            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                }
            });

        });

        $("#exampleModal").on("hidden.bs.modal", function () {
            $(".print-error-msg").css('display','none');
        });
    </script>

    {{-- Edit user --}}
    <script>
        $('.subject').click(function () {
            const html = `<div class="form-group">

                          <label for="">${$(this).text()}</label>
                          <input type="number" step="0.01" class="form-control" name="subject_point[${$(this).val()}][point]">
                      </div>`
            $('.list-edit-subjects').append(html);
            $(this).hide();
        })
        $('.remove').click(function () {
            $(this).parent().parent().find('.remove_input').remove();

        })
    </script>
@endsection
