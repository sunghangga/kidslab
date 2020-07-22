<!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>CLASS TYPE</h3>
                </div>
                  <div class='card-body'>
                    <div class='row'>
                      <div class='col-12'>
                          <form action="<?php echo $action; ?>" method="post">
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Name <?php echo form_error('name') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                                   </div> 
                                </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	 <div style='text-align: right;'> 
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('class_type') ?>" class="btn btn-default">Cancel</a>
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