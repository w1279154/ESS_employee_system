<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test</title>
</head>

<body>
	<div>
		Found <?php echo $num_results; ?> Employees.
	</div>
    <table>
        <thead>
            <th>ID</th>
            <th>DOB</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Hire Date</th>
        </thead>
        <tbody>
            <?php foreach($employees as $employee){ ?>
            <tr>
                <td><?php echo $employee->emp_no; ?></td>
                <td><?php echo $employee->birth_date; ?></td>
                <td><?php echo $employee->first_name; ?></td>
                <td><?php echo $employee->last_name; ?></td>
                <td><?php echo $employee->gender; ?></td>
                <td><?php echo $employee->hire_date; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

	<?php if (strlen($pagination)){ ?>
    <div>
    	Pages: <?php echo $pagination; ?>
    </div>
    <?php } ?>

</body>
</html>