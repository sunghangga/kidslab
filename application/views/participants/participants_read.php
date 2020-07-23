<!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>PARTICIPANTS</h3>
                </div>
                  <div class='card-body'>
                    <div class='row'>
                      <div class='col-12'>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Code <?php echo form_error('code') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="code" id="code" placeholder="Code" value="<?php echo $code; ?>" disabled/>
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Child Name <?php echo form_error('child_name') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="child_name" id="child_name" placeholder="Child Name" value="<?php echo $child_name; ?>" disabled/>
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Parent Name <?php echo form_error('parent_name') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="parent_name" id="parent_name" placeholder="Parent Name" value="<?php echo $parent_name; ?>" disabled/>
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Phone <?php echo form_error('phone') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>" disabled/>
                                   </div> 
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Email <?php echo form_error('email') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" disabled/>
                                   </div> 
                                </div>
	    <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Address <?php echo form_error('address') ?></label>
                                    <div class='col-sm-10'><textarea class="form-control" rows="3" name="address" id="address" placeholder="Address" disabled><?php echo $address; ?></textarea>
                                    </div>
                                </div>
	  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>Birth Date <?php echo form_error('birth_date') ?></label>
                                    <div class='col-sm-10'><input type="text" class="form-control" name="birth_date" id="birth_date" placeholder="Birth Date" value="<?php echo $birth_date; ?>" disabled/>
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
	    <a href="<?php echo site_url('participants') ?>" class="btn btn-default">Cancel</a>
	</div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </section><!-- /.content -->