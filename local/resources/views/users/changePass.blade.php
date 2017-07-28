
<!DOCTYPE HTML>
<html>
<head>
  @include('layout.header')

</head>
<body>  
<div class="login-page">
    <div class="login-main">    
       <div class="login-head">
        <h1>{{$title}}</h1>
      </div>
      <div class="login-block">
      {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}

        {!! Form::model($user, ['action' => 'UserController@updatepassword']) !!}
                            {!! Form::hidden('id', null, []) !!}
                            <div class="form-group">
                                {!! Form::label('password', 'New Password') !!}
                                {!! Form::password('password', null, ['class' => 'form-control alpha']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('New password', 'Re-enter New Password') !!}
                                {!! Form::password('new_password', null, ['class' => 'form-control alpha']) !!}
                            </div>
                            {!! Form::submit('Update', ['name' => 'submit','class'=>'btn btn-success']) !!}
                                
                        {!! Form::close() !!}
          
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


                      
            
