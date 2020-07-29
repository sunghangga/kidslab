
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
              <!-- <?php echo form_open_multipart('register/import_excel', array('name' => 'spreadsheet')); ?>
                  <p>Upload Data Registration</p>
                  <input  type="file" name="regis">
                  <button class="btn btn-success btn-sm" type="submit" name="import"><i class="fas fa-file-upload"></i>Upload</button>
              <?php echo form_close(); ?> -->
              <form method="POST" action="<?php echo base_url() ?>register/import_excel" enctype="multipart/form-data">
                  <h5>UPLOAD REGISTRATION DATA</h5>
                  <input type="file" name="upload_file">
                  <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-file-upload"></i> Upload</button>
              </form>
            </div>
                <div class='card-header'>
                    <div class="row">
                    <div class="col">
                        <h3 class='card-title'>REGISTER LIST <?php echo anchor('register/create/','Create',array('class'=>'btn btn-primary btn-sm'));?></h3>
                    </div>
                <div class="col">
                    <div class="col input-group date" data-target-input="nearest" id="inputPeriod">
                      <input type="text" class="form-control datetimepicker-input" data-target="#inputPeriod" placeholder="Period"  name="period" id="period"/>
                      <div class="input-group-append" data-target="#inputPeriod" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                      </div>
                    </div>
                    
                     
                </div><!-- /.input group -->
                <div class='col'>
                  <select class="col form-control select2bs4" onchange="classroom_list()" name="class_type_id" id="class_type_id" placeholder="Class Type" value="<?php echo $class_type_id; ?>" />
                  <?php 
                      foreach ($get_all_classtype as $row)
                      {
                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                      } 
                  ?>
                 </select>
                </div>
                <div class='col'>
                  <select class="col form-control select2bs4" id="classroom_id" name="classroom_id">
                    <?php 
                    foreach ($get_all_classroom as $row)
                        {
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        } ?>
                    >
                  </select>
               </div>
            </div><!-- row -->
            </div><!-- /.card-header -->
            
        <div class='card-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>Reg Code</th>
		    <th>Child Name</th>
		    <th>Parent Name</th>
		    <th>Phone</th>
		    <th>Email</th>
		    <th>Address</th>
		    <th>Birth Date</th>
		    <th>Period</th>
		    <th>Class Type Id</th>
		    <th>Classroom Id</th>
		    <th>Note</th>
		    <th>Create At</th>
		    <th>Update At</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
        </table>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section><!-- /.content -->
      <script src="<?php echo base_url('template/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
        <script src="<?php echo base_url() ?>assets/bootstrap/js/moment.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // panggil pertama
                $('#inputPeriod').datetimepicker({
                  format: 'YYYY-MM'
                })
               $('.select2bs4').select2({
                  theme: 'bootstrap4'
                }) 

                get_all();
                
            });

            function classroom_list(){
            var elem = document.getElementById("class_type_id");
            var id = elem.options[elem.selectedIndex].value;
            $.ajax({
                type : 'ajax',
                url : '<?php echo base_url()?>register/get_classroom_list/'+id,
                // async : false,
                dataType : 'json',
                success : function(data){
                  var html = '';
                  var i;

                  for(i=0; i<data.length; i++){

                      html += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                  }
                  $('#classroom_id').html(html);
                }
            });
          }

            function get_all(){
                var class_type = document.getElementById("class_type_id").value;
                var classroom = document.getElementById("classroom_id").value;
                var date = document.getElementById("inputPeriod").value;
                var count = 0;
                var table = $("#mytable").DataTable({
                    scrollY: "400px",
                    scrollX: true,
                    scrollCollapse: true,
                    destroy: true,
                    paging: true,
                    searching: true,
                    "ajax": {
                        "url": "<?php echo base_url()?>register/get_data_range/",
                        "dataSrc": "",
                        "data": function(data) {
                          data.class_type = class_type;
                          data.classroom = classroom;
                          data.date = date;
                        },
                      },
                      "columns": [
                          { "data": null,
                              render: function ( data, type, row ) { 
                                    return count+=1;
                                }
                          },
                          { "data": "reg_code"},
                          { "data": "child_name" },
                          { "data": "parent_name" },
                          { "data": "phone" },
                          { "data": "email"},
                          { "data": "address"},
                          { "data": "birth_date" },
                          { "data": "period" },
                          { "data": "class_type" },
                          { "data": "class_name"},
                          { "data": "note"},
                          { "data": "create_at" },
                          { "data": "update_at" },
                          { "data": null,
                                render: function ( data, type, row ) {
                                   return '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" style="flex-wrap: nowrap;">'+
                                      '<div class="btn-group" title="view" role="group" aria-label="First group">'+
                                        '<button id="info" style="margin-left: 5px;" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button></div>'+
                                      '<div class="btn-group" title="edit"role="group" aria-label="Second group">'+
                                        '<button id="update" style="margin-left: 5px;" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button></div>'+
                                      '<div class="btn-group" role="group" aria-label="fourth group">'+
                                        '<button id="delete" title="delete" style="margin-left: 5px;" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></i></button></div>'+
                                    '</div>';
                              }
                          },
                      ]
                });

                $('#mytable').on( 'click', '#info', function (e) {
                e.preventDefault();
                  var data = table.row( $(this).parents('tr') ).data();
                  if (data != null) {
                    window.location = '<?php echo base_url()?>register/read/'+data.id;
                  }
              } );
              $('#mytable').on( 'click', '#update', function (e) {
                e.preventDefault();
                  var data = table.row( $(this).parents('tr') ).data();
                  if (data != null) {
                    window.location = '<?php echo base_url()?>register/update/'+data.id;
                  }
              } );

                $('#mytable').on( 'click', '#delete', function (e) {
                  e.preventDefault();
                  var data = table.row( $(this).parents('tr') ).data();
                  if (data != null) {
                    Swal.fire({
                      title: "Confirmation",
                      text: "Are your sure want to delete Registration No."+data.reg_code+" ?",
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, confirm it!'
                    })
                    .then((result) => {
                      if (result.value) {
                        Swal.fire({
                          icon: 'success',
                          title: 'Your receipt has been confirm!',
                          showConfirmButton: false,
                          timer: 1000,
                          onClose: () => {
                            //menggunakan ajax agar tidak perlu load page
                            $.ajax({
                                type : "POST",
                                url  : "<?php echo base_url('register/delete')?>",
                                dataType : "JSON",
                                data : {id: data.id},
                                success: function(data){
                                    get_all();
                                }
                            });
                            return false;
                          }
                        })
                      } else {
                        Swal.fire({
                          icon: 'error',
                          title: 'Your request has been canceled!',
                          showConfirmButton: false,
                          timer: 1000
                        })
                      }
                    });
                  }
              } );
            }
        </script>