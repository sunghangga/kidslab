
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>REGISTER LIST <?php echo anchor('register/create/','Create',array('class'=>'btn btn-primary btn-sm'));?></h3>
                </div><!-- /.card-header -->
                <div class='card-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>Reg Code</th>
		    <th>Child Name</th>
		    <th>Parent Name</th>
		    <th>Phone</th>
		    <th>Email</th>
		    <th>Address</th>
		    <th>Birth Date</th>
		    <th>Period</th>
		    <th>Class Type Id</th>
		    <th>Classroom Id</th>
		    <th>Note</th>
		    <th>Create At</th>
		    <th>Update At</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($register_data as $register)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $register->reg_code ?></td>
		    <td><?php echo $register->child_name ?></td>
		    <td><?php echo $register->parent_name ?></td>
		    <td><?php echo $register->phone ?></td>
		    <td><?php echo $register->email ?></td>
		    <td><?php echo $register->address ?></td>
		    <td><?php echo $register->birth_date ?></td>
		    <td><?php echo $register->period ?></td>
		    <td><?php echo $register->class_type_id ?></td>
		    <td><?php echo $register->classroom_id ?></td>
		    <td><?php echo $register->note ?></td>
		    <td><?php echo $register->create_at ?></td>
		    <td><?php echo $register->update_at ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('register/read/'.$register->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('register/update/'.$register->id),'<i class="fa fa-edit"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
			echo '  '; 
			echo anchor(site_url('register/delete/'.$register->id),'<i class="fa fa-trash-alt"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
                $("#mytable").DataTable({
                    scrollY: "400px",
                    scrollX: true,
                    scrollCollapse: true,
                    destroy: true,
                    paging: true,
                    searching: true,
                });
            });
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section><!-- /.content -->