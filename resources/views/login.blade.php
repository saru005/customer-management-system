<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Login</h2>
            <hr class="divider">
            <div class="form-header">
                <button class="active" id="admin" >Admin</button>
                <button id="customer" >Customer</button>
            </div>
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="form-body">
                    <input type="text" name="email" placeholder="Enter Email">
                    <input type="password" name="password" placeholder="Enter Password">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    
    </script>
</body>

</html>