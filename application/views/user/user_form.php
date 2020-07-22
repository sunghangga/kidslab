<!-- Main content -->
        <section class='content'>
          <div class="container-fluid">
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                
                  <h3 class='card-title'>USER</h3>
                  </div>
                      <div class='card-body'>
                        <div class="row">
                          <div class="col-12">
                          <form action="<?php echo $action; ?>" method="post">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Group <?php echo form_error('group_id') ?></label>
                              <div class="col-sm-10">
                                <select class="form-control" id="group" name="group_id">
                                  <?php if($group_id != null){ 
                                       echo '<option value="'.$group_id.'">'.$group.'</option>';
                                   } 
                                  foreach ($get_all_group as $row)
                                      {
                                        if($group_id != $row->id){
                                          echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                        }
                                      } ?>
                                  >
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Nama <?php echo form_error('name') ?></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Username <?php echo form_error('username') ?></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Password <?php echo form_error('password') ?></label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                              </div>
                            </div>
                             <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                            <div style="text-align: right;">
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                        <a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a>
                        </div>
                      </form>
                    </div>
                  </div>
                      </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div>
        <script src="<?php echo base_url('template/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
        </section><!-- /.content -->

  <script type="text/javascript">
    // var group= document.getElementById("group").value;
    if(<?php echo $this->session->userdata('user_level')?> != "1"){
        document.getElementById("group").disabled = true;
    }

     function showOnChange(e) {
    var elem = document.getElementById("group");
    var value = elem.options[elem.selectedIndex].value;
    console.log(value);
    if(value != 1){
      console.log("tidak");
       document.getElementById("group").disabled = true;
       } else {
        console.log("ada");
       document.getElementById("group").disabled = false;
       }
    
  }
    
  </script>