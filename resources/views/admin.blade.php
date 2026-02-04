@extends('myapp')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="jumbotron">
                <h1>Admin Dashboard</h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel panel-default table-responsive">
                <div class="panel-heading">
                    <h3 class="panel-title">List of users</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" id="tableForm" role="form" action="admin">
                        <input type="hidden" name="_token" value='{{ csrf_token() }}'>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <th>Select</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>UserName</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Role</th>
                            </thead>
                            @foreach($data as $user)
                                <tr>
                                    <td>
                                        <input id="{{ $user->id }}" name="{{ $user->id }}" class="form-control" type="checkbox">
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->last }}</td>
                                    <td>{{ $user->user }}</td>
                                    <td>********</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <select class="form-control" id="{{ $user->id }}Role" name="{{ $user->id }}Role">
                                            @if($user->userlevel == 0)
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            @else
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            @endif
                                        </select>
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    </form>
                    <div class="row">
                        <div class="col-md-1 col-md-offset-11">
                            <input class="form-control" type="submit" form="tableForm" name="updateRole" value="save">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection