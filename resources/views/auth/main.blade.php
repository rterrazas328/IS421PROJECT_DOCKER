@extends('myapp')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="jumbotron">
                <h1  class="text-info" align="center">MyUsic</h1><br>

                <input type="text" class="form-control" placeholder="Search for Music">
                <br>
                <span class="input-group-btn">
                    <button  class="btn btn-primary btn-lg gradient">Search!</button>
                </span>
                <div class="col-md-1">
                    <a class="navbar-brand " href="#"></a>
                </div>
            </div>
            <a href="/auth/login" class="btn btn-primary btn-lg active" role="button">Log In</a>
            <br>
            <br>
            <a href="/auth/register" class="btn btn-primary btn-lg active" role="button">Sign Up</a>
            <br>
            <br>
        </div>
    </section>
@endsection