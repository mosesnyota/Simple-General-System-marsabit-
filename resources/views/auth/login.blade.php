<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="{{asset('login.css')}}">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Don Bosco ERP </h2>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                      
                                        <p style="color:red">{{ $message }}</p>
                                    </span>
                                @enderror

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <p style="color:red">{{ $message }}</p>
                                    </span>
                                @enderror

      <input type="text" id="login" class="fadeIn second" name="email" placeholder="Email" required>
     
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password"  required>
     
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      
    </div>

  </div>
</div>
<!-- partial -->
  




</body>
</html>

