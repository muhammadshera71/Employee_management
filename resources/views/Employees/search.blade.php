@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')
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


                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <form class="card card-sm" method="GET" action="" role="search">
                            {{-- @csrf --}}
                            <div class="card-body row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-search h4 text-body"></i>
                                </div>
                                <!--end of col-->
                              
                                <div class="col">
                                    <input class="form-control form-control-lg form-control-borderless" type="search" name ='search' placeholder="Search name or Search CNIC last 4 digits">
                                </div>
                                <!--end of col-->
                                <div class="col-auto">
                                    <button class="btn btn-lg btn-success" type="submit">Search</button>
                                </div>
                                <!--end of col-->
                            </div>
                        </form>
                    </div>
                    <!--end of col-->
                </div>          
                <table id="example1" class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>CNIC</th>
                        <th>Current Company</th>
                        <th>Joinning Date</th>
                        {{-- <th>Average Rating</th> --}}
                        <th width="280px">Details</th>
                    </tr>
                    @if(!empty($listusers))
                    @foreach ($listusers as  $employee)
                   
                    <tr>
                       
                        <td>1</td>
                        <td>{{$employee->employee_name}}</td>
                        <td>{{$employee->employee_cnic}}</td>
                        <td>{{$employee->company_name}}</td>
                        <td>{{$employee->latest_joining_date}}</td>
                        {{-- <td> @for ( $i=1; $i<=5; $i++ )
                            @if ($i<=$employee->average_rating)
                            <span class="fa fa-star checked"></span>
                                  
                              @else
                              <span class="fa fa-star "></span>
                              @endif    
                        @endfor  </td> --}}
                        {{-- <td>{{$employee->average_rating}}</td> --}}
                        <td><a href="{{ route('employees.detailsindex',$employee->employee_cnic) }}">Show details</a></td>
                     
                    </tr>
                    @endforeach
                    @endif
                </table>

</section>
</div>
</div>
</div>
</div>


@include('includes.admin.footer')
@include('includes.admin.scripts')
@include('includes.admin.validationScript')
@stop