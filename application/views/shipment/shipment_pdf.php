<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Shipment List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Pay Status</th>
		<th>Ship Status</th>
		<th>Register Id</th>
		<th>Create At</th>
		<th>Update At</th>
		
            </tr><?php
            foreach ($shipment_data as $shipment)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $shipment->pay_status ?></td>
		      <td><?php echo $shipment->ship_status ?></td>
		      <td><?php echo $shipment->register_id ?></td>
		      <td><?php echo $shipment->create_at ?></td>
		      <td><?php echo $shipment->update_at ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>