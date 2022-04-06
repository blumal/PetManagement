<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <div class="login-form">
        <form action="{{url("login-proc")}}" method="post">
            @csrf
            <input type="email" placeholder="Ex: rauw@petmanagement.net" name="email_us"></br></br>
            <input type="password" name="pass_us"></br></br>
            <input type="submit">
        </form>
    </div>
</body>
</html>