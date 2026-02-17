@extends('myapp')


@section('content')
    <section>
        <div class="container-fluid">
            <div class="jumbotron">
                <div class="row">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="saveprofilepic" method="post" enctype="multipart/form-data" autocomplete="on" role="form">
                                    <div class="form-group form-group-">
                                        <label class="control-label" for="imageprofile">Profile Picture:</label>
                                        <a href="#" class="thumbnail">
                                            @if(empty($profile_picture))
                                                <img class="img-responsive" src="/img/icon.png" alt="">
                                            @else
                                                <img class="avatar" src="/image">
                                            @endif
                                        </a>
                                        <input id="imageprofile" name="image" type="file" accept="image/*" />
                                        <div class="col-md-4">
                                            <input class="form-control" type="submit" name="profilePic" value="Save"/>
                                        </div>
                                        <input type="hidden" name="_token" value='{{ csrf_token() }}'>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row" id="aboutMe">
                            <div class="col-md-6">
                                <form action="saveaboutme" method="post" autocomplete="on" role="form">
                                    <div class="form-group">
                                        <label class="control-label" for="aboutMeprofile">About Me:</label>
                                        <textarea class="form-control" rows="7" id="aboutMeprofile" name="aboutme">{{ $about_me }}</textarea>
                                        <div class="col-md-4">
                                            <input class="form-control" type="submit" name="saveAboutMe" value="Save">
                                        </div>
                                        <input type="hidden" name="_token" value='{{ csrf_token() }}'>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <form class="form-horizontal" action="saveprofile" method="post" autocomplete="on" role="form" >
                            <input type="hidden" name="honeypot" value="IS-421-RRZ" />
                            <input type="hidden" name="_token" value='{{ csrf_token() }}'>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="firstnameprofile">First Name:</label>
                                <input class="form-control" id="firstnameprofile" name="firstname" value="{{ $name }}" type="text"  />
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="lastnameprofile">Last Name:</label>
                                <input class="form-control" id="lastnameprofile" name="lastname" value="{{ $last }}" type="text"  />
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="usernameprofile">Username:</label>
                                <input class="form-control" id="usernameprofile" name="username" value="{{ $user }}" type="text"  />
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="streetaddressprofile">Street Address:</label>
                                <input class="form-control" id="streetaddressprofile" name="address" value="{{ $address }}" type="text" />
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="cityprofile">City:</label>
                                <input class="form-control" id="cityprofile" name="city" value="{{ $city }}" type="text" />
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="stateprofile">State:</label>
                                <input class="form-control" id="stateprofile" name="state" value="{{ $state }}" type="text" />
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="countryprofile">Country:</label>
                                <input class="form-control" id="countryprofile" name="country" value="{{ $country }}" type="text" />
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="bdayprofile">Date Of Birth:</label>
                                @if(empty($birthdate))
                                    <input class="form-control" id="bdayprofile" name="bday" value="YYYY-MM-DD" type="text" />
                                @else
                                    <input class="form-control" id="bdayprofile" name="bday" value="{{ $birthdate }}" type="text" />
                                @endif
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="phoneprofile">Phone Number:</label>
                                <input class="form-control" id="phoneprofile" name="phone" value="{{ $phone }}" type="tel" />
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label" for="emailprofile"> E-mail Address:</label>
                                <input class="form-control" id="emailprofile" name="email" value="{{ $email }}" type="email" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="submit" name="updateProfile" value="Save"/>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection