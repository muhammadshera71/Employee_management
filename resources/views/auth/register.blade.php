
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{@url('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{@url('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{@url('admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{@url('admin/dist/css/formstyle.css')}}">
  
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300&display=swap" rel="stylesheet">
  
  
</head>

<body class="hold-transition register-page">
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="user-details">
          <div class="input-box">
            <span class="details">Company Name</span>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Company Name" required autocomplete="name" autofocus>
           
          </div>
          <div class="input-box">
            <span class="details">POC</span>
            <input type="number" id="poc"  class="form-control @error('name') is-invalid @enderror" name="poc"  placeholder="Enter your POC" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input id="email" type="email"  placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="phone" id="phone" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input id="password-confirm" type="password" placeholder="Retype password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          </div>
          <div class="input-box">
            <span class="details">No. of employees</span>
            <input type="number" id="number_of_employees"  class="form-control" name="number_of_employees"  placeholder="Enter Number of employees" required>
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" placeholder="Enter your Address"  id="address"  class="form-control" name="address" required>
          </div>

          <div class="company-details">
            <input type="radio" name="type"  value="IT" id="dot-1">
            <input type="radio" name="type" value="Non-IT" id="dot-2" >    

            {{-- value="Non-IT" id="Non-IT" --}}

            <span class="company-title">Type</span>
            <div class="category">
              <label for="dot-1">
              <span class="dot one"></span>
              <span class="company">IT</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="company">Non-IT</span>
            </label>
            </div>
          </div>

          <div class="input-box">
            <span class="details">NTN</span>  
            <input type="file" placeholder="Attach NTN" required  id="ntn"  class="form-control" name="ntn">
          </div>
          <div class="input-box">
            <span class="details">Short Description</span>
            <input type="text" placeholder="Tell us about your business"   id="short_desc"  class="form-control" name="short_desc"  required>
          </div>
          <div class="input-box">
            <span class="details">Linkedin Address</span>
            <input type="text" placeholder="Enter your Address"  id="linkedin_address"  class="form-control" name="linkedin_address" required>
          </div>
          <div class="input-box">
            <span class="details">Website Address</span>
            <input type="text" placeholder="Enter your Website Address" id="website_address"  class="form-control" name="website_address"  required>
          </div>
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-primary">
          {{ __('Register') }}
      </button>
    </div>
      </form>
    </div>
  </div>



<!-- jQuery -->
<script src="{{@url('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{@url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{@url('admin/dist/js/adminlte.min.js')}}"></script>
</body>
</html>

