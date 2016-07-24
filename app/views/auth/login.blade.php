@extends('layouts.master')
@section('title', 'Login')

@section('content')
<div class="container">
  <div class="row">
	<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
		<div class="">
			<div class="login-font">LOG IN</div>
			@foreach($errors->all() as $message)
    			<div class="text-center" style="color: red;">{{ $message }}</div>
			@endforeach
			@if (Session::has('info'))
			   <div class="session-text">{{ Session::get('info') }}</div>
			@endif

			<form action="/login" method="POST" class="form form-signup" role="form">
		        <input type="hidden" name="_token" value="{{ csrf_token() }}">
		        <div>
					<input type="text" class="form-control wide-input" name="username" placeholder="Username" required/>
		        </div>
		        <div>
					<input type="password" class="form-control wide-input" name="password" placeholder="Password" required/>
		        </div>
				<button type="submit" class="btn-submit" role="button" name="enter">Submit</button>
			</form>
		</div>
	</div>
  </div>
</div>
@endsection
