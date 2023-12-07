
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Your Page Title</title>
  <style>
    #logout{
        display: flex;
        justify-content: center;
        align-items: center;
    }
  </style>
</head>
<body>
<div class="container">
<table class="table table-dark table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Mobile</th>
        <th scope="col">Gender</th>
        <th scope="col">State</th>
        <th scope="col">District</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
        <th scope="row">{{$customer->id}}</th>
        <td>{{$customer->name}}</td>
        <td>{{$customer->email}}</td>
        <td>{{$customer->mobile}}</td>
        <td>{{$customer->gender}}</td>
        <td>{{$customer->state}}</td>
        <td>{{$customer->district}}</td>
        <td>@if ($customer->status)
            <span class="badge bg-success">approved</span>
            @else
            <span class="badge bg-danger">Not approved</span>
            @endif
        </td>
        <td>
            @if($customer->status)
                <a href="{{route('reject_customer',['id' => $customer->id])}}" class="btn btn-danger">Reject</a>
            @else
            <a href="{{route('approve_customer',['id' => $customer->id])}}" class="btn btn-success">Approve</a>
            @endif
            <a href="{{route('edit_customer',['id' => $customer->id])}}" class="btn btn-info" href="">Edit</a>
        </td>
        </tr>
        @endforeach 
    </tbody>
    </table>
</div>
<div id="logout" class="container">
    <a class="btn btn-info" href="{{route('logout',['user_type' => 'admin'])}}">Logout</a>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
