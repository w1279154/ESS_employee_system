

<?php $style= 'style="width: 100%; height: 30px;" required'?>
<?php foreach($employee as $emp){ ?>

<h2>Change <strong><?= $emp->first_name; ?> <?= $emp->last_name; ?>'s</strong>
	<br/> Salary?</h2>
	<script> var current_salary = "<?= $emp->salary; ?>";
	</script>

	<div id="emp_details" align="center">
		
		<table class="results">
			<tr>
				<td>
					Employee No.:
				</td>
				<td>
					<?= $emp->emp_no; ?>
				</td>
			</tr>
			<tr>
				<td>
					First Name:
				</td>
				<td>
					<?= $emp->first_name; ?>
				</td>
			</tr>
			<tr>
				<td>
					Last Name:
				</td>
				<td>
					<?= $emp->last_name; ?>
				</td>
			</tr>
			<tr>
				<td>
					Gender:
				</td>
				<td>
					<?= $emp->gender; ?>
				</td>
			</tr>
			<tr>
				<td>
					Date of Birth:
				</td>
				<td>
					<?= $emp->birth_date; ?>
				</td>
			</tr>
			<tr>
				<td>
					Current Salary:
				</td>
				<td>
					<?= $emp->salary; ?>
				</td>
			</tr>
		</table>
		<?php } ?>

		
	</div>

<br/>
	
	<div id="new_title_choice">
		<table align="center">
			<tr>
				<td>
					<strong>New Salary:</strong>
				</td>
		        <td>
		        	<input type="text" placeholder="Enter Here" name="new_salary" id="new_salary" required/>
		     	</td>
			</tr>
		</table>
	</div>

<br/>


  <div class='popbox' onclick="new_salary()">
    <button class='open' href='#'>
    Change Salary
    </button>

    <div class='collapse' >
      <div class='box' style="width: 400px;">
        <div class='arrow'></div>
        <div class='arrow-border'></div>

        <div id="content">	
      <p >
      	<strong>IMPORTANT NOTICE: </strong> <br/>
        </p>	
      
      <p style="font-size:12;">
      	FOR ADDED SECURITY PLEASE RE-ENTER YOUR <br /> 
      	<strong>USERNAME AND PASSWORD.</strong>
      </p>


      	<form id="login_form" action="<?= base_url()."index.php/authentication/auth_change_salary"?>" method="post">
<table cellpadding="0" border="0" cellspacing="0" id="login_table" align="center">
	</tr>
	<!--USERNAME INPUT FIELD-->
	<tr class="login">
		<td id="input_text">
			<table align="center">
				<tr><td align="left">
				Username:
				</td>
				<td align="left">
				<input type="text" placeholder="Username" name="username" required />
				</td>
				</tr>
			</table>
		</td>
	</tr>
	<!--PASSWORD INPUT FIELD-->
	<tr class="login">	
		<td  id="input_text">
			<table align="center">
				<tr><td align="left">
			Password:
			</td>
				<td align="left">
			<input type="password" placeholder="Password" name="password" required />
			</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td>
	<br/>
	</tr></td>
	<tr>
		<td>  <input type="hidden" name="salary" id="salary" value="">
		</td>
	</tr>
	<!--LOGIN BUTTON-->
	<tr>
		<td class="login" id="button" align="right">
			
			<button type="submit" id="login_button" class="button">Change Salary</button>

		</td>
	</tr>
	</table>
    </form>

<p style="font-size:9;">USERNAME AND IP ADDRESS WILL BE RECORDED.</p>


  </div><!-- END CONTENT -->
      </div> <!-- END BOX -->
    </div><!-- END COLLAPSE -->
  </div><!-- END POPBOX -->

<script type='text/javascript' charset='utf-8'>

function new_salary()
{
	var new_salary = document.getElementById("new_salary").value;

	/*alert(current_salary);
	alert(new_salary);
	
	if (current_salary > new_salary)
	{
		alert('The new salary is less than the current salary. Click ok to continue.');
	}*/

	//alert(document.getElementById("salary").value);
		
		document.getElementById("salary").value = new_salary;
	
	//alert(document.getElementById("salary").value);
}

</script>

</body>
</html>

