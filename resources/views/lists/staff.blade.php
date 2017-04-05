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
                <h3>Data Staff</h3>
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
                                  <th>SID</th>
                                  <th>Name</th>
                                  <th>Gender</th>
                                  <th>Date of Birth</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($staffs as $staff)
                                <tr>
                                  <td>{{$staff->sid}}</td>
                                  <td>{{$staff->name}}</td>
                                  <td>{{$staff->gender == 0 ? 'Male' : 'Female'}}</td>
                                  <td>{{$staff->birthdate->format('d M Y')}}</td>
                                 <td class="center">
                                    <a id="edit" class="btn btn-info" 
                                     href="/staff/{{ $staff->id }}">
                                        <i class="glyphicon glyphicon-edit icon-white"></i>
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-danger"
                                     onclick="checkDelete({{ $staff->id }}, this);" 
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
  text: "You will erase the staff from your database!",
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
    url: 'staff/' + id,
    type: 'DELETE',
    data: {
          "_method": "delete",
          "_token": "{{ csrf_token() }}",
          },
    });
    console.log(row.closest('tr'));
    row.closest('tr').remove(); 
    swal("Deleted!", "The staff has been deleted.", "success");
  } else {
    swal("Cancelled", "Cancelled", "error");
  }
});
}
 
</script>
@stop