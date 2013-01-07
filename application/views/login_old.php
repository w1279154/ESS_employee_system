<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="us">
<head>
	<SCRIPT type="text/javascript"
        src="http://code.jquery.com/jquery-latest.js"></SCRIPT>
	<link rel="stylesheet" type="text/css" href="/w1279154/script/css/login.css">

</head>
<body>
	<form id="login_form" action="<?= base_url()."index.php/authentication/auth"?>" method="post">
<table width="404px" cellpadding="0" border="0" cellspacing="0" id="login_table">
	<tr><td id="top"></td></tr>
	<!--EMPLOYEE SEARCH SYSTEM TEXT-->
	<tr>
		<td>
			<img src="/w1279154/script/css/Login/images/login_06.png" />
		</td>
	</tr>
	<!--USERNAME INPUT FIELD-->
	<tr>
		<td class="login" id="input_text">
			<input type="text" placeholder="Username" name="username" required />
		</td>
	</tr>
	<!--PASSWORD INPUT FIELD-->
	<tr>	
		<td class="login" id="input_text">
			<input type="password" placeholder="Password" name="password" required />
		</td>
	</tr>
	<!--LOGIN BUTTON-->
	<tr>
		<td class="login" id="button" align="right">
			
			<button type="submit" id="login_button"></button>
			<!--<a href="#" onclick="submit()" id="login_button" >
				<img src="/w1279154/script/css/Login/images/login_14.png">
			</a>-->
		</td>
	</tr>
	<tr>
		<td class="login" ><span id="login_failed" style="color: RED;"></span></td>
	</tr>
	<tr><td id="bottom">
		
	</td></tr>
</table>
    </form>

        

</body>
	<SCRIPT>
		function login_status(){
			var login = <?= $login ?>;
			//alert(login);
			
			if (login != 0)
			{
				document.getElementById('login_failed').innerHTML = "Login Failed. Password or Username incorrect.";			
			} //END IF
			
		} //END LOGIN_STATUS
		
		login_status();
		
	</SCRIPT>
</html>