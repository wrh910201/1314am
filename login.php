<?php
	@session_start();
	require 'config.db.php';
	
	if( isset($_SESSION['user_id']) ) {
	
		header('location:url_list.php');
	
	}
	
	
	if( $_POST ) {
		
		echo "login<br />";
		
		$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
		
		$user_password = isset($_POST['user_password']) ? $_POST['user_password'] : '';
		
		$jmpUrl = $_SERVER['HTTP_REFERER'];
		
		if( '' != $user_name && '' != $user_password ) {
			
			$user_password = md5($user_password);
			
			$table = 'user';
			
			$columns = '*';
			
			$where = array('user_name' => $user_name);
			
			$userInfo = $db->get('user', '*', $where);
			
			if( $userInfo ) {
				
				if( $userInfo['user_password'] == $user_password ) {
					
					$message = '登陆成功';
					
					$jmpUrl = "url_list.php";
					
					$_SESSION['user_id'] = $userInfo['user_id'];
					
				} else {
					
					$message = '账号或密码错误';
					
				}
				
			} else {
				
				$message = '账号或密码错误';
				
			}
			
		}else {
			
			$message = '请输入账号、密码';
			
		}
		
	}
	
?>

<html>
<head>
<meta http-equiv="refresh" content="3; url=<?php echo $jmpUrl;?>" />
</head>
<body>
<div style="text-align:center;padding-top:100px">
<p><?php echo $message;?>,3s后跳转到...<a href="<?php echo $jmpUrl;?>">这里</a></p>
</div>
</body>
</html>
	
	