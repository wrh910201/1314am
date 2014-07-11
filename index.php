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
			
		} else {
			
			$where = array('ORDER' => 'url_id DESC');
			
			$urlInfo = $db->get($table, $columns, $where);
			
		}
		
		if( $urlInfo ) {
			
			header("location:".$urlInfo['url']);
			
		}
		
		
	}