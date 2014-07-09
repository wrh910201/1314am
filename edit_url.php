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
		}
	}
?>

<form action="update_url.php?id=<?php echo $id;?>" method="post" >
	url:<input type="text" name="new_url" value="<?php echo isset($urlInfo['url'])?$urlInfo['url']:'';?>" />&nbsp;&nbsp;
	<input type="submit" value="更新" />
</form>

