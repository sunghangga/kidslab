
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>CLASSROOM LIST <?php echo anchor('classroom/create/','Create',array('class'=>'btn btn-primary btn-sm'));?></h3>
                </div><!-- /.card-header -->
                <div class='card-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Name</th>
		    <th>Quota</th>
		    <th>Create At</th>
		    <th>Update At</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($classroom_data as $classroom)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $classroom->name ?></td>
		    <td><?php echo $classroom->quota ?></td>
		    <td><?php echo $classroom->create_at ?></td>
		    <td><?php echo $classroom->update_at ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('classroom/read/'.$classroom->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('classroom/update/'.$classroom->id),'<i class="fa fa-edit"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
			echo '  '; 
			echo anchor(site_url('classroom/delete/'.$classroom->id),'<i class="fa fa-trash-alt"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
                $("#mytable").dataTable();
            });
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section><!-- /.content -->