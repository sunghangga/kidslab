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
        <h2>Register List</h2>
        <table class="word-table" style="margin-bottom: 10px">
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
		
            </tr><?php
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
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>