@extends('layouts.app')
@section('content')
    <div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Students Marks List</h2>
			</div>
			<div class="col-md-6">				
				<a href="{{route('mark.create')}}" class="btn btn-primary">Add Marks</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped projects">
					<thead>						
						<tr>
							<th>ID</th>
							<th>Student Name</th>							
							<th>Maths</th>
							<th>Science</th>
							<th>Maths</th>
							<th>Term</th>							
							<th>Total Marks</th>
							<th>Created On</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse($studentMarks as $studentmark)
						<tr>
				  	      	<td>{{ $studentmark->id }}</td>            
				  	      	<td>{{ $studentmark->student->name }}</td>				  	      	
				  	      	<td>{{ $studentmark->maths }}</td>
				  	      	<td>{{ $studentmark->science }}</td>
				  	      	<td>{{ $studentmark->computer }}</td>
							<td>{{ $studentmark->term->term }}</td>
				  	      	<td>{{
				  	      		$studentmark->maths + $studentmark->science + $studentmark->computer
				  	      	}}</td>
				  	      	<td>
				  	      		{{ \Carbon\Carbon::parse($studentmark->created_at)->format('M d, Y h:i')}}</td>
				  	      	<td><a href="{{route('mark.edit',$studentmark->id)}}" class="btn btn-info">Edit</a>
                                      
                        	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$studentmark->id}})">Delete</button></td>
						</tr>
					@empty
					<tr>
					    <td colspan="9"><center>No Data For Listing</center></td>
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
@endsection
@section('script')
<script type="text/javascript">
    function deleteData(id)
    {
        var mark_id = id;
        var url = '{{ route("mark.destroy", ":id") }}';
        url = url.replace(':id', mark_id);
        jQuery("#delete-form").attr('action', url);
        
    }
  </script>
@endsection