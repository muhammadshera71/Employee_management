@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')

    <section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back </a>
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

    <form action="{{ route('employees.store') }}" method="POST">
    	@csrf

         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong> Designation:</strong>
		            <input class="form-control" type="text"  name="Designation" placeholder="Detail">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>CNIC:</strong>
		            <input type="number" name="cnic" class="form-control" placeholder="CNIC No.">
		        </div>
		    </div>

            {{-- <select name="employees_status" class="form-control" aria-label="Default select example">
                <option selected>Open this select menu</option>
                
            @foreach ($employees as $employeeHistory)
            <option value="{{  $employeeHistory->employees_status }} ">	 </option>
                @endforeach
              </select> --}}
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