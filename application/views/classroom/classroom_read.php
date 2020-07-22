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
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Name <?php echo form_error('name') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" disabled/>
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Quota <?php echo form_error('quota') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="quota" id="quota" placeholder="Quota" value="<?php echo $quota; ?>" disabled/>
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Create At <?php echo form_error('create_at') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="create_at" id="create_at" placeholder="Create At" value="<?php echo $create_at; ?>" disabled/>
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Update At <?php echo form_error('update_at') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="update_at" id="update_at" placeholder="Update At" value="<?php echo $update_at; ?>" disabled/>
                                   </div> 
                                </div>
	 <div style='text-align: left;'>
	    <a href="<?php echo site_url('classroom') ?>" class="btn btn-default">Cancel</a>
	</div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </section><!-- /.content -->