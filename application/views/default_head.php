<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<title>Employee Search System</title>
  <link href="/w1279154/script/css/flick/jquery-ui-1.9.2.custom.css" rel="stylesheet">
	<link href="/w1279154/script/css/default.css" rel="stylesheet">
	<link rel='stylesheet' href='/w1279154/script/js/popbox/popbox.css' type='text/css'>
  <link rel="stylesheet" type="text/css" href="/w1279154/script/css/msgbox/jquery.msgbox.css" />
  <script src="/w1279154/script/js/jquery-1.8.3.js"></script>
  <script src="/w1279154/script/js/validation.js"></script>
  <script type='text/javascript' charset='utf-8' src='/w1279154/script/js/popbox/jquery.js'></script>
  <script src="/w1279154/script/js/jquery-ui-1.9.2.custom.js"></script>
  <script type="text/javascript" src="/w1279154/script/css/msgbox/jquery.msgbox.min.js"></script>
	<script type='text/javascript' charset='utf-8' src='/w1279154/script/js/popbox/popbox.js'></script>
  
  <script>

  
  function logout(){
     //'<?= base_url()."index.php/authentication/logout"?>';
  var url = '<?= "https://".$_SERVER['HTTP_HOST']."/w1279154/index.php/authentication/logout"?>';
  window.location.replace(url);
  }
  </script>

<script type='text/javascript' charset='utf-8'>
      $(document).ready(function(){
        $('.popbox').popbox();
      });
  </script>
	<style>
.button {
    background:#DDD;
    border:solid 1px #FFF;
    border-radius:5px;
    box-shadow: 0px 0px 5px #CCC;
    background:-webkit-gradient(linear,left top,left bottom,from(#f4f4f4),to(#e8e8e8));
    background:-moz-linear-gradient(top,#f4f4f4,#e8e8e8);
    background:linear-gradient(top,#f4f4f4,#e8e8e8);
    padding:8px;

  }
  .button:Hover {
    box-shadow: 0px 0px 10px #CCC;
    cursor:pointer;
  }

.open:Hover {
    box-shadow: 0px 0px 10px #CCC;
    cursor:pointer;
  }

	</style>
    
</head>
<body>
<div id="header">
<div id="header_title"> <span style="color:#005072;">Employee</span> Search System </div>
</div>
<div id="nav">
  <div id="menu">
  <a class="button_menu" href="<?= base_url()."index.php/hr"?>">Menu</a>
  <a class="button_menu" href="<?= base_url()."index.php/find_employee"?>">Search</a>
  <a class="button_menu" href="<?= base_url()."index.php/hr/add_employee_view"?>">Add Employee</a>
  <a class="button_menu" href="<?= base_url()."index.php/hr/remove_employee_search"?>">Remove Employee</a>
  </div>
</div>
