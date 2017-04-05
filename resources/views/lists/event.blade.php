@extends('layouts.template')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('vendors/datatables/dataTables.bootstrap.css') }}">
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
<!-- DataTables -->
<script src="{{ asset('vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
  $(function () {
    $("#datatable").DataTable();
  });
</script>
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