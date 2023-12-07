<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #link{
            text-decoration: none;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: black;
            font-weight: 5px;
            background-color: brown;
        }
        .container{
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <h3>Welcome to Logout Page</h3>
        </div>
        <div>
            <a id="link" href="{{route('logout',['user_type' => 'customer'])}}">Logout</a>
        </div>
    </div>
    
</body>
</html>