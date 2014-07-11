<?php
	@session_start();
	require 'config.db.php';
	
	if( !isset($_SESSION['user_id']) ) {		
	
		echo '<script type="text/javascript">
				alert("请先登陆");
				window.location.href="admin.php";
			</script>';
		
	} else {
	
		if( $_POST ) {
		
			$new_url = isset( $_POST['new_url'] ) ? $_POST['new_url'] : '';
			
			$jmpUrl = $_SERVER['HTTP_REFERER'];
			
			if( '' != $new_url ) {
				
				$table = 'url';
				
				$datas = array('url' => $new_url);
				
				$result = $db->insert($table, $datas);
				
				if( $result ) {
					
					$message = "添加url成功";
					
				} else {
					
					$message = "添加url失败";
					
				}
				
			} else {
				
				$message = "请输入url";
				
			}
				
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