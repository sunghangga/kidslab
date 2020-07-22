
        <!-- Main content -->
        <section class='content'>
            <div class="container-fluid">
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>GROUP LIST <?php echo anchor('group/create/','Create',array('class'=>'btn btn-primary btn-sm'));?></h3>
                </div><!-- /.box-header -->
                <div class='card-body'>
        <table class="table table-bordered table-striped" style="width:100%;" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Name</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($group_data as $group)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $group->name ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('group/read/'.$group->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('group/update/'.$group->id),'<i class="fas fa-edit"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
			echo '  '; 
			echo anchor(site_url('group/delete/'.$group->id),'<i class="fas fa-trash-alt"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <!-- jQuery -->
        <script src="<?php echo base_url() ?>template/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url() ?>template/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url() ?>template/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div>
        </section><!-- /.content -->