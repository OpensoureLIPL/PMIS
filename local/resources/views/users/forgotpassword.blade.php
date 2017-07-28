
<!DOCTYPE HTML>
<html>
<head>
  @include('layout.header')

</head>
<body>	
<div class="login-page">
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Forgot forgotPassword</h1>
			</div>
			<div class="login-block">
			@if( Session::get('errors') )
            <div class="alert alert-danger">
			    <ul class="error">
			        @foreach( Session::get('errors') as $message )
			                <li>{{ $message }}</li> 
			            
			        @endforeach
			    </ul>
			    </div>
			   @endif
			   	@if( Session::get('success') )
            <div class="alert alert-success">
			    <ul class="error">
			        @foreach( Session::get('success') as $message )
			                <li>{{ $message }}</li> 
			            
			        @endforeach
			    </ul>
			    </div>
			   @endif
			   	@if( Session::get('warning') )
            <div class="alert alert-danger">
			    <ul class="error">
			        @foreach( Session::get('warning') as $message )
			                <li>{{ $message }}</li> 
			            
			        @endforeach
			    </ul>
			    </div>
			   @endif
				 {!! Form::open(array('url' => '/forgotpassword','class'=>'form')) !!}
					<input type="text" name="email" placeholder="Email" >
					<div class="forgot-top-grids">
						
					    
					</div>
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<input type="submit" name="Sign In" value="Submit">	
					
				</form>
				<div class="forgot">
							<a href="{{URL::to('/')}}/">Login Here?</a>
						</div>
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


                      
						
