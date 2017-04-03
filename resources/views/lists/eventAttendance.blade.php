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
                <h3>Event List</h3>
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
				                          <th>Date Time</th>
                                  <th>Location</th>
                                  <th>Action</th>
				                        </tr>
                      				</thead>
                      				<tbody>
                              @foreach($events as $event)
				                        <tr>
				                          <td>{{ $event->name }}</td>
				                          <td>{{ $event->datetime->format('d M Y') }}</td>
				                          <td>{{ $event->location }}</td>
                                  <td class="center">
                                    <a id="sign_in" class="btn btn-info" href="/attendance/signin/{{$event->id}}">
                                        <i class="glyphicon glyphicon-edit icon-white"></i>
                                        SignIn
                                    </a>
                                    <a id="sign_out" class="btn btn-info" href="/attendance/signout/{{$event->id}}">
                                        <i class="glyphicon glyphicon-edit icon-white"></i>
                                        SignOut
                                    </a>
                                  </td>
				                        </tr>  
                              @endforeach
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
<script>
@stop