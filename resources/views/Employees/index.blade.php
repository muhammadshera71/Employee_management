@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')

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
                <h2>Employees </h2>
            </div>
            <div class="pull-right d-none">
                @can('employee-create')
                <a class="btn btn-success" href="{{ route('employees.create') }}"> Add New Employees </a>
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
            <th>CNIC</th>
            <th width="280px">Action</th>
        </tr>

        {{-- @foreach($users->employees as $p) 
        <h1>{{$p->name}}</h1>
        @endforeach --}}
      
	    @foreach ($listusers as $employee)
	    <tr>
           
	        <td>{{ ++$i }}</td>
	        <td>{{ $employee->name }}</td>
            <td>{{ $employee->cnic}}</td>
	        <td>
                <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                    <a class="btn btn-xs btn-info" href="{{ route('employees.show',$employee->id) }}"><i class="fas fa-eye"></i></a>
                    @can('employee-edit')
                    <a class="btn btn-xs btn-primary" href="{{ route('employees.edit',$employee->id) }}"><i class="fas fa-pencil-alt"></i></a>
                     @endcan


                    @csrf
                    @method('DELETE')
                    @can('employee-delete')

                    {!! Form::open(['method' => 'DELETE','route' => ['employees.destroy', $employee->id],'style'=>'display:inline']) !!}
                    <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                    {!! Form::close() !!}

    

                    {{-- <button type="submit" class="btn btn-danger">Delete</button> --}}
                    @endcan
                </form>
	        </td>
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