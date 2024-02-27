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
        {{-- <form > 
            <div class="input-group rounded">
                <input type="search" name="search" class="form-control rounded" placeholder="Search Name or CNIC" aria-label="Search" aria-describedby="search-addon" value={{$search}} >
                <span class="input-group-text border-0" id="search-addon">
                    <button class="fas fa-search"> </button>
                </span>
              </div>
        </form> --}}
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employee details </h2>
            </div>
            {{-- <div class="pull-right d-none">
                @can('employee-create')
                <a class="btn btn-success" href="{{ route('employees.create') }}"> Add New Employees </a>
                @endcan
            </div> --}}
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table id="example1" class="table table-bordered table-striped">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>Job Title</th>
            <th>Job Description</th>
            <th>Salary</th>
            <th>Location</th>
            {{-- <th>Reviews & Ratings</th> --}}
            <th>Reviews & Ratings</th>
            <th>Remarks</th>
            <th>Joinning Date</th>
            <th>Ending Date</th>
        </tr>

      
	    @foreach ($employees as $employee)
	    <tr>
           
	        <td>{{ ++$i }}</td>
	        <td>{{ $employee->employees_name }}</td>
            <td>{{ $employee->users_name}}</td>
            <td>{{ $employee-> position }}</td>
            <td>{{ $employee-> job_desc }}</td>
            <td>{{ $employee-> salary }}</td>
            <td>{{ $employee-> location}}</td>
            <td> @for ( $i=1; $i<=5; $i++ )
                @if ($i<=$employee->reviews)
                <span class="fa fa-star checked"></span>
                      
                  @else
                  <span class="fa fa-star "></span>
                  @endif    
            @endfor  </td>
       
            <td>{{ $employee-> remarks }}</td>
            <td>{{ $employee-> start_date}}</td>
            <td>{{ $employee-> end_date }}</td>

	    </tr>
	    @endforeach
    </table>

    {{-- {!! $employee->links() !!} --}}
</div>
</section>

</div>

@include('includes.admin.footer')
@include('includes.admin.scripts')

<script type="text/javascript">
    $(function () {
      
      var table = $('#example1').DataTable({
        
          processing: true,
          serverSide: true,
          ajax: '{{ @url("/employees") }}',
          columns: [
              // {data: 'id', name: 'id'},
              { data: 'rownum', name: 'rownum', orderable: false, searchable: false },
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'roles', name: 'roles'},
              {data: 'action', name: 'action', orderable: false, searchable: true},
          ]
      });
      table.on('draw.dt', function () {
          table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
              cell.innerHTML = i + 1;
          });
      });
      //console.log(table);
    });
        
  </script>



@stop