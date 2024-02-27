@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')

    <section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Employee History</h2>
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

    <form action="{{ route('employeehistory.update',$employeeHistory->id)}}" method="POST">
    	@csrf
		@method('PUT')

         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Company name</strong>
		            <input class="form-control"  name="company_name"  value="{{ $employeeHistory->user->name }}"  >
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Position</strong>
					<input type="text" name="position" class="form-control" placeholder="Position" value="{{ $employeeHistory->position }}">
		        </div>
		    </div>
    	<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Remarks</strong>
		            <input  name="remarks" class="form-control" placeholder="Remarks" value="{{ $employeeHistory->remarks }}">
		        </div>
		    </div>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<strong>Reviews & Ratings</strong>
				</div>
			
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						
						<div class="rate">
							<input type="radio" id="star5" name="reviews" value="5"  />
							<label for="star5" title="text">5 stars</label>
							<input type="radio" id="star4" name="reviews" value="4" />
							<label for="star4" title="text">4 stars</label>
							<input type="radio" id="star3" name="reviews" value="3" />
							<label for="star3" title="text">3 stars</label>
							<input type="radio" id="star2" name="reviews" value="2" />
							<label for="star2" title="text">2 stars</label>
							<input type="radio" id="star1" name="reviews" value="1"  />
							<label for="star1" title="text">1 star</label>
						  </div>
					</div>
				</div>

			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Job Description:</strong>
		            <input type="text" name="job_desc" class="form-control" placeholder="Add Description" value="{{ $employeeHistory->job_desc }}">
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Salary:</strong>
		            <input type="number" name="salary" class="form-control" placeholder="Salary" value="{{ $employeeHistory->salary }}">
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Location:</strong>
		            <input type="text" name="location" class="form-control" placeholder="Location" value="{{ $employeeHistory->location }}">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Start Date:</strong>
		            <input type="text" name="start_date" class="form-control" placeholder="Start date" value="{{ $employeeHistory->start_date }}">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>End Date</strong>
		            <input type="text" name="end_date" class="form-control" placeholder="End date" value="{{ $employeeHistory->end_date }}">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>

        </div>
        </section>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('includes.admin.footer')
        @include('includes.admin.scripts')
        @include('includes.admin.validationScript')
        @stop