<!-- Main content -->
        <section class='content'>
          <div class="container-fluid">
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                
                  <h3 class='card-title'>GROUP</h3>
                </div>
                <div class='card-body'>
                  <div class="row">
                    <div class="col-12">
                  <form>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" disabled/>
                      </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <div style="text-align: right;">
                  <a href="<?php echo site_url('group') ?>" class="btn btn-default">Cancel</a>
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
        <script src="<?php echo base_url() ?>assets/bootstrap/js/moment.js"></script>
        </section><!-- /.content -->