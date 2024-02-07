<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Make-A-Wish Oregon - Volunteer page</title>
	<link rel="icon" type="image/png" href="/favicon.png" >
	<link rel="stylesheet" href="/assets/css/app.css">
	<link rel="stylesheet" href="/assets/css/semantic.min.css">
    <link rel="stylesheet" href="/assets/css/volunteer.css">
    @if(Auth::user())
        <link rel="stylesheet" href="/assets/css/admin.css">
    @endif
	{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>--}}
	<script src="/assets/js/jquery.min.js"></script>

</head>
<body @if(Auth::user()) class="admin" @endif>
	@if(Auth::user())
		<nav class="ui fixed menu">
			<div class="ui container">
				<a href="/" class="header item">
					<img class="logo" src="/assets/images/logo.png">
					Make-A-Wish-Oregon
				</a>
				<a href="/children" class="item">Children</a>
				<a href="/volunteer" class="item">Volunteers</a>
				<div class="right menu">
					<a href="/logout" class="item">Logout</a>
				</div>

			</div>
		</nav>
	@endif
	@yield('content')
	<footer class="blue_alt">
        <div class="ui three column centered grid">
            <div class="ui column">
                <p class="left"><i class="copyright icon"></i> Make-A-Wish Oregon</p>
            </div>
            <div class="ui column">
                <p class="text-centered">made with <i class="heart icon"></i> by <a href="http://www.ittybam.com">ittybam</a></p>
            </div>
            <div class="ui column">
                <p class="right"><a href="#" class="contactus">Contact Us</a></p>
            </div>
        </div>


	</footer>
</body>
<div class="ui modal blue contact_form">
	<div class="content">
		<h2>Contact Us</h2>
		<p>If you have any questions, please feel free to drop us a line</p>
	</div>
	<div class="form">
		{{ Form::open(array('url' => '/contactus', 'class'=> 'ui form', 'files' => true, 'method' => 'post') )  }}

		<input type="hidden" name="honeypot">
		<label for="name">Full Name*</label><br>
		<input type="text" required name="name" placeholder='i.e. John Smith'><br>
		<label for="email">Email*</label><br>
		<input type="email" required name="email" placeholder="name@domain.com"><br>
		<label for="cell">Cell Phone</label><br>
		<input type="tel" name="cell" placeholder="(555) 555-5555"><br>
		<label for="message">Your Message</label><br>
		<textarea class="email_message" name="email_message" placeholder="Your Message"></textarea>
		<br><br>
		<input type="submit" class="ui button submit" value="Send Message!">
		{{Form::close()}}

	</div>

</div>
</div>
<script src="/assets/js/jquery.matchHeight.js"></script>
<script src="/assets/js/semantic.min.js"></script>
<script src="/assets/js/main.js"></script>


</html>