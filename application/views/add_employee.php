<h1>Add New Employee</h1>

<form id="employee_details" action="<?= base_url()."index.php/hr/add_employee"?>" method="post">

<?php $style= 'style="width: 100%;" required'?>

<table class="results" align="center">
	<tr>
		<td>Employee Number:</td>
		<td>
			<input type="text" style="width: 100%;" readonly="readonly" value="<?= $emp_no ?>">
		</td>
	</tr>
	<tr>
		<td>First Name:</td>
		<td>
			<input type="text" style="width: 100%;" placeholder="First Name" name="first_name" required/>
		</td>
	</tr>
	<tr>
		<td>Last Name:</td>
		<td>
			<input type="text" style="width: 100%;" placeholder="Last Name" name="last_name" required/>
		</td>
	</tr>
	<tr>
		<td>Gender:</td>
		<td>
			<select name="gender" style="width: 100%;" required>
			<option value="M" selected="selected">Male</option>
			<option value="F">Female</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Date of Birth:</td>
		<td>
			<input type="text" id="datepicker_birth_date" placeholder="YYYY-MM-DD" name="birth_date" style="width: 100%;" required/>
		</td>
	</tr>
	<tr>
		<td>Department: </td>
        <td><?=form_dropdown('dept_no', $options_dept, '', $style)?></td>
	</tr>
	<tr>
		<td><?=form_label('Job Title:', 'title')?></td>
        <td><?=form_dropdown('title', $options_title, '', $style)?></td>
	</tr>
	<tr>
		<td>Salary(£):</td>
		<td>
			<input type="text" style="width: 100%;" placeholder="12345" name="salary" onkeyup="this.value=this.value.replace(/[^\d]/,'')" onchange="this.value=this.value.replace(/[^\d]/,'')"  required/>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right">
			<button class="button" type="submit">Add Employee</button>
		</td>
	</tr>
</table>
</form>

<script>
	$("#datepicker_birth_date").datepicker();
</script>