@extends('layouts.template')

@section('css')
<!-- bootstrap-daterangepicker -->
<link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<!-- Select2 -->
<link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@stop
@section('pageContent')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Event List</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="POST" 
                     action="{{ url('/event') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type <span class="required">*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="type" class="select2_single form-control" >
                            <option value="0">Workshop</option>
                            <option value="1">Seminar</option>
                            <option value="2">Annual Event</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pay">Pay<span class="required">*</span>
                        </label>
                        <div class="row">
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <input type="checkbox" name="pay" 
                                 onclick="
                                  if(this.checked) {
                                    document.getElementById('pay').disabled = false;
                                    document.getElementById('pay').focus();
                                  }else{
                                    document.getElementById('pay').disabled = true;
                                    document.getElementById('pay').value = 0;
                                  }" />
                              </span>
                              <input type="text" id="pay" name="price" 
                              disabled="true" class="form-control">
                            </div>
                          </div>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Time <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="datetime" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="capacity">Capacity<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="capacity" name="capacity" required="required" data-validate-length-range="1,3" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">For <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="for[]" class="select2_multiple form-control" multiple="multiple">
                            @foreach($departments as $department)
                              <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="1" name="name" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">Location <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="location" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="1" name="location" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image <span class="required">*</span>
                        </label>
                        <div class="checkbox col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image" accept=".jpg, .png, .gif">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="poster">Poster <span class="required">*</span>
                        </label>
                        <div class="checkbox col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="poster" accept=".jpg, .png, .gif">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                        </label>
                        <div class="checkbox col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" required="required" class="form-control" name="description" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="255" data-parsley-validation-threshold="10"></textarea>
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
<!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        $('#birthday').daterangepicker({
          locale: {
            format: 'DD-MM-YYYY H:mm'
          },
          singleDatePicker: true,
          timePicker: true,
          timePicker24Hour: true,
          timePickerIncrement: 30,
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
          placeholder: "Choose Type",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: "",
          placeholder: "Unlimited",
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