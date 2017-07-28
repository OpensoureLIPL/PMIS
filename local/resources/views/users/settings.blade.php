@extends('layout.index')
@section('content')

 <div class="inbox">
    	  <h2>{{$title}}</h2>
    	   
    	 	<div class="col-md-8 compose-right">
					<div class="inbox-details-default">
						
						<div class="inbox-details-body">
							{!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                       

                        {!! Form::model($user, ['action' => 'UserController@update_settings']) !!}
                            {!! Form::hidden('id', null, []) !!}
                            <div class="form-group">
                                {!! Form::label('New Password', 'New Password') !!}
                                {!! Form::password('password', null, ['class' => 'form-control alpha']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('New Password', 'Re-enter New Password') !!}
                                {!! Form::password('new_password', null, ['class' => 'form-control alpha']) !!}
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