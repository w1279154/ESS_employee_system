<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="us">
<head>
	<SCRIPT type="text/javascript"
        src="http://code.jquery.com/jquery-latest.js"></SCRIPT>
	<link rel="stylesheet" type="text/css" href="/w1279154/script/css/login_new.css">

</head>
<body>	<form id="login_form" action="<?= base_url()."index.php/authentication/auth"?>" method="post">
<table width="684px" cellpadding="0" border="0" cellspacing="0" id="login_table">
	<tr><td id="top" ></td></tr>
	<tr class="login">
	<td >
	<pre>



	</pre>
	</td>
	</tr>
	<!--USERNAME INPUT FIELD-->
	<tr class="login">
		<td id="input_text">
			<table align="right">
				<tr><td>
				<img src="/w1279154/script/css/Login_new/images/login_new_12.png" />
				</td>
				<td>
				<input type="text" placeholder="Username" name="username" required />
				</td>
				</tr>
			</table>
		</td>
	</tr>
	<!--PASSWORD INPUT FIELD-->
	<tr class="login">	
		<td  id="input_text">
			<table align="right">
				<tr><td>
			<img src="/w1279154/script/css/Login_new/images/login_new_17.png" />
			</td>
				<td>
			<input type="password" placeholder="Password" name="password" required />
			</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr class="login">
	<td >
	<pre>
	</pre>
	</td>
	</tr>
	<!--LOGIN BUTTON-->
	<tr>
		<td class="login" id="button" align="right">
			
			<button type="submit" id="login_button"></button>

		</td>
	</tr>
	<tr>
		<td class="login" align="right"><span id="login_failed" style="color: RED;"></span></td>
	</tr>
	<tr class="login" align="right" ><td style="padding-right: 5em; padding-left: 3em;">
		 Back to <a href='<?= "http://".$_SERVER['HTTP_HOST']."/w1279154/" ?>'>Search </a>
	</td></tr>
	<tr><td id="bottom" >
		 
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