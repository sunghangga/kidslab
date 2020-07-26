
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>SHIPMENT LIST </h3>
                </div><!-- /.card-header -->
                <div class='card-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Registrasi Code</th>
                    <th>Ship Status</th>
                    <th>Child Name</th>
                    <th>Parent Name</th>
                    <th>Phone</th>
                    <th>Email</th>
        		    <th>Create At</th>
        		    <th>Update At</th>
        		    <th>Action</th>
                </tr>
            </thead>
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
        <script type="text/javascript">
            $(document).ready(function () {
                get_all();
            });

            function get_all(){
                var count = 0;
                var table = $("#mytable").DataTable({
                    scrollY: "400px",
                    scrollX: true,
                    scrollCollapse: true,
                    destroy: true,
                    paging: true,
                    searching: true,
                    "ajax": {
                        "url": "<?php echo base_url()?>shipment/get_data_range/",
                        "dataSrc": "",
                        "data": function(data) {
                    
                        },
                      },
                      "columns": [
                          { "data": null,
                              render: function ( data, type, row ) { 
                                    return count+=1;
                                }
                          },
                          { "data": "reg_code"},
                          { "data": "ship_status",
                                render: function ( data, type, row ) { 
                                    if (data == 1) {
                                        return '<i class="fa fa-check-square" style="color: green;"></i>';
                                    }
                                    else {
                                        return '<i class="fa fa-minus-circle" style="color: red;"></i>';
                                    }
                                } 
                          },
                          { "data": "child_name" },
                          { "data": "parent_name" },
                          { "data": "phone" },
                          { "data": "email"},
                          { "data": "create_at" },
                          { "data": "update_at" },
                          { "data": null,
                                render: function ( data, type, row ) {
                                  return '<button id="confirm" title="confirm" class="btn btn-info btn-sm"><span class="fa fa-check" style="margin-right: 3px;"></span> | <span class="fa fa-ban" style="margin-left: 3px;"></span></button>';
                              }
                          },
                      ]
                });

                $('#mytable').on( 'click', '#confirm', function (e) {
                  e.preventDefault();
                  var data = table.row( $(this).parents('tr') ).data();
                  if (data != null) {
                    Swal.fire({
                      title: "Confirmation",
                      text: "Are your sure want to confirm Registration No."+data.reg_code+" ?",
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
                                url  : "<?php echo base_url('shipment/apply_shipment')?>",
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