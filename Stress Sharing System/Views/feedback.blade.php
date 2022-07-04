<!doctype html>
<html lang="en">
  <head>
  	<title>Feedback</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	
	<link rel="stylesheet" href="{{URL::asset('css/feedback/style.css')}}">

	</head>
	<body>
	<section class="ftco-section" style="background-color: lightblue">

		<div class="container" >

			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
          @if (count($errors->all()))
          <h4 style="color: red">  {{$errors->all()[0]}}</h4>
          @endif
          @if (Session::get('message') != null)
              <h4 style="color: green">{{Session::get('message')}}</h4>
          @endif
					<h2 class="heading-section">Feedback</h2>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-12">
					<div class="wrapper">
						<div class="row no-gutters">
								<div class="contact-wrap w-100 p-md-5 p-4">
									
									<form method="POST" id="contactForm" name="contactForm" action="/Feedback">
@csrf
										<div class="row">
                      
											
											<div class="col-md-12">
												<div class="form-group">
													<input type="email" class="form-control" name="email" id="email" placeholder="Email">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<textarea name="feedback" class="form-control" id="feedback" cols="30" rows="7" placeholder="Message"></textarea>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<input type="submit" value="Send Message" class="btn btn-primary">
													<div class="submitting"></div>
												</div>
											</div>

										</div>
									</form>
								</div>
							

						
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

