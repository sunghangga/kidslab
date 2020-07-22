
        <!-- Main content -->
        <section class='content'>
          <div class="container-fluid">
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                <h3 class='card-title'>User Read</h3>
                </div>
                <div class='card-body'>
                  <div class="row">
                    <div class="col-12">
                  <form>
                    
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" disabled/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?php echo $username; ?>" disabled/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $password; ?>" disabled/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Group ID</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="group_id" id="group_id" placeholder="group_id" value="<?php echo $group_id; ?>" disabled/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Create At</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="create_at" id="create_at" placeholder="create_at" value="<?php echo $create_at; ?>" disabled/>
                      </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <div style="text-align: right;">
                  <a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a>
                  </div>
                  </form>
                    </div>
                  </div>
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        <script src="<?php echo base_url('template/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
        <script src="<?php echo base_url() ?>assets/bootstrap/js/moment.js"></script>
        <script>
          document.getElementById("create_at").value = moment(document.getElementById("create_at").value).format('D MMM YYYY');
        </script>
        </section><!-- /.content -->