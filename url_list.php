<?php
	@session_start();
	require_once 'config.db.php';
	
	if( !isset($_SESSION['user_id']) ) {
		
		echo '<script type="text/javascript">
				alert("请先登陆");
				window.location.href="admin.php";
			</script>';
		
	} else {
		
		$table = 'url';
		
		$join = "*";
		
		$where = array("ORDER" => 'url_id ASC');
		
		$urlList = $db->select($table, $join, $where);
		
		//var_dump($urlList);
		
	}
	
	
?>


<a href="logout.php">登出</a>
<table border="1" cellpadding="3" cellspacing="1" align="center">
<tr>
<th>id</th>
<th>url</th>
<th>操作</th>
</tr>

<?php 
	if( $urlList ) {

		foreach ($urlList as $k => $v) {

			echo "
<tr>
<td>".$v['url_id']."</td>
<td>".$v['url']."</td>
<td>
<a href=\"index.php?id=".$v['url_id']."\">预览</a>&nbsp;&nbsp;
<a href=\"edit_url.php?id=".$v['url_id']."\">编辑</a>&nbsp;&nbsp;
<a href=\"delete_url.php?id=".$v['url_id']."\">删除</a>				
</td>
</tr>";
		}
	}
?>

</table><br />
<form action="create_url.php" method="post" >
新url:<input type="text" name="new_url" />&nbsp;&nbsp;
<input type="submit" value="添加" />
</form>