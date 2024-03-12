<!DOCTYPE html>
<html>
<head>
    <title>Creat Account</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
  @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
  @endif

  @if(session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
  @endif
  <div class="card">
    <div class="card-header text-center font-weight-bold">
      Create Account
    </div>
    <div class="card-body">
      <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('user')}}">
       @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">First Name</label>
          <input type="text" id="title" name="firstName" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Last Name</label>
          <input type="text" id="title" name="lastName" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" id="title" name="email" class="form-control" required="">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>  
</body>
</html>