
<!DOCTYPE HTML>
<html>
<head>
     @include('layout.header')
</head>
<body>	
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				 @include('layout.top_header')
		<!--heder end here-->

		<!--inner block start here-->
		<div class="inner-block">
		@yield('content')
		</div>
		<!--inner block end here-->
		<!--copy rights start here-->
		@include('layout.footer')
		<!--COPY rights end here-->
		</div>
	</div>
<!--slider menu-->
    @include('layout.sidebar')
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
@include('layout.footer_scripts')
<!-- mother grid end here-->
</body>
</html>                     