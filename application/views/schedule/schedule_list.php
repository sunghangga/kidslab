
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>SCHEDULE LIST </h3>
                </div><!-- /.card-header -->
                <div class='card-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>Reg Code</th>
		    <th>Child Name</th>
		    <th>Period</th>
		    <th>Class Type</th>
		    <th>Classroom</th>
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
        <script src="<?php echo base_url() ?>assets/bootstrap/js/moment.js"></script>
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
                        "url": "<?php echo base_url()?>register/schedule_list/",
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
                          { "data": "child_name" },
                          { "data": "period" },
                          { "data": "class_name" },
                          { "data": "class_type" },
                      ],
                      "columnDefs": [
                          { targets: 1, "width": "120px" },
                          { targets: 2, "width": "300px" },
                          { targets: 3, "width": "120", render: function(data){return moment(data).format('MMMM YYYY'); }},
                          { targets: 4, "width": "150px" },
                      ]
                });
            }
        </script>