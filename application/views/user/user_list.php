
        <!-- Main content -->
        <section class='content'>
        <div class="container-fluid">
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>USER LIST <?php echo anchor('user/create/','Create',array('class'=>'btn btn-primary btn-sm'));?></h3>
                </div><!-- /.box-header -->
                <div class='card-body'>
                <table class="table table-bordered table-striped" style="width:100%;" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                    		    <th>Nama</th>
                            <th>Username</th>
                            <th>Group</th>
                            <th>Date</th>
                    		    <th>Last Update</th>
                    		    <th>Action</th>
                                    </tr>
                                </thead>
                    	    <tbody>
                                <?php
                                $start = 0;
                                foreach ($user_data as $user)
                                {
                                    ?>
                                    <tr>
                    		    <td><?php echo ++$start ?></td>
                    		    <td><?php echo $user->name ?></td>
                            <td><?php echo $user->username ?></td>
                            <td><?php echo $user->group ?></td>
                            <?php $newDate = date('d M Y', strtotime($user->create_at));  ?>
                            <td><?php echo $newDate ?></td>
                		        <?php $newDate = date('d M Y h:i:s', strtotime($user->update_at));  ?>
                            <td><?php echo $newDate ?></td>
                		    <td style="text-align:center">
                			<?php 
                			echo anchor(site_url('user/read/'.$user->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-info btn-sm')); 
                			echo '  '; 
                			echo anchor(site_url('user/update/'.$user->id),'<i class="fas fa-edit"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
                			echo '  '; 
                			echo anchor(site_url('user/delete/'.$user->id),'<i class="fas fa-trash-alt"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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

        <!-- page script -->
        <script>
            $(function () {
                $('#mytable').DataTable({
                    scrollY: "500px",
                    scrollX: true,
                    scrollCollapse: true,
                  destroy: true,
                  paging: true,
                  searching: true,
                  "columnDefs": [
                      { targets: -1, "width": "100px" },
                      { targets: [4,5], "width": "150px" },
                      { targets: 1, "width": "200px" },
                      { targets: 2, "width": "100px" },
                    ]
                });
            });
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div>
        </section><!-- /.content -->