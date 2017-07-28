@extends('layout.index')
@section('content')

 <div class="inbox">
    	  <h2>{{$title}}</h2>
    	        <div class="col-md-4 compose">         
            <div class="mail-profile">
                
                    <div class="mail-pic">
                        <a href="#">
                        @if($user->profile_pic)

                        <img  class="img img-responsive" src="{{url('/')}}/images/profile/{{$user->profile_pic}}" alt="">
                        @else
                        <img  class="img img-responsive" src="{{url('/')}}/images/profile/user.png" alt="">
                        @endif
                        </a>
                    </div>

                    <div class="mailer-name">  
                     
                                     
                            <h5><a href="#">{{$user->name}}</a></h5>                    
                             <h6><a href="#">{{$user->email}}</a></h6>  
                             @foreach($user_type_name as $user_type) 
                                    {{$user_type->type_name}}
                             @endforeach
                    </div>

                    <div class="clearfix"> </div>
                
            </div>
            
         </div>   
    	 	<div class="col-md-8 compose-right">
					<div class="inbox-details-default">
						
						<div class="inbox-details-body">
							{!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                       

                        {!! Form::model($user, ['action' => 'UserController@userprofileUpdate', 'files'=>true]) !!}
                            {!! Form::hidden('id', null, []) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', null, ['class' => 'form-control alpha']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::text('email', null, ['class' => 'form-control alpha']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('contact', 'Contact') !!}
                                {!! Form::text('contact', null, ['class' => 'form-control alpha']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('address', 'Address') !!}
                                {!! Form::textarea('address', null, ['class' => 'form-control alpha']) !!}
                            </div>
                             <div class="form-group">
                                {!! Form::label('Profile_pic', 'Profile Picture') !!}
                                 {!! Form::file('profile_pic','',['id'=>'','class'=>'']) !!}
                            </div>
                            {!! Form::submit(' Update ', ['name' => 'submit','class'=>'btn btn-success']) !!}
                               

                        {!! Form::close() !!}
                        {!! Html::style('js/alertifyjs/css/alertify.min.css') !!}
                        {!! Html::style('js/alertifyjs/css/themes/default.min.css') !!}
                        {!! Html::script('js/alertifyjs/alertify.min.js') !!}
                        <script type="text/javascript">
                        $(document).ready(function(){
                        @if(Session::has('flash_message'))
                            var notification = alertify.notify("{{ Session::get('flash_message') }}", 'success', 5, function(){  console.log('dismissed'); });
                        @elseif(Session::has('error_message'))
                            var notification = alertify.notify("{{ Session::get('error_message') }}", 'error', 5, function(){  console.log('dismissed'); });
                        @endif 
                        });
                        </script>
						</div>
					</div>
				</div>
    	
          <div class="clearfix"> </div>     
   </div>
   @endsection