<!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>COMPANY</h3>
                </div>
                  <div class='card-body'>
                    <div class='row'>
                      <div class='col-12'>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Name <?php echo form_error('name') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" disabled/>
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Logo <?php echo form_error('logo') ?></label>
                                    <div class='col-sm-10'>
                                      <img type="file" style="height: 200px;" name="logo" id="logo" src="<?php echo base_url('./upload/logo/'.$logo) ?>" />
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Telephone <?php echo form_error('tlp') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="tlp" id="tlp" placeholder="Tlp" value="<?php echo $tlp; ?>" disabled/>
                                   </div> 
                                </div>
                                <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Update At <?php echo form_error('update_at') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="update_at" id="update_at" placeholder="Update At" value="<?php echo $update_at; ?>" disabled/>
                                   </div> 
                                </div>
	 <div style='text-align: right;'>
	    <a href="<?php echo site_url('company') ?>" class="btn btn-default">Cancel</a>
	</div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
          <script src="<?php echo base_url('template/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
        </section><!-- /.content -->