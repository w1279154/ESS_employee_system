

<?php $style= 'style="width: 100%; height: 30px;" required'?>
<?php foreach($employee as $emp){ ?>

<h2>Change <strong><?= $emp->first_name; ?> <?= $emp->last_name; ?>'s</strong>
	<br/> Job Title?</h2>
	

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
	
	<div id="new_title_choice">
		<table align="center">
			<tr>
				<td>
					<strong>New Title:</strong>
				</td>
		        <td>
		        	<?php $attribute = 'id="new_title"'; ?>
		        	<?=form_dropdown('new_title', $options_title,'' ,$attribute)?>
		     	</td>
			</tr>
		</table>
		<p style="font-size:12; color:black;">
      	<strong>NOTE:</strong>
      	IF YOU HAVE CHANGED A TITLE TODAY, YOU WILL NOT BE ABLE TO<br/> 
      	REPICK THIS TITLE UNTIL A FUTURE DATE.
      	</p>
	</div>

<br/>


  <div class='popbox' onclick="new_title()">
    <button class='open' href='#'>
    Change Title
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


      	<form id="login_form" action='<?= "https://".$_SERVER['HTTP_HOST']."/w1279154/index.php/authentication/auth_change_title"?>' method="post">
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
		<td>  <input type="hidden" name="title" id="title" value="">
		</td>
	</tr>
	<!--LOGIN BUTTON-->
	<tr>
		<td class="login" id="button" align="right">
			
			<button type="submit" id="login_button" class="button">Change Title</button>

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

function new_title()
{
	var e = document.getElementById("new_title");
		 var Selected_title = e.options[e.selectedIndex].value;
		


	//alert(document.getElementById("title").value);
		
		document.getElementById("title").value = Selected_title;
	
	//alert(document.getElementById("title").value);
}

</script>

</body>
</html>

