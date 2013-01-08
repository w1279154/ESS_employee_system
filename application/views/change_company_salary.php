<h1>Change Whole Company Salary</h1>

<form id="login_form" action='<?= "https://".$_SERVER['HTTP_HOST']."/w1279154/index.php/authentication/auth_change_company_salary" ?>' method="post">

<br/>
Change by 
<input type="text" name="percentage" onkeyup="this.value=this.value.replace(/[^\d]/,'')" onchange="this.value=this.value.replace(/[^\d]/,'')" required maxlength="3" size="10" placeholder="100"/>
%

<p style="font-size:11; color:red;">
      	<strong>DO NOT PRESS REFRESH OR RELOCATE FROM THIS PAGE OR THE WHOLE DATABASE WILL GET CORRUPTED.<br/>
      			THIS FUNCTION IS STILL IN EXPERIMENTAL STAGES.
      		</strong>
      </p>

<br/>
<br/>

  <div class='popbox'>
    <button class='open' href='#'>
    Change Salary
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
            <p style="font-size:11;">
      	FOR ADDED SECURITY PLEASE RE-ENTER YOUR <br /> 
      	<strong>USERNAME AND PASSWORD.</strong>
      </p>


      	
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

</body>
</html>