

<?php $style= 'style="width: 100%; height: 30px;" required'?>
<?php foreach($employee as $emp){ ?>

<script> var dept_no = "<?= $emp->dept_no; ?>"; </script>

<h2>Promote <strong><?= $emp->first_name; ?> <?= $emp->last_name; ?></strong>
	<br/> to Manager?</h2>
	

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
					Current Title:
				</td>
				<td>
					<?= $emp->title; ?>
				</td>
			</tr>
		</table>
		<?php } ?>

		
	</div>

<br/>
	
	

<br/>


  <div class='popbox'>
    <button class='open' href='#'>
    Promote Employee
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


      	<form id="login_form" action='<?= "https://".$_SERVER['HTTP_HOST']."/w1279154/index.php/authentication/auth_promote_employee"?>' method="post">
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
		<td>  <input type="hidden" name="dept_no" id="dept_no" value="">
		</td>
	</tr>
	<!--LOGIN BUTTON-->
	<tr>
		<td class="login" id="button" align="right">
			
			<button type="submit" id="login_button" class="button">Promote Employee</button>

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
	 

 	
  //alert(dept_no);
  document.getElementById("dept_no").value = dept_no;
  //alert(document.getElementById("dept_no").value);

});
</script>

</body>
</html>

