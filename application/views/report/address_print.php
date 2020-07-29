<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
  <title>Address Report</title>
</head>
<body>
<div class="page-kirim">
<?php foreach($data_address as $row) { ?>
<div class="row form-p-all">
    <div class="col-md-12">
    <div class="column" style="border-style: solid; width: 80%; margin-top: 2px;">
      <!-- <p class="form-p" style="margin-left: 3px; margin-top: 2px;"><b>PENGIRIM</b></p> -->
      <table>
        <tr>
          <td>
            <f class="htitle"><b>To</b></f>
          </td>
          <td>
            <f class="hcontent">: </f>
          </td>
          <td>
            <f class="hcontent" style="padding-right: 80px;"><?php echo $row->parent_name?></f>
          </td>
        </tr>
        <tr>
          <td>
            <f class="htitle"><b>Address</b></f>
          </td>
          <td>
            <f class="hcontent">: </f>
          </td>
          <td>
            <f class="hcontent" style="padding-right: 80px;"><?php echo $row->address?></f>
          </td>
        </tr>
        <tr>
          <td>
            <f class="htitle"><b>No. HP</b></f>
          </td>
          <td>
            <f class="hcontent">: </f>
          </td>
          <td>
            <f class="hcontent"><?php echo $row->phone?></f>
          </td>
        </tr>
      </table>
    </div>
    <div class="column-right" style="padding-left: 475px; width: 70%; margin-top: 2px;">
      <table>
        <tr>
          <td >
            <img type="file" src="./upload/logo/<?php echo $logo ?>" alt="Logo" class="form-logo">
          </td>
        </tr>
      </table>
    </div>
   </div>
 </div>
<?php } ?>
</div>
</body>
</html>