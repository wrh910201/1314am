<?php 
	@session_start();
	header("Content-Type:text/html;Charset=utf-8");
	
	if( isset($_SESSION['user_id']) ) {
		header('location:url_list.php');
	}


?>

<form action="login.php" method="post" align="center" style="margin: 100px;">
	账号：<input type="text" name="user_name"/><br /><br />
	密码：<input type="password" name="user_password"/><br /><br />
	<input type="submit" value="登陆"/>
</form>
	
	