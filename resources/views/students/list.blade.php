@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Students List</h2>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="col-md-6">				
            <a href="{{route('student.create')}}" class="btn btn-primary">Add Student</a>
        </div>

        <div class="row">
			<div class="col-md-12">
				<table class="table table-striped projects">
					<thead>						
						<tr>
							<th>ID</th>
							<th>Student Name</th>
							<th>Age</th>
							<th>Gender</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>Country</th>
							<th>State</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse($studentData as $student)
						<tr>
				  	      	<td>{{ $student->id }}</td>            
				  	      	<td>{{ $student->name }}</td>
				  	      	<td>{{ $student->dob }}</td>
				  	      	<td>{{ $student->gender == 'F'? 'Female': 'Male' }}</td>
				  	      	<td>{{ $student->mobile }}</td>
							<td>{{ $student->email }}</td>
							<td>{{$student->countryName->name}}</td>
							<td>{{$student->stateName->state_name}}</td>
				  	      	<td><a href="{{route('student.edit',$student->id)}}" class="btn btn-info">Edit</a>
                                      
                        	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$student->id}})">Delete</button></td>
						</tr>
					@empty
                    <tr>
					    <td colspan="6"><center>No Data For Listing</center></td>
					 </tr>
                    @endforelse
                    </tbody>
				</table>

				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="deleteModal">
                  	<form method="POST" action="" id="delete-form"> 
                            @method('DELETE')
                            @csrf    
                    	<div class="modal-dialog modal-lg">
	                      	<div class="modal-content">
	                        	<div class="modal-header">
		                          	<h4 class="modal-title" id="myModalLabel">Delete Student</h4>
		                          	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		                          </button>
		                        </div>
	                        	<div class="modal-body">
	                          		<p>Are You Sure Want To Delete ?</p>
	                        	</div>
	                        	<div class="modal-footer">
	                           
	                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                              <button type="submit" class="btn btn-danger" onclick="formSubmit()">Delete</button>
	                        	</div>
	                      	</div>
                    	</div>
                  	</form>
                 </div>
			</div>
		</div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function deleteData(id)
    {
        var category_id = id;
        var url = '{{ route("student.destroy", ":id") }}';
        url = url.replace(':id', category_id);
        jQuery("#delete-form").attr('action', url);
        
    }
  </script>
@endsection