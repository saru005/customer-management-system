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
            <h2 class="form-title">Edit Customer Details</h2>
            <hr class="divider">
            <form id="updateForm" action="{{route('edit_customer_detail',['id' => $customer->id])}}" method="post">
                <div class="form-body">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="cust_name" placeholder="Enter Name" value="{{$customer->name}}">
                        <span class="error-message" id="cust_name"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Enter Email" value="{{$customer->email}}">
                        <span class="error-message" id="email"></span>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="mobile" placeholder="Enter Mobile" value="{{$customer->mobile}}">
                        <span class="error-message" id="mobile"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="state" placeholder="Enter State" value="{{$customer->state}}">
                        <span class="error-message" id="state"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="district" placeholder="Enter District" value="{{$customer->district}}">
                        <span class="error-message" id="district"></span>
                    </div>
                    <div class="form-group">
                        <select class="gender" name="gender">
                            <option value="" {{ $customer->gender == '' ? 'selected' : '' }}>Select Gender</option>
                            <option value="male" {{ $customer->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $customer->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <span class="error-message" id="gender"></span>
                    </div>
                    <button class="submit-btn" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updateForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        });
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        },2000); 
                    },
                    error: function(error) {
                        if (error.status === 422) {
                            var errors = error.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $(`#${key}`).text(value);
                            });
                        } else {
                            console.log(error);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>