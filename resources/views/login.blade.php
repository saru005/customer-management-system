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
                <button id="admin" class="active" >Admin</button>
                <button id="customer" >Customer</button>
            </div>
            <form id="loginForm" action="{{route('login')}}" method="post">
                @csrf
                <div class="form-body">
                    <input type="text" name="email" placeholder="Enter Email">
                    <span class="error-message" id="email"></span>
                    
                    <input type="password" name="password" placeholder="Enter Password">
                    <span class="error-message" id="password"></span>
                    <input type="hidden" id="user_type" name="user_type" placeholder="Enter Password" value="admin">
                    <button type="submit">Login</button>
                    <a href="{{route('signup')}}">Signup</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#admin').on('click',function(e) {
                $('#customer').removeClass('active');
                $('#user_type').val('admin');
                $(this).addClass('active');
            });

            $('#customer').on('click',function(e) {
                $('#admin').removeClass('active');
                $('#user_type').val('customer');
                $(this).addClass('active');
            });

            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function(response) {
                        if(response.success) { 
                            window.location.href = response.redirect; 
                        }
                        else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.error_message,
                            });
                        }                        
                    },
                    error: function(error) {
                        if (error.status === 422) {
                            var errors = error.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#'+key).text(value);
                            });
                        } else {
                            alert(error.responseJSON.errors);
                            // Handle other error responses
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>