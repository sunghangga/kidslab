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
                                          <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                      </div>
                                    </div>
                                </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	 <div style='text-align: right;'> 
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('participants') ?>" class="btn btn-default">Cancel</a>
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
        <script src="<?php echo base_url() ?>assets/bootstrap/js/moment.js"></script>
        <script>
          $(function () {
               $('#inputDate').datetimepicker({
                  format: 'YYYY-MM-DD'
                })
            });
        </script>