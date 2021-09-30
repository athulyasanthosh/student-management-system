@extends('layouts.app')
@section('content')
<div class="container">
    <div class="right_col" role="main" style="min-height: 3823px;">
    <div class="">
            <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                <div class="x_title">
                    <h2>Add Student Marks</h2>                
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
                    <form method="POST" action="{{route('mark.store')}}" id="create-student-form" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="student_id">Student Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                        <select name="student_id" required="required" class="form-control">
                            <option value="">Select Student</option>
                            @foreach ($students as $student => $value)
                            <option value="{{ $value }}"> {{ $student }}</option> 
                            @endforeach                       
                        </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="term_id">Term <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                        <select name="term_id" required="required" class="form-control">
                            <option value="">Select Term</option>
                            @foreach ($terms as $term => $value)
                            <option value="{{ $value }}"> {{ $term }}</option> 
                            @endforeach                       
                        </select>
                        </div>
                    </div>                
                    
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="maths">Pleas enter Maths mark <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                        <input type="number" id="maths" name="maths" required="required" class="form-control">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="science">Pleas enter Science mark <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                        <input type="number" id="science" name="science" required="required" class="form-control">
                        </div>
                    </div>                 

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="computer">Pleas enter Computer mark <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                        <input type="number" id="computer" name="computer" required="required" class="form-control">
                        </div>
                    </div> 

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                        <a href="{{route('mark.index')}}" class="btn btn-primary">Cancel</a>
                        <button type="submit" class="btn btn-success">Add Student Marks</button>
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