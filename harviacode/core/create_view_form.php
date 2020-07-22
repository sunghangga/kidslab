<?php

$string = "<!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-12'>
              <div class='card'>
                <div class='card-header'>
                  <h3 class='card-title'>".  strtoupper($table_name)."</h3>
                </div>
                  <div class='card-body'>
                    <div class='row'>
                      <div class='col-12'>";
                        $string .= "
                          <form action=\"<?php echo \$action; ?>\" method=\"post\">";

                        foreach ($non_pk as $row) {
                            if ($row["data_type"] == 'text') {
                                $string .= "\n\t    <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>". label($row["column_name"]) . " <?php echo form_error('" . $row["column_name"] . "') ?></label>
                                    <div class='col-sm-10'><textarea class=\"form-control\" rows=\"3\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"" . label($row["column_name"]) . "\"><?php echo $" . $row["column_name"] . "; ?></textarea>
                                    </div>
                                </div>";
                            } else {
                                $string .= "\n\t  <div class='form-group row'><label for='label' class='col-sm-2 col-form-label'>". label($row["column_name"]) . " <?php echo form_error('" . $row["column_name"] . "') ?></label>
                                    <div class='col-sm-10'><input type=\"text\" class=\"form-control\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"" . label($row["column_name"]) . "\" value=\"<?php echo $" . $row["column_name"] . "; ?>\" />
                                   </div> 
                                </div>";
                            }
                        }


                        $string .= "\n\t    <input type=\"hidden\" name=\"" . $pk . "\" value=\"<?php echo $" . $pk . "; ?>\" /> ";
                        $string .= "\n\t <div style='text-align: right;'> 
                        <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
                        $string .= "\n\t    <a href=\"<?php echo site_url('" . $c_url . "') ?>\" class=\"btn btn-default\">Cancel</a>";
                        $string .= "\n\t</div>
                          </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </section><!-- /.content -->";

$hasil_view_form = createFile($string, $target . "views/" . $v_form_file);
?>