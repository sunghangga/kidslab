<!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>REGISTER</h3>
                </div>
                  <div class='card-body'>
                    <div class='row'>
                      <?php echo form_error('quota_limit') ?>
                      <div class='col-12'>
                          <form action="<?php echo $action; ?>" method="post">
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Child Name <?php echo form_error('child_name') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="child_name" id="child_name" placeholder="Child Name" value="<?php echo $child_name; ?>" />
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Parent Name <?php echo form_error('parent_name') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="parent_name" id="parent_name" placeholder="Parent Name" value="<?php echo $parent_name; ?>" />
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Phone <?php echo form_error('phone') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>" />
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Email <?php echo form_error('email') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                                   </div> 
                                </div>
	    <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Address <?php echo form_error('address') ?></label>
                                    <div class='col-sm-10'><textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"><?php echo $address; ?></textarea>
                                    </div>
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Birth Date <?php echo form_error('birth_date') ?></label>
                                    <div class="col-sm-4 input-group date" data-target-input="nearest" id="inputDate">
                                      <input type="text" class="form-control datetimepicker-input" data-target="#inputDate" placeholder="Birth Date"  name="birth_date" id="birth_date" value="<?php echo $birth_date; ?>"/>
                                      <div class="input-group-append" data-target="#inputDate" data-toggle="datetimepicker">
                                          <div class="form-control input-group-text"><i class="far fa-calendar-alt"></i></div>
                                      </div>
                                    </div>
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Class Type <?php echo form_error('class_type_id') ?></label>
                                    <div class='col-sm-10'>
                                      <select class="form-control select2bs4" onchange="classroom_list()" name="class_type_id" id="class_type_id" placeholder="Class Type" value="<?php echo $class_type_id; ?>" />
                                      <?php 
                                          if($class_type_id != null || $class_type_id != "" ){ 
                                               echo '<option value="'.$class_type_id.'" selected>'.$class_type_name.'</option>';
                                          }
                                          foreach ($get_all_classtype as $row)
                                          {
                                            if($class_type_id != $row->id){
                                              echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                            }
                                          } 
                                      ?>
                                     </select>
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Classroom <?php echo form_error('classroom_id') ?></label>
                                    <div class='col-sm-10'>
                                      <select class="form-control select2bs4" id="classroom_id" name="classroom_id">
                                        <?php if($classroom_id != null || $classroom_id != ""){ 
                                             echo '<option value="'.$classroom_id.'">'.$classroom_name.'</option>';
                                         } 
                                        foreach ($get_all_classroom as $row)
                                            {
                                              if($group_id != $row->id){
                                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                              }
                                            } ?>
                                        >
                                      </select>
                                   </div> 
                                </div>
                                <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Period <?php echo form_error('period') ?></label>
                                   <div class="col-sm-4 input-group date" data-target-input="nearest" id="inputPeriod">
                                      <input type="text" class="form-control datetimepicker-input" data-target="#inputPeriod" placeholder="Period"  name="period" id="period" value="<?php echo $period; ?>"/>
                                      <div class="input-group-append" data-target="#inputPeriod" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                      </div>
                                    </div>
                                </div>
	    <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Note <?php echo form_error('note') ?></label>
                                    <div class='col-sm-10'><textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo $note; ?></textarea>
                                    </div>
                                </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	 <div style='text-align: right;'> 
                        <button type="submit" class="btn btn-primary" ><?php echo $button ?></button> 
	    <a href="<?php echo site_url('register') ?>" class="btn btn-default">Cancel</a>
	</div>
                          </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </section><!-- /.content -->
        <!-- jQuery -->
        <script src="<?php echo base_url() ?>template/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url() ?>template/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url() ?>template/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <script src="<?php echo base_url() ?>assets/bootstrap/js/moment.js"></script>
        <script type="text/javascript">
          $(function () {
              // panggil pertama
              classroom_list();

               $('#inputDate').datetimepicker({
                  format: 'YYYY-MM-DD'
                })
               $('#inputPeriod').datetimepicker({
                  format: 'YYYY-MM'
                })
               $('.select2bs4').select2({
                  theme: 'bootstrap4'
                }) 
            });

          $("#child_name").autocomplete({
              source: "<?php echo base_url()?>register/get_all_participants/",

              select: function (event, ui) {
                $('[name="child_name"]').val(ui.item.child_name); 
                $('[name="parent_name"]').val(ui.item.parent_name);
                $('[name="phone"]').val(ui.item.phone);
                $('[name="email"]').val(ui.item.email);
                $('[name="address"]').val(ui.item.address);
                $('[name="birth_date"]').val(ui.item.birth_date);
                return false;
              },
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
        </script>