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
                <h3>Data Event</h3>
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
                                  <th>Capacity</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($events as $event)
                                <tr>
                                  <td>{{ $event->name }}</td>
                                  <td>{{ $event->datetime->format('d M Y') }}</td>
                                  <td>{{ $event->location }}</td>
                                  <td>{{ $event->capacity }}</td>
                                  <td class="center">
                                    <a id="edit" class="btn btn-info" 
                                     href="/event/{{ $event->id }}">
                                        <i class="glyphicon glyphicon-edit icon-white"></i>
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-danger"
                                     onclick="javascript:checkDelete({{ $event->id }});" 
                                     data-token="{{ csrf_token() }}">
                                        <i class="glyphicon glyphicon-trash icon-white"></i>
                                        Delete
                                    </button>
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
function checkDelete(id, row) {
  swal({
  title: "Are you sure?",
  text: "You will erase the event from your database!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel plx!",
  closeOnConfirm: false,
  closeOnCancel: false
},

function(isConfirm){
  if (isConfirm) {
    $.ajax({
    url: 'event/' + id,
    type: 'DELETE',
    data: {
          "_method": "delete",
          "_token": "{{ csrf_token() }}",
          },
    });
    console.log(row.closest('tr'));
    row.closest('tr').remove(); 
    swal("Deleted!", "The event has been deleted.", "success");
  } else {
    swal("Cancelled", "Cancelled", "error");
  }
});
}
</script>
@stop