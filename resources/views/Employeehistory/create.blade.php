<!DOCTYPE html>

@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')
<body>
    <section class="content">
    <div class="container-fluid">
    <div class="row" >
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create Employee History</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employeehistory.index') }}"> Back </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employeehistory.store') }}" method="POST">
    	@csrf

         <div class="row">

			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Cnic:</strong>
		            <input type="text"   placeholder="XXXX" name="cnic" class="form-control" placeholder="CNIC"  id="target" value="{{ old('cnic') }}"  >
					<span id="cnic-error" class="text-danger"></span>
				</div>
		    </div>

			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name"  id="employee_name" class="form-control" placeholder="Name"  >
		        </div>
		    </div>

			{{-- <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Id:</strong>
		            <input type="text" class="form-control" placeholder="Position"  value="{{  $employees->employee_id}} " name="employees_id" >{{$employees->employee_id}}
		        </div>
		    </div> --}}

		    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
				value ={{$name}}
		        <div class="form-group">
		            <strong>Employee Name: </strong>
					<select name="employees_id" class="form-control" aria-label="Default select example">
						<option selected>Open this select menu</option>
						
	    			@foreach ($employees as $employeeHistory)
	        		<option value="{{  $employeeHistory->employee_id}} ">	{{  $employeeHistory->employee_name }} </option>
						@endforeach
					  </select>
		        </div>
		    </div> --}}
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Position:</strong>
		            <input type="text" class="form-control" placeholder="Position"  name="position">
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Remarks:</strong>
		            <input type="text" name="remarks" class="form-control" placeholder="Remarks">
		        </div>
		    </div>
			{{-- <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Reviews & Ratings:</strong>
		            <input type="text" name="reviews" class="form-control" placeholder="Reviews">
		        </div>
		    </div> --}}
			<div class="col-xs-12 col-sm-12 col-md-12">
			<strong>Reviews & Ratings</strong>
			</div>
			<form>
			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            
					<div class="rate">
						<input type="radio" id="star5" name="reviews" value="5" />
						<label for="star5" title="text">5 stars</label>
						<input type="radio" id="star4" name="reviews" value="4" />
						<label for="star4" title="text">4 stars</label>
						<input type="radio" id="star3" name="reviews" value="3" />
						<label for="star3" title="text">3 stars</label>
						<input type="radio" id="star2" name="reviews" value="2" />
						<label for="star2" title="text">2 stars</label>
						<input type="radio" id="star1" name="reviews" value="1" />
						<label for="star1" title="text">1 star</label>
					  </div>
		        </div>
		    </div>
			</form>
			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Job Description:</strong>
		            <input type="text" name="job_desc" class="form-control" placeholder="Add Description">
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Salary:</strong>
		            <input type="number" name="salary" class="form-control" placeholder="Salary">
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Location:</strong>
		            <input type="text" name="location" class="form-control" placeholder="Location">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Start Date:</strong>
		            <input type="text" name="start_date" class="form-control" placeholder="Start date">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>End Date</strong>
		            <input type="text" name="end_date" class="form-control" placeholder="End date">
		        </div>
		    </div>
            
		    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>
    </div>
    </section>

    </form>

</div>
<!-- /.content-wrapper -->

@include('includes.admin.footer')
@include('includes.admin.scripts')
@include('includes.admin.validationScript')
@stop
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
$(document).ready(function() {
    $("#target").on("keyup", function(event) {
        var inputValue = $(this).val();

        if (inputValue.length === 4) {
            $.ajax({
                url: '/check-number/' + inputValue,
                type: 'GET',
                success: function(response) {
					console.log(response);
                    if (response.name) {
						$("#employee_name").val(response.name);
                    
                    } else {
                        $("#employee_name").val(" ");
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
		else{
		$("#employee_name").val(" ");
	}
    }
	
	
	
	);
	
});

</script>
<script>
    // $(document).ready(function() {
    //     $('#target').on('blur', function() {
    //         validateCnic();
    //     });

    //     function validateCnic() {
    //         var cnicValue = $('#target').val();

    //         if (cnicValue.length !== 4 || isNaN(cnicValue)) {
    //             $('#cnic-error').text('CNIC must be four digits.');
    //         } else {
    //             $('#cnic-error').text('');
    //         }
    //     }

    //     $('form').on('submit', function(e) {
    //         e.preventDefault();
    //         validateCnic(); // Perform client-side validation before submitting the form

    //         // If client-side validation passes, proceed with the Ajax request
    //         if ($('#cnic-error').text() === '') {
    //             $.ajax({
    //                 type: 'POST',
    //                 url: '{{ route("employees.store") }}',
    //                 data: $('form').serialize(),
    //                 success: function(response) {
    //                     // Handle success response, e.g., redirect or display a success message
    //                 },
    //                 error: function(xhr) {
    //                     // Handle error response, e.g., display error messages
    //                 }
    //             });
    //         }
    //     });
    // });
</script>