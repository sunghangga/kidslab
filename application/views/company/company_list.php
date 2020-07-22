
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>COMPANY LIST</h3>
                </div><!-- /.card-header -->
                <div class='card-body'>
        <table class="table table-bordered table-striped" style="width:100%;" id="mytable">
            <thead>
                <tr>
		    <th>Name</th>
		    <th>Logo</th>
		    <th>Tlp</th>
            <th>Last Update</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            foreach ($company_data as $company)
            {
                ?>
                <tr>
		    <td><?php echo $company->name ?></td>
		    <td><img type="file" style="height: 80px;" name="photo" id="photo" src="<?php echo base_url('upload/logo/'.$company->logo) ?>" /></td>
		    <td><?php echo $company->tlp ?></td>
        <?php $newDate = date('d M Y h:i:s', strtotime($company->update_at));  ?>
        <td><?php echo $newDate ?></td>
		    <td style="text-align:center">
			<?php 
			echo anchor(site_url('company/read/'.$company->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('company/update/'.$company->id),'<i class="fa fa-edit"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('template/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('template/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable({
                    scrollY: "500px",
                    scrollX: true,
                    scrollCollapse: true,
                  destroy: true,
                  paging: true,
                  searching: true,
                  "columnDefs": [
                      { targets: -1, "width": "80px" },
                      { targets: 0, "width": "300px" },
                      { targets: [2,3], "width": "150px" },
                    ]
                });
            });
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section><!-- /.content -->