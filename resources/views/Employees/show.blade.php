@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $user->name??'' }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Designation :</strong>
                {{ $user -> Designation??''}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>CNIC :</strong>
                {{ $user -> cnic}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status :</strong>
                {{ $user -> status}}
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