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
                <h2>Employees History </h2>
            </div>
            <div class="pull-right d-none">
                @can('employee-create')
                <a class="btn btn-success" href="{{ route('employeehistory.create') }}"> Add New history of Employee </a>
                @endcan
            </div>
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
            {{-- <th>Job Description</th>
            <th>Salary</th>
            <th>Location</th> --}}
            {{-- <th>Reviews & Ratings</th> --}}
            <th>Reviews & Ratings</th>
            <th>Remarks</th>
            <th>Joinning Date</th>
            <th>Ending Date</th>
            <th width="280px">Action</th>
        </tr>

        {{-- @foreach($users->employees as $p) 
        <h1>{{$p->name}}</h1>
        @endforeach --}}
      
	    @foreach ($listusers as $employeeHistory)
	    <tr>
            
           
	        <td>{{ ++$i }}</td>
	        <td>{{  $employeeHistory->employees_name }}</td>
            <td>{{ $employeeHistory->users_name}}</td>
            <td>{{ $employeeHistory->position }}</td>
            {{-- <td>{{ $employeeHistory->job_desc }}</td>
            <td>{{ $employeeHistory->salary }}</td>
            <td>{{ $employeeHistory->location}}</td> --}}
            <td> @for ( $i=1; $i<=5; $i++ )
                @if ($i<=$employeeHistory->reviews)
                <span class="fa fa-star checked"></span>
                      
                  @else
                  <span class="fa fa-star "></span>
                  @endif    
            @endfor  </td>
            {{-- <td>{{ $employeeHistory->reviews }}</td> --}}
            <td>{{ $employeeHistory->remarks }}</td>
            <td>{{ $employeeHistory->start_date}}</td>
            <td>{{ $employeeHistory->end_date }}</td>
	        
	        <td>
                <form action="{{ route('employeehistory.destroy',$employeeHistory->id) }}" method="POST">
                    <a class="btn btn-xs btn-info" href="{{ route('employeehistory.show',$employeeHistory->id) }}"><i class="fas fa-eye"></i></a>
                    @can('employee-edit')
                    <a class="btn btn-xs btn-primary" href="{{ route('employeehistory.edit',$employeeHistory->id) }}"><i class="fas fa-pencil-alt"></i></a>
                     @endcan


                    @csrf
                    @method('DELETE')
                    @can('employee-delete')

                    {!! Form::open(['method' => 'DELETE','route' => ['employeehistory.destroy', $employeeHistory->id],'style'=>'display:inline']) !!}
                    <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                    {!! Form::close() !!}

                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>

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
          ajax: '{{ @url("/employeehistory") }}',
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