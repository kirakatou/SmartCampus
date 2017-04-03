@extends('layouts.template')

@section('css')

<!-- bootstrap-daterangepicker -->
<link href="{{ asset('/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<!-- Select2 -->
<link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<!-- iCheck -->
<link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
@stop
@section('pageContent')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Confirmation</h3>
      </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form id="voucher" class="form-horizontal form-label-left" method="POST" action="/admin/payment">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Event<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="event" name="event" class="form-control" onchange="getEventData()">
                    <option disabled selected value></option>
                    @foreach($events as $event)
                      <option value="{{ $event->id }}"> {{$event->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no">No <span class="required">*</span>
                </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="no" name="no" class="select2_single form-control" tabindex="-1" onchange="getVoucherData()">
                      <option></option>
                    </select>
                  </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12"  name="name" type="text"
                      data-validate-length-range="6" data-validate-words="1" disabled >
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="price" class="form-control col-md-7 col-xs-12"  name="price" type="text" 
                      data-validate-length-range="6" data-validate-words="1" disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Receipt Date</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="receipt_date" name="receipt_date" class="date-picker form-control col-md-7 col-xs-12" type="text" disabled>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid">Confirm</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div class="checkbox">
                    <input type="checkbox" class="flat" id="paid" name="paid" />
                  </div>
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
<script type="text/javascript">
  // ES6 Modules or TypeScript
import swal from 'sweetalert2'

// CommonJS
const swal = require('sweetalert2');
</script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
<!-- validator -->
<script src="{{ asset('vendors/validator/validator.js') }}"></script>

<script type="text/javascript">
  function getEventData() {
    $id = document.getElementById("event").value;
    var request = $.ajax({
      url: '/admin/payment/' + $id,
      type: 'GET',
      dataType: "json", 
      encode: true
    });
    request.done(function(data) {
      $('#no').empty();
      $('#no')
          .append($("<option></option>"))
          .attr('selected',true);
      $.each(data, function(key, value) {   
       $('#no')
          .append($("<option></option>")
          .attr("value",value.id)
          .text(value.no)); 
      });
    }); 
    request.fail(function(data, textStatus, xhr) {
       console.log("error", data.status);
       console.log("STATUS: "+xhr);
    });
  }

  function getVoucherData(){
    $id =  document.getElementById("no").value;
    console.log('test');
    var request = $.ajax({
      url: '/admin/payment/voucher/' + $id,
      type: 'GET',
      dataType: "json",
      encode: true
    });
    request.done(function(data) {
      $('input[name=name]').val(data[0].name);
      $('input[name=price]').val(data[0].price);
      $('input[name=receipt_date]').val(data[0].receipt_date);
    }); 
    request.fail(function(data, textStatus, xhr) {
      console.log("error", data.status);
      console.log("STATUS: "+xhr);
    });
  }


  jQuery( document ).ready( function( $ ) {
    $("#voucher").on('submit', function(e) {
      e.preventDefault();
      var no = document.getElementById("no").value;
      var paid = $('input[name=paid]').val();
      console.log('masok');
      $.ajax({
        type: "POST",
        url: "/admin/payment/confirmation/" + no + "/" + paid,
        data: {
          "_method": "post",
          "_token": "{{ csrf_token() }}",
        },
        success: function(data) {
          console.log(data);
          $("#no").val($("#no option:first").val());
          $('input[name=name]').val('');
          $('input[name=price]').val('');
          $('input[name=receipt_date]').val('');
          $('input:checkbox[name=paid]').attr('checked',false);
          getEventData();
          if(data.status == 'success'){
            swal("Saved");
          }
          
        },
        error: function(data, textStatus, xhr) {
          console.log("error", data.status);
          console.log("STATUS: "+xhr);
        }
      });
    });
  });
  getEventData();
  getVoucherData();
</script>
<script>
  $(document).ready(function() {
    $('#receiptdate').daterangepicker({
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
<!-- validator -->
<script>
  validator.message.date = 'not a real date';
  $('form')
    .on('blur', 'input[required], input.optional, select.required', validator.checkField)
    .on('change', 'select.required', validator.checkField)
    .on('keypress', 'input[required][pattern]', validator.keypress);
  $('.multi.required').on('keyup blur', 'input', function() {
    validator.checkField.apply($(this).siblings().last()[0]);
  });
</script>
<!-- /validator -->
<!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Invoice Number",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->
@stop