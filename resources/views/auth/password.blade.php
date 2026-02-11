@extends('myapp')

@section('content')
<div class="container">
	<div class="jumbotron">
		<h1 align="center">Reset Password</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<h1 class="register-title" valign="middle" align="center">UMS</h1>
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
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

		<form id="form-signup_v1" name="form-signup_v1" method="POST" action="/password/email" class="validation-form-container col-md-4 col-md-offset-4" align="center">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="honeypot" value="IS-421-RRZ" />
			</br>
			<div class="field">
				<label for="email">Email</label>
				<div class="ui left labeled input">

					<input id="email"
						   name="email"
						   type="email"
						   data-validation="[EMAIL]">

					<div class="ui corner label">
						<i class="asterisk icon">*</i>


					</div>
				</div>
			</div>


			<button type="submit" class="btn btn-primary btn-lg active">Submit</button>


		</form>
	</div>
</div>
@endsection
