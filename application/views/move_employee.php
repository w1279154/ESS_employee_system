

<?php $style= 'style="width: 100%; height: 30px;" required'?>
<?php foreach($employee as $emp){ ?>

<h2>Move <strong><?= $emp->first_name; ?> <?= $emp->last_name; ?></strong>
	<br/> to New Department?</h2>
	

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
					Current Department:
				</td>
				<td>
					<?= $emp->dept_name; ?>
				</td>
			</tr>
			<tr>
				<td>
					Is Manager:
				</td>
				<td>
					<?= $is_manager; ?>
				</td>
			</tr>
		</table>
		<?php } ?>

		
	</div>

<br/>
	
	<div id="new_dept_choice">
		<table align="center">
			<tr>
				<td>
					<h2>Choose New Department:</h2>
				</td>
			</tr>
			<tr align="center">
		        <td><?=form_dropdown('dept_no', $options_dept, '', ' id="dropdown_dept" '.$style)?></td>
			</tr>
		</table>
	</div>

<br/>


  <div class='popbox'>
    <button class='open' href='#' onclick="new_dept()">
    Move Employee
    </button>

    <div class='collapse' >
      <div class='box'>
        <div class='arrow'></div>
        <div class='arrow-border'></div>

        <div id="content">	
      <p>
      	<strong>IMPORTANT NOTICE: </strong> <br/>
      	PLEASE NOTE THAT THIS OPERATION IS NOT REVERSABLE.<br/>
      </p>	
      <?php
      if ($is_manager == "TRUE")
      {
      	echo ("<p style='color:RED; font-size:12;'>Notice: This employee is a Manager of a Department. <br/>
      	Should this employee be moved, <br/>
      	the department may not have an assigned Manager.</p>");
      }
      ?>
      <p style="font-size:11;">
      	FOR ADDED SECURITY PLEASE RE-ENTER YOUR <br /> 
      	<strong>USERNAME AND PASSWORD.</strong>
      </p>


      	<form id="login_form" action='<?= "https://".$_SERVER['HTTP_HOST']."/w1279154/index.php/authentication/auth_move_employee"?>' method="post">
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
	<!--LOGIN BUTTON-->
	<tr>
		<td class="login" id="button" align="right">
			
			<button type="submit" id="login_button" class="button">Move Employee</button>

		</td>
	</tr>
	<tr>
		<td>  <input type="hidden" name="new_dept" id="new_dept" value="xx">
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
	    $(document).ready(function(){
	 

  var manager = "<?php echo $is_manager?>";
  //alert(manager);

  if (manager == "TRUE"){
 $.msgbox("Notice: This employee is a Manager of a Department. Should this employee be altered, the department may not have an assigned Manager."); 
  }

});
</script>

<script>

	function new_dept()
	{
		 //alert(document.getElementById("new_dept").value);
		 var e = document.getElementById("dropdown_dept");
		 var Selected_dept = e.options[e.selectedIndex].value;
		document.getElementById("new_dept").value = Selected_dept;
		//alert(document.getElementById("new_dept").value);
	}

</script>
</body>
</html>

