@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.checked {
  color: orange;
}
</style>


<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employeehistory.index') }}"> Back </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $employeeHistory->employees_name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company :</strong>
                {{ $employeeHistory -> users_name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Position :</strong>
                {{ $employeeHistory -> position}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ratings :</strong>
                <td> @for ( $i=1; $i<=5; $i++ )
                    @if ($i<=$employeeHistory->reviews)
                    <span class="fa fa-star checked"></span>
                          
                      @else
                      <span class="fa fa-star "></span>
                      @endif     
                @endfor  </td>
              
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Remarks :</strong>
                {{ $employeeHistory -> remarks}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Job Description :</strong>
                {{ $employeeHistory -> job_desc}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Salary :</strong>
                {{ $employeeHistory -> salary}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Location  :</strong>
                {{ $employeeHistory -> location}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Start Date :</strong>
                {{ $employeeHistory -> start_date}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End Date :</strong>
                {{ $employeeHistory -> end_date}}
            </div>
        </div>
   

    </div>
    </div>
    </section>
    </div>
    <!-- /.content-wrapper -->
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
    @stop