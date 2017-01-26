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
                <h3>Data Student</h3>
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
				                          <th>NIM</th>
				                          <th>Name</th>
				                          <th>Gender</th>
				                          <th>Date of Birth</th>
                                  <th>Email</th>
                                  <th>Religion</th>
                                  <th>Class</th>
				                          <th>Image</th>
				                        </tr>
                      				</thead>
                      				<tbody>
				                        <tr>
				                          <td>Tiger Nixon</td>
				                          <td>System Architect</td>
				                          <td>Tiger Nixon</td>
				                          <td>System Architect</td>
				                          <td>System Architect</td>
                                  <td>Tiger Nixon</td>
                                  <td>System Architect</td>
                                  <td>Tiger Nixon</td>
				                        </tr>  
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
<script src="vendors/data-table/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/data-table/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vendors/data-table/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="vendors/data-table/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="vendors/data-table/datatables.net-scroller/js/datatables.scroller.min.js"></script>  
<!-- Datatables -->
    <script>
      $(document).ready(function() {
        $('#datatable').dataTable();
      });
    </script>
<!-- /Datatables -->
@stop