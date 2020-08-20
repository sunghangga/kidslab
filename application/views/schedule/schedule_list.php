
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <div class="row">
                    <div class="col">
                  <h3 class='card-title'>SCHEDULE LIST <button id=schedule_excel type="button" class="btn btn-success btn-sm"><i class="fas fa-file-pdf"></i> Excel</button></h3>
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
              </div>
                </div><!-- /.card-header -->
                <div class='card-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>Reg Code</th>
		    <th>Child Name</th>
        <th>Parent Name</th>
		    <th>Period</th>
		    <th>Class Type</th>
		    <th>Online Class</th>
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

            $("#schedule_excel").click(function(){
              var class_type = document.getElementById("class_type_id").value;
              var classroom = document.getElementById("classroom_id").value;
              var date = document.getElementById("period").value;
              window.open('<?php echo base_url()?>register/schedule_excel?ct='+class_type+'&c='+classroom+'&d='+date, '_blank');
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

            function get_all(){
              var class_type = document.getElementById("class_type_id").value;
                var classroom = document.getElementById("classroom_id").value;
                var date = document.getElementById("period").value;
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
                          { "data": "period" },
                          { "data": "class_name" },
                          { "data": "class_type" },
                      ],
                      "columnDefs": [
                          { targets: 1, "width": "120px" },
                          { targets: [2,3], "width": "300px" },
                          { targets: 4, "width": "120", render: function(data){return moment(data).format('MMMM YYYY'); }},
                          { targets: 5, "width": "150px" },
                      ]
                });
            }
        </script>