@extends('layouts.template')
@section('css')
<!-- bootstrap-daterangepicker -->
<link href="{{ asset('/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<!-- Select2 -->
<link href="{{ asset('/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendors/dist/jquery-editable-select.min.css') }}" rel="stylesheet" />
@stop
@section('pageContent')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Student</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="/admin/student{{ $student != NULL ? '/' . $student->id : ''}}" enctype="multipart/form-data">
                    @if(isset($student))
                          {{ method_field('PUT') }}
                    @endif
                      {{ csrf_field() }}
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nim">NIM<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="nim" name="nim" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" {{$student != NULL ? 'disabled' : ''}} value="{{$student != NULL ? $student->nim : ''}}">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="1" name="name" required="required" type="text" value="{{$student != NULL ? $student->name : ''}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="gender" value="0" 
                              {{$student != NULL ? ($student->gender == 0 ? 'checked' : '') : ''}}> &nbsp; Male &nbsp;
                          </label>
                          <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="gender" value="1"
                              {{$student != NULL ? ($student->gender == 1 ? 'checked' : '') : ''}}> Female
                          </label>
                          </div>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="dob" value="{{$student != NULL ? $student->dob->format('d-m-Y') : ''}}" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" value="{{$student != NULL ? $student->email : ''}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Religion <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="religion" name="religion" class="form-control" >
                            <option value="0" {{$student != NULL ? ($student->religion == 0 ? 'selected' : '') : ''}}>Christian</option>
                            <option value="1" {{$student != NULL ? ($student->religion == 1 ? 'selected' : '') : ''}}>Buddha</option>
                            <option value="2" {{$student != NULL ? ($student->religion == 2 ? 'selected' : '') : ''}}>Islam</option>
                            <option value="3" {{$student != NULL ? ($student->religion == 3 ? 'selected' : '') : ''}}>Hindu</option>             
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Department <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="department" name="department" class="form-control">
                            @foreach($departments as $department)
                              <option value="{{ $department->id }}" {{ $student != NULL ? ($department->id == $student->department_id ? 'selected' : '') : '' }}> {{$department->name}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="class" name="class" class="form-control">
                              @foreach($classes as $class)
                                <option value="{{ $class->classname }}" {{ $student != NULL ? ($class->classname == $student->classname ? 'selected' : '') : '' }}> {{$class->classname}}</option>
                              @endforeach
                          </select>
                        </div>
                        
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Image <span class="required">*</span>
                        </label>
                        <div class="checkbox col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="photo" accept=".jpg, .png, .gif">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@stop
@section('js')
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- validator -->
<script src="{{ asset('vendors/validator/validator.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
<script type="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
{{-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> --}}
<script src="{{ asset('vendors/dist/jquery-editable-select.min.js') }}"></script>
 
    <script>
      $(document).ready(function() {
        $('#class').editableSelect();
      });
    </script>
<!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        $('#birthday').daterangepicker({
          locale: {
            format: 'DD-MM-YYYY'
          },
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
<!-- //bootstrap-daterangepicker -->
<!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Select your religion",
          allowClear: true
        });
        
      });
    </script>
<!-- /Select2 -->

<!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
<!-- /validator -->
@stop