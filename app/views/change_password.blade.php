<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Basic Passport Information System  | Change Password</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <!-- bootstrap 3.0.2 -->
        {{ HTML::style('vendor/bootstrap/bootstrap.min.css') }}
        <!-- Theme style -->
        {{ HTML::style('vendor/lte/adminlte.css') }}

    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header">Change Password</div>

            {{ Form::open(['url' => URL::route('change.password')]) }}
                <div class="body bg-gray">
                    
                    @if(count($errors))
                        <p class="text-red"> {{ $errors->first() }} </p>
                    @endif

                    <div class="form-group">
                        {{ Form::label('New Password')}}
                        {{ Form::password('password', ['id' => 'password', 'autofocus', 'placeholder' => 'Enter new password', 'class' => 'form-control']) }}
                    </div>          

                    <div class="form-group">
                        {{ Form::label('Password Confirm')}}
                        {{ Form::password('password_confirm', ['id' => 'password_confirm', 'placeholder' => 'Confirm new password', 'class' => 'form-control']) }}
                    </div>          
                </div>
                <div class="footer">
                    {{ Form::submit('Change', ['name' => 'submit', 'class' => 'btn btn-block bg-blue2'])}}                                                       
                </div>

            {{ Form::token() }}
            {{ Form::close() }}

        </div>
    </body>
</html>