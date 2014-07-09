<?php

	@session_start();
	require 'config.db.php';
	
	if( !isset($_SESSION['user_id']) ) {
	
		echo '<script type="text/javascript">
						alert("请先登陆");
						window.location.href="admin.php";
					</script>';
	
	} else {
	
		$id = isset($_GET['id']) ? $_GET['id'] : '';
	
		$table = 'url';
	
		$columns = '*';
	
		if( '' != $id ) {
				
			$id = intval($id);
				
			$where = array('url_id' => $id);
				
			$urlInfo = $db->get($table, $columns, $where);
			
			if( $urlInfo ) {
					
				$result = $db->delete($table, $where);
						
				$message = 'url删除成功';
						
				$jmpUrl = 'url_list.php';
					
			} else {
					
				$message = '该url不存在';
					
				$jmpUrl = 'url_list.php';
					
			}
		} else {
				
			$message = '没有id，无效的操作';
				
			$jmpUrl = 'url_list.php';
				
		}
	}
?>

<html>
<head>
<meta http-equiv="refresh" content="3; url=<?php echo $jmpUrl;?>" />
</head>
<body>
<p><?php echo $message;?>,3s后跳转到...</p>
</body>
</html>