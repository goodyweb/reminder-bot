<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <h2 style="text-align: center;">User Management </h2>
    <h2 style="text-align: right;"><a class="btn btn-primary pull-right" onClick="add()"  href="javascript:void(0)"> Add User</a></h2>
    <table id='usersTable' width='100%'>
      <thead>
        <tr>
          <td>#No</td>
          <td>Name</td>
          <td >Email</td>
          <td>Action</td>
       
        </tr>
      </thead>
      
    </table>
    <!-- boostrap User model -->
  <div class="modal fade" id="user-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="UserModal"></h4>
        </div>

        <div class="modal-body">
          <form action="javascript:void(0)" id="UserForm" name="UserForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">User Name</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name" maxlength="50" required="">
              </div>
            </div>  
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">User Email</label>
              <div class="col-sm-12">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter User Email" maxlength="50" required="">
              </div>
            </div>
     
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary" id="btn-save">Save changes
              </button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
      </div>
    </div>
  </div>
  <!-- end bootstrap model -->
</body>
<script type="text/javascript">
      $(document).ready( function () {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('users')}}",
        columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
         
          //{ data: 'created_at', name: 'created_at' },
          {data: 'action', name: 'user-action', orderable: false},
        ],
        order: [[0, 'desc']]
        });
      });
      function add(){
        $('#UserForm').trigger("reset");
        $('#UserModal').html("Add User");
        $('#user-modal').modal('show');
        $('#id').val('');
      }   
      function editFunc(id){
        $.ajax({
          type:"POST",
          url: "{{ url('edit-user') }}",
          data: { id: id },
          dataType: 'json',
          success: function(res){
            $('#UserModal').html("Edit User");
            $('#user-modal').modal('show');
            $('#id').val(res.id);
            $('#name').val(res.name);
            $('#email').val(res.email);
          }
        });
      }  
      function deleteFunc(id){
        if (confirm("Delete Record?") == true) {
          var id = id;
          // ajax
          $.ajax({
            type:"POST",
            url: "{{ url('delete-user') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              var oTable = $('#usersTable').dataTable();
                oTable.fnDraw(false);
            }
          });
        }
      }

      $('#UserForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
          $.ajax({
            type:'POST',
            url: "{{ url('store-user')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
              $("#user-modal").modal('hide');
              var oTable = $('#usersTable').dataTable();
              oTable.fnDraw(false);
              $("#btn-save").html('Submit');
              $("#btn-save"). attr("disabled", false);
            },
            error: function(data){
            console.log(data);
            }
          });
      });
      </script>
</x-app-layout>