@extends('layouts.template')
@section('css')
<link href="vendors/data-table/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/data-table/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/data-table/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/data-table/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@stop
@section('pageContent')
		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Data Department</h3>
              </div>
            </div>
            <div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
               			<div class="x_panel">
                  			<div class="x_content">                    
                    			<table id="datatable" class="table table-striped table-bordered">
                      				<thead>
				                        <tr>
				                          <th>Name</th>
				                          <th>Alias</th>
				                          <th>Action</th>
				                        </tr>
                      				</thead>
                      				<tbody>
                      				{{--@if($departments == null) 
                      					<tr>
                      						<td colspan="3" align="center">NO DATA</td>
                      					</tr>
                      				@else --}}
	                      				@foreach($departments as $department)
	                      					<tr>
	                      						<td>{{ $department->name }}</td>
	                      						<td>{{ $department->alias }}</td>
	                      						<td class="center">
	                                    <a id="edit" class="btn btn-info" 
                                       href="/department/{{ $department->id }}">
	                                        <i class="glyphicon glyphicon-edit icon-white"></i>
	                                        Edit
	                                    </a>
	                                    <button type="button" class="btn btn-danger"
                                       onclick="checkDelete({{ $department->id }}, this);" 
                                       data-token="{{ csrf_token() }}">
	                                        <i class="glyphicon glyphicon-trash icon-white"></i>
	                                        Delete
	                                    </a>
		                                </td>
	                      					</tr>
	                      				@endforeach
	                      			{{-- @endif --}}
				                    </tbody>
                    			</table>
                  			</div>
                		</div>
              		</div>
              	</div>
            </div>
        </div>
@stop
@section('js')
<!-- Datatables -->
{{-- <script src="vendors/data-table/datatables.net/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="vendors/data-table/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vendors/data-table/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="vendors/data-table/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script --}}>
{{-- <script src="vendors/data-table/datatables.net-scroller/js/datatables.scroller.min.js"></script>   --}}
<!-- Datatables -->
    <script>
      // $(document).ready(function() {
      //   $('#datatable').dataTable();
      // });
      function checkDelete(id, row) {
        if (confirm('Really delete?')) {
          var request = $.ajax({
            url: 'department/' + id,
            type: 'DELETE',
            data: {
                "_method": "delete",
                "_token": "{{ csrf_token() }}",
            },
          });
           
          request.done(function() {
            console.log(row.closest('tr'));
            row.closest('tr').remove(); 
          });
           
          request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
          });
        //   $.ajax({
        //     type: "DELETE",
        //     url: '/department/' + id,
        //     success: function(result) {
        //       $(this).closest('tr').remove(); 
        //     },
        //     fail: function(){
        //       console.log("5");
        //     }

        //   });
        //   console.log("3");
        }
      }
    </script>
<!-- /Datatables -->
@stop