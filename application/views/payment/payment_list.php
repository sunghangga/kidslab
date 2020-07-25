
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>PAYMENT LIST </h3>
                </div><!-- /.card-header -->
                <div class='card-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Registrasi Code</th>
                    <th>Pay Status</th>
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
                        "url": "<?php echo base_url()?>payment/get_data_range/",
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
                          { "data": "pay_status",
                                render: function ( data, type, row ) { 
                                    if (data.pay_status == 0) {
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
            }
        </script>