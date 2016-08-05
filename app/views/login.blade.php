<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Bingo System  | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <!-- bootstrap 3.0.2 -->
        {{ HTML::style('vendor/bootstrap/bootstrap.min.css') }}
        <!-- Theme style -->
        {{ HTML::style('vendor/lte/AdminLTE.css') }}
        <!-- font Awesome -->
        {{ HTML::style('vendor/font-awesome/css/font-awesome.min.css') }}

    </head>
    <body class="bg-black">
        @if(Session::get('changed'))
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                        <b>Password succcessfully changed!</b>
                    </div>
                </div>
            </div>
        @endif
                
        <div class="form-box" id="login-box">
            <div class="header">Log In</div>

            {{ Form::open(['url' => URL::route('user.login')]) }}
                <div class="body bg-gray">
                    
                    @if(count($errors))
                        <p class="text-red"> {{ $errors->first() }} </p>
                    @endif

                    <div class="form-group">
                        {{ Form::text('username', Input::old('username'), ['id' => 'username', 'autofocus' => 'autofocus', 'placeholder' => 'Username', 'class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::password('password', ['id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control']) }}
                    </div>          
                </div>
                <div class="footer">
                    {{ Form::submit('Log me in', ['name' => 'submit', 'class' => 'btn btn-block bg-blue2'])}}                                                       
                </div>

            {{ Form::token() }}
            {{ Form::close() }}

        </div>
    </body>
</html>