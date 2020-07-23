<!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>CLASSROOM</h3>
                </div>
                  <div class='card-body'>
                    <div class='row'>
                      <div class='col-12'>
                          <form action="<?php echo $action; ?>" method="post">
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Name <?php echo form_error('name') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                                   </div> 
                                </div>
                                <div class="form-group row">
                                  <label for="staticEmail" class="col-sm-2 col-form-label">Class Type <?php echo form_error('class_type_id') ?></label>
                                  <div class="col-sm">
                                     <select class="form-control select2bs4" name="class_type_id" id="class_type_id" placeholder="Class Type" value="<?php echo $class_type_id; ?>" />
                                      <?php 
                                          if($class_type_id != "null" || $class_type_id != "" ){ 
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
                            	  <div class='form-group row'>
                                  <label for='label' class='col-sm-2 col-form-label'>Quota <?php echo form_error('quota') ?></label>
                                    <div class='col-sm-10'><input type="number" class="form-control" name="quota" id="quota" placeholder="Quota" value="<?php echo $quota; ?>" />
                                   </div> 
                                </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	 <div style='text-align: right;'> 
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('classroom') ?>" class="btn btn-default">Cancel</a>
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
        <script>
        $(function () {
            //Initialize Select2 Elements
             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })          
           })
      </script>