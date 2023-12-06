<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/signup.css')}}">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Create Account</h2>
            <hr class="divider">
            <form id="signupForm" action="{{route('signup')}}" method="post">
                <div class="form-body">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="cust_name" placeholder="Enter Name">
                        <span class="error-message" id="cust_name"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Enter Email">
                        <span class="error-message" id="email"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile" placeholder="Enter Mobile">
                        <span class="error-message" id="mobile"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="state" placeholder="Enter State">
                        <span class="error-message" id="state"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="district" placeholder="Enter District">
                        <span class="error-message" id="district"></span>
                    </div>
                    <div class="form-group">
                        <select class="gender" name="gender">
                            <option value="">select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span class="error-message" id="gender"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password">
                        <span class="error-message" id="password"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                        <span class="error-message" id="confirm_password"></span>
                    </div>
                    <button class="submit-btn" type="submit">Signup</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#signupForm').on('submit', function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: value
                        });
                    },
                    error: function(error) {
                        if (error.status === 422) {
                            var errors = error.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $(`#${key}`).text(value);
                            });
                        } else {
                            console.log(error);
                            // Handle other error responses
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>