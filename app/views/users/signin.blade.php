@extends('layouts.main')

@section('content')
	<section id="signin-form">
		<h1>I have an account</h1>

		{{ Form::open(array('url'=>'users/signin')) }}

		<p>
			{{ Form::label('email') }}
			{{ Form::text('email')}}
		</p>

		<p>
			{{ Form::label('password') }}
			{{ Form::password('password')}}
		</p>
		{{ Form::button('Sign In', array('type'=>'submit','class'=>'btn btn-primary')) }}
		{{ Form::close() }}

		
	</section><!-- end signin form-->
	<section id="signup">
		<h2>I'm a new Customer</h2>
		<h3>You can create an account in just few simple steps <br> Click below to begin</h3>

		{{ HTML::link('users/newaccount','CREATE NEW ACCOUNT', array('class'=>'btn btn-danger')) }}
		
	</section>
@stop