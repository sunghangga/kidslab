
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <div class="row">
                    <div class="col">
                  <h3 class='card-title'>PAYMENT LIST </h3>
                </div>
                <div class='col-md-auto'>
                  <select class="col form-control select2bs4" name="pay_status" id="pay_status" placeholder="Shipment Status" />
                  <?php 
                      echo '<option value="" selected>-- ALL --</option>';
                      echo '<option value="1">PAID</option>';
                      echo '<option value="0">NOT PAID</option>'; 
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
              </div>
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
                    <th>Class Type</th>
                    <th>Online Class</th>
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

        <!-- Modal -->
        <div class="modal fade" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Subscribe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <label class="control-label" style="font-size: 25px;">Choose Month</label>
                <input type="hidden" name="reg_id" id="reg_id" />
                <div class="col">
                    <div class="col input-group date" data-target-input="nearest" id="inputPeriodModal">
                      <input type="text" class="form-control datetimepicker-input" data-target="#inputPeriodModal" placeholder="Period"  name="periodModal" id="periodModal"/>
                      <div class="input-group-append" data-target="#inputPeriodModal" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="subsSubmitModal" type="button" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </section><!-- /.content -->
      <script src="<?php echo base_url('template/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // panggil pertama
                $('#inputPeriod').datetimepicker({
                  format: 'YYYY-MM'
                })
                $('#inputPeriodModal').datetimepicker({
                  format: 'YYYY-MM'
                })
               $('.select2bs4').select2({
                  theme: 'bootstrap4'
                }) 

               $('#subscribeModal').on('show.bs.modal', function (e) {
                  var reg_id = $(e.relatedTarget).data('id');
                  document.getElementById("reg_id").value = reg_id;
               });

               $("#subsSubmitModal").on("click", function(e) {
                  e.preventDefault();
                  var reg_id = document.getElementById("reg_id").value;
                  var subsDate = document.getElementById("periodModal").value;
                  $.ajax({
                      type : 'POST',
                      url : '<?php echo base_url()?>payment/subscribe/',
                      // async : false,
                      data : {id: reg_id, date: subsDate},
                      dataType : 'json',
                      success : function(data){
                        // console.log(data);
                      }
                  });
                  $('#subscribeModal').modal('toggle'); // hide modal after click submit
                  get_all();
                });

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

            function get_all(){
              var class_type = document.getElementById("class_type_id").value;
                var classroom = document.getElementById("classroom_id").value;
                var date = document.getElementById("period").value;
                var pay_status = document.getElementById("pay_status").value;
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
                          data.class_type = class_type;
                            data.classroom = classroom;
                            data.date = date;
                            data.pay_status = pay_status;
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
                          { "data": "type_name" },
                          { "data": "class_name" },
                          { "data": "phone" },
                          { "data": "email"},
                          { "data": "create_at" },
                          { "data": "update_at" },
                          { "data": null,
                                render: function ( data, type, row ) {
                                  var btnSubs = '';
                                  if (data.pay_status == 1) {
                                    btnSubs = '<button data-id="'+data.reg_id+'" id="subscribe" style="margin-left: 5px;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#subscribeModal"><i class="far fa-arrow-alt-circle-right"></i></button>';
                                  }
                                  return '<button id="confirm" title="confirm" class="btn btn-info btn-sm"><span class="fa fa-check" style="margin-right: 3px;"></span> | <span class="fa fa-ban" style="margin-left: 3px;"></span></button>'+btnSubs;
                              }
                          },
                      ],
                    "columnDefs": [
                        { targets: 11, "width": "85"}
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
                        //menggunakan ajax agar tidak perlu load page
                        $.ajax({
                            type : "POST",
                            url  : "<?php echo base_url('payment/apply_payment')?>",
                            dataType : "JSON",
                            data : {id: data.id},
                            success: function(data){
                              result.value = data.status;
                              var remain_quota = data.remain;
                              var class_type_remain = data.class_type;
                              var classroom_remain = data.class_name;
                              
                              if (result.value) {
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Your receipt has been confirm! Remaining quota for '+classroom_remain+' ('+class_type_remain+') is '+remain_quota,
                                  // showConfirmButton: false,
                                  // timer: 1000,
                                  onClose: () => {
                                    get_all();
                                    return false;
                                  }
                                })
                              } else {
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Your request has been canceled! Remaining quota for '+classroom_remain+' ('+class_type_remain+') is '+remain_quota,
                                  // showConfirmButton: false,
                                  // timer: 1000
                                })
                              }
                            }
                        });
                      } else {
                        Swal.fire({
                          icon: 'error',
                          title: 'Your request has been canceled!',
                          // showConfirmButton: false,
                          // timer: 1000
                        })
                      }
                    });
                  }
              } );
            }
        </script>