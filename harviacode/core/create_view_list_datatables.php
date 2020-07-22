<?php 
$string = "";
$string .= "
        <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>".  strtoupper($table_name)." LIST <?php echo anchor('".$c_url."/create/','Create',array('class'=>'btn btn-primary btn-sm'));?>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), ' <i class=\"fa fa-file-excel-o\"></i> Excel', 'class=\"btn btn-primary btn-sm\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word-o\"></i> Word', 'class=\"btn btn-primary btn-sm\"'); ?>";
}
$export_pdf=1;
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), '<i class=\"fa fa-file-pdf-o\"></i> PDF', 'class=\"btn btn-primary btn-sm\"'); ?>";
}
$string .= "</h3>
                </div><!-- /.card-header -->
                <div class='card-body'>
        <table class=\"table table-bordered table-striped\" id=\"mytable\">
            <thead>
                <tr>
                    <th width=\"80px\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t    <th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t    <th>Action</th>
                </tr>
            </thead>";
$string .= "\n\t    <tbody>
            <?php
            \$start = 0;
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t    <td><?php echo ++\$start ?></td>";

foreach ($non_pk as $row) {
    $string .= "\n\t\t    <td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}

$string .= "\n\t\t    <td style=\"text-align:center\" width=\"140px\">"
        . "\n\t\t\t<?php "
        . "\n\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'<i class=\"fa fa-eye\"></i>',array('title'=>'detail','class'=>'btn btn-info btn-sm')); "
        . "\n\t\t\techo '  '; "
        . "\n\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'<i class=\"fa fa-edit\"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); "
        . "\n\t\t\techo '  '; "
        . "\n\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'<i class=\"fa fa-trash-alt\"></i>','title=\"delete\" class=\"btn btn-danger btn-sm\" onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t?>"
        . "\n\t\t    </td>";

$string .=  "\n\t        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src=\"<?php echo base_url('template/adminlte/plugins/jquery/jquery.min.js') ?>\"></script>
        <script src=\"<?php echo base_url('template/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>\"></script>
        <script src=\"<?php echo base_url('template/adminlte/plugins/datatables/jquery.dataTables.js') ?>\"></script>
        <script src=\"<?php echo base_url('template/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>\"></script>
        <script type=\"text/javascript\">
            $(document).ready(function () {
                $(\"#mytable\").dataTable();
            });
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section><!-- /.content -->";


$hasil_view_list = createFile($string, $target."views/" . $v_list_file);

?>