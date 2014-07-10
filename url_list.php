<?php
	@session_start();
	require_once 'config.db.php';
	
	if( !isset($_SESSION['user_id']) ) {
		
		echo '<script type="text/javascript">
				alert("请先登陆");
				window.location.href="admin.php";
			</script>';
		
	} else {
		
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		
		$count = 10;
		
		$offset = ($page - 1) * $count;
		
		$table = 'url';
		
		$join = "*";
		
		$total = $db->count($table);
		
		$pageNum = intval(ceil($total / $count));
		
		$where = array("ORDER" => 'url_id ASC', 'LIMIT' => array($offset, $count));
		
		$urlList = $db->select($table, $join, $where);
		
		//var_dump($urlList);
		
	}
	
	
?>
<head>
<script type="text/javascript">

function closePanel() {
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none';
}


function showPanel(url_id) {
	var url_obj = document.getElementById(url_id);
	var edit_url_obj = document.getElementById('edit_url');
	var edit_form_obj = document.getElementById('edit_form');

	edit_url_obj.value = url_obj.textContent;
	edit_form_obj.action = "update_url.php?id=";
	edit_form_obj.action += url_id;

	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block';
	
}

</script>

<style>
.black_overlay{  
 	display: none;  
 	position: absolute;  
 	top: 0%;  left: 0%;  
 	width: 100%;  
 	height: 100%;  
 	background-color: black;  
 	z-index:1001;  
 	-moz-opacity: 0.8;  
 	opacity:.80;  
 	filter: alpha(opacity=80);  
}  
.white_content {  
	display: none;  
	position: absolute;  
	top: 25%;  left: 25%;  
	width: 50%;  
	height: 50%;  
	padding: 16px;    
	background-color: white;  
	z-index:1002;  
	overflow: auto;  
}

</style>
</head>
<body style="font:Arial;">
<div>
<div align="center" style="padding-top:100px;" >
<table width="80%" border="1" cellpadding="3" cellspacing="1" align="center" style="border-collapse: collapse;">
<tr>
<th>ID</th>
<th>URL</th>
<th>操作</th>
</tr>

<?php 
	if( $urlList ) {
		$tmp = $_SERVER['SCRIPT_NAME'];
		$tmp = str_replace('url_list.php', '', $tmp);
		foreach ($urlList as $k => $v) {

			echo "
<tr style=\"text-align:center\">
<td style=\"text-align:center\">".$v['url_id']."</td>
<td id=\"".$v['url_id']."\">".$v['url']."</td>
<td style=\"text-align:center\">
<a href=\"".$tmp."?id=".$v['url_id']."\">预览</a>&nbsp;&nbsp;
<a href=\"javascript:void(0)\" onclick=\"showPanel(".$v['url_id'].");\">编辑</a>&nbsp;&nbsp;
<a href=\"delete_url.php?id=".$v['url_id']."\">删除</a>				
</td>
</tr>";
		}
	}
?>

</table><br />
<?php 
	echo "<span>共".$pageNum."页</span>&nbsp;&nbsp;<span>当前第".$page."页</span>&nbsp;&nbsp;";
	if( $page > 1 ) {
		$tmp = $page - 1;
		echo '<a href="?page='.$tmp.'">prev</a>&nbsp&nbsp;';
	}
	if( $page < $pageNum ) {
		$tmp = $page + 1;
		echo '<a href="?page='.$tmp.'">next</a>&nbsp&nbsp;<br />';
	} 
?>
<div style="margin-top:50px;">
<form action="create_url.php" method="post" align="center">
新URL:<input type="text" name="new_url" style="width:40%"/>&nbsp;&nbsp;
<input type="submit" value="添加" />
</form>
</div>
<div align="center" style="margin-top:20px"><a href="logout.php" align="center">登出</a></div>
</div>
<div id="light" class="white_content">
<form id="edit_form" action="" method="post" align="center" style="padding-top:30px">
	URL:<input type="text" name="new_url" id="edit_url" style="width:40%"/><br /><br /><br />
	<input type="submit" value="更新" />&nbsp;&nbsp;
	<input type="button" value="取消" onclick="closePanel()"/>
</form>
</div>
<div id="fade" class="black_overlay"> 
</div>
</body>