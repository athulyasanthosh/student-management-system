@extends('layouts.app')
@section('content')

<div class="container">
    <div class="right_col" role="main" style="min-height: 3823px;">
        <div class="">
             <div class="row">
               <div class="col-md-12 col-sm-12 ">
                 <div class="x_panel">
                   <div class="x_title">
                     <h2>Edit Students</h2>                
                     <div class="clearfix"></div>
                   </div>

                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Whoops!</strong> There were some problems with your input.<br>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                   <div class="x_content">
                     <br>
                     <form method="POST" action="{{route('student.update', $student->id)}}" id="create-student-form" data-parsley-validate class="form-horizontal form-label-left">
                        @method('PATCH')
                        @csrf
                       <div class="item form-group">
                         <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 ">
                           <input type="text" id="name" name="name" required="required" class="form-control" value="{{ $student->name}}">
                         </div>
                       </div>
                       
                       <div class="item form-group">
                         <label class="col-form-label col-md-3 col-sm-3 label-align" for="dob">Date of Birth <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 ">
                           <input type="date" id="dob" name="dob" required="required" class="form-control" value="{{ $student->dob}}">
                         </div>
                       </div>
     
                       <div class="item form-group">
                         <label class="col-form-label col-md-3 col-sm-3 label-align" for="gender">Gender<span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 ">
                           <label><input type="radio" name="gender" value="F" {{ ($student->gender == 'F') ? 'checked' : ''}}>Female</label>
                           <label><input type="radio" name="gender" value="M" {{($student->gender == 'M') ? 'checked' : ''}}>Male</label>
                         </div>
                       </div>

                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="mobile">Mobile Number<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="mobile" name="mobile" required="required" class="form-control" value="{{ $student->mobile}}">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="email" name="email" required="required" class="form-control" value="{{ $student->email}}">
                        </div>
                      </div>
     
                       <div class="item form-group">
                         <label class="col-form-label col-md-3 col-sm-3 label-align" for="country">Country <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 ">
                           <select name="country" required="required" class="form-control country">
                            <option value="">Select</option>
                            @foreach ($countries as $country => $value)
                             <option value="{{ $country }}" {{$country == $student->country ? 'selected' : ''}}> {{ $value }}</option> 
                            @endforeach                      
                           </select>
                         </div>
                       </div>

                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="state">State <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <select name="state" required="required" class="form-control state" data-state= "{{$student->state}}">
                            <option value="">Select</option>
                            @foreach ($states as $state)
                            <option value="{{ $state->id }}" {{$state->id == $student->state ? 'selected' : ''}}> {{ $state->state_name }}</option> 
                            @endforeach   
                          </select>
                        </div>
                      </div>
     
                       <div class="ln_solid"></div>
                       <div class="item form-group">
                         <div class="col-md-6 col-sm-6 offset-md-3">
                           <a href="{{route('student.index')}}" class="btn btn-primary">Cancel</a>
                           <button type="submit" class="btn btn-success">Update Students</button>
                         </div>
                       </div>                       
                     </form>                     
                   </div>
                 </div>
               </div>
             </div>
          </div>
      </div>
</div>

@endsection

@section('script')
<script>
   $(document).ready(function() {
       $("select.country").change(function(){
            var selectedCountry = $(".country option:selected").val();

            $.ajax({
                type: "POST",
                url: "{{route('getStates')}}",
                data: { country : selectedCountry } ,
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            }).done(function(data){
                var htmldata ='';
                jQuery.each(data, function(index, itemData) {
                    htmldata += '<option value="'+itemData.id+'">'+itemData.state_name+'</option>';                
                });
                $('.state').html(htmldata);
            });
        });


    });

</script>
@endsection