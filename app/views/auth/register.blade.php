@extends('layout.master')
@section('title', 'Sign up')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
			<div class="">

        		<h5 class="text-center">Sign Up</h5>
        		@foreach($errors->all() as $message)
        			<div class="text-center" style="color: red;">{{ $message }}</div>
				@endforeach

				<form method="POST" action="/signup" class="form form-signup" role="form">
					<input name="_token" type="hidden" value="{!! csrf_token() !!}" />
					<div class="row">
						<div class="col-xs-12">
							<input type="text" name="username" class="form-control wide-input" placeholder="Username" required/>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<input type="text" name="name" class="form-control wide-input" placeholder="Name" required/>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<input type="email" name="email" class="form-control wide-input" placeholder="Email Address" required/>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<input type="password" name="password" class="form-control wide-input" placeholder="Password" required/>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<input type="password" name="password_confirmation" class="form-control wide-input" placeholder="Confirm Password" required/>
						</div>
					</div>
				  	<button class="btn-submit" role="button" type="submit" name="join">Join</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection