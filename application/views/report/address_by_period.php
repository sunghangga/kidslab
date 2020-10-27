
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                <div class="row">
                  <div class="col">
                  <h3 class='card-title'>ADDRESS LIST 
                    <button id=address_pdf type="button" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                  </h3>
                </div>
                <div class='col-md-auto'>
                  <select class="col form-control select2bs4" name="ship_status" id="ship_status" placeholder="Shipment Status" />
                  <?php 
                      echo '<option value="" selected>-- ALL --</option>';
                      echo '<option value="1">SEND</option>';
                      echo '<option value="0">NOT SEND</option>'; 
                  ?>
                 </select>
                </div>
                <div class="col-md-2">
                    <div class="col input-group date" data-target-input="nearest" id="inputPeriod">
                      <input type="text" class="form-control datetimepicker-input" data-target="#inputPeriod" placeholder="Period"  name="period" id="period"/>
                      <div class="input-group-append" data-target="#inputPeriod" data-toggle="datetimepicker">
                          <div class="input-group-text" id="input_btn_calendar"><i class="far fa-calendar-alt"></i></div>
                      </div>
                    </div>
                </div><!-- /.input group -->
                <div class='col-md-auto'>
                  <select class="col form-control select2bs4" onchange="classroom_list()" name="class_type_id" id="class_type_id" placeholder="Class Type" value="<?php echo $class_type_id; ?>" />
                  <?php 
                      echo '<option value="" selected>-- ALL --</option>';
                      foreach ($get_all_classtype as $row)
                      {
                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                      } 
                  ?>
                 </select>
                </div>
                <div class='col-md-auto'>
                  <select class="col form-control select2bs4" id="classroom_id" name="classroom_id">
                    <?php 
                    echo '<option value="" selected>-- ALL --</option>';
                    foreach ($get_all_classroom as $row)
                        {
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        } ?>
                    >
                  </select>
               </div>
               <button class="btn btn-info btn-md" onclick="get_all()"><i class="fas fa-search"></i></button>
              </div><!-- row -->
                </div><!-- /.card-header -->
                <div class='card-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
            		    <th>Reg Code</th>
                    <th>Ship Status</th>
            		    <th>Child Name</th>
                    <th>Parent Name</th>
                    <th>Address</th>
            		    <th>Period</th>
            		    <th>Class Type</th>
            		    <th>Classroom</th>
                    <th>Note</th>
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

                  html += '<option value="" selected>-- ALL --</option>';
                  for(i=0; i<data.length; i++){

                      html += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                  }
                  $('#classroom_id').html(html);
                }
            });
            // get_all();
          }

            $("#address_pdf").click(function(){
              var class_type = document.getElementById("class_type_id").value;
              var classroom = document.getElementById("classroom_id").value;
              var date = document.getElementById("period").value;
              var ship_status = document.getElementById("ship_status").value;
              window.open('<?php echo base_url()?>register/address_pdf?ss='+ship_status+'&ct='+class_type+'&c='+classroom+'&d='+date, '_blank');
            });

            function get_all(){
                var class_type = document.getElementById("class_type_id").value;
                var classroom = document.getElementById("classroom_id").value;
                var date = document.getElementById("period").value;
                var ship_status = document.getElementById("ship_status").value;
                var count = 0;
                var table = $("#mytable").DataTable({
                    scrollY: "400px",
                    scrollX: true,
                    scrollCollapse: true,
                    destroy: true,
                    paging: true,
                    searching: true,
                    "ajax": {
                        "url": "<?php echo base_url()?>register/address_list/",
                        "dataSrc": "",
                        "data": function(data) {
                            data.class_type = class_type;
                            data.classroom = classroom;
                            data.date = date;
                            data.ship_status = ship_status;
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
                          { "data": "address" },
                          { "data": "period" },
                          { "data": "class_name" },
                          { "data": "class_type" },
                          { "data": "note" },
                          { "data": null,
                                render: function ( data, type, row ) {
                                  return '<button id=per_address_pdf style="margin-left: 5px;" type="button" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></button>';
                              }
                          },
                      ],
                      "columnDefs": [
                          { targets: [3,4], "width": "120px" },
                          { targets: 5, "width": "300px" },
                          { targets: 9, "width": "100px" },
                          { targets: 6, "width": "120", render: function(data){return moment(data).format('MMMM YYYY'); }},
                      ]
                });
                $('#mytable').on( 'click', '#per_address_pdf', function (e) {
                  e.preventDefault();
                  var data = table.row( $(this).parents('tr') ).data();
                    if (data != null) {
                      window.open('<?php echo base_url()?>register/per_address_pdf/'+data.reg_id,'_blank');
                    }
                } );
            }
        </script>