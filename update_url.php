<?php
	@session_start();
	header("Content-Type:text/html;Charset=utf-8");
	require 'config.db.php';
	
	if( !isset($_SESSION['user_id']) ) {
	
		echo '<script type="text/javascript">
						alert("请先登陆");
						window.location.href="admin.php";
					</script>';
	
	} else {
		
		if( $_POST ) {
	
			$id = isset($_GET['id']) ? $_GET['id'] : '';
		
			$table = 'url';
		
			$columns = '*';
			
			$jmpUrl = $_SERVER['HTTP_REFERER'];
		
			if( '' != $id ) {
					
				$id = intval($id);
					
				$where = array('url_id' => $id);
					
				$urlInfo = $db->get($table, $columns, $where);
				
				if( $urlInfo ) {
					
					$new_url = isset( $_POST['new_url'] ) ? $_POST['new_url'] : '';

                    $alia = isset( $_POST['alia']) ? $_POST['alia'] : '';
					
					$data = array('url' => $new_url, 'alia' => $alia);
					
					$result = $db->update($table, $data, $where);
						
					$message = 'url更新成功';
						
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
