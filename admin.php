<?php 
	@session_start();
	if( isset($_SESSION['user_id']) ) {
		header('location:url_list.php');
	}


?>

<form action="login.php" method="post" >
	账号：<input type="text" name="user_name"/><br />
	密码：<input type="password" name="user_password"/><br />
	<input type="submit" value="登陆"/>
</form>
	
	