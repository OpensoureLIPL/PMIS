
<!DOCTYPE HTML>
<html>
<head>
  @include('layout.header')

</head>
<body>	
<div class="login-page">
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Login</h1>
			</div>
				@if( Session::get('success') )
            <div class="alert alert-success">
			    <ul class="error">
			        @foreach( Session::get('success') as $message )
			                <li>{{ $message }}</li> 
			            
			        @endforeach
			    </ul>
			    </div>
			   @endif
			<div class="login-block">
			{!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}

				 {!! Form::open(array('url' => '/login','class'=>'form')) !!}
					<input type="text" name="email" placeholder="Email" >
					<input type="password" name="password" class="lock" placeholder="Password">
					<div class="forgot-top-grids">
						<!--<div class="forgot-grid">
							<ul>
								<li>
									<input type="checkbox" id="brand1" value="">
									<label for="brand1"><span></span>Remember me</label>
								</li>
							</ul>
						</div>-->
					    <div class="forgot">
							<a href="{{URL::to('/')}}/forgotpassword">Forgot password?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<input type="submit" name="Sign In" value="Login">	
					
				</form>
				
			</div>
      </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
@include('layout.footer')
<!--COPY rights end here-->

<!--scrolling js-->
	@include('layout.footer_scripts')
<!-- mother grid end here-->
</body>
</html>


                      
						
