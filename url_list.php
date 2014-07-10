<?php
	@session_start();
	header("Content-Type:text/html;Charset=utf-8");
	
	require_once 'config.db.php';
	
	if( !isset($_SESSION['user_id']) ) {
		
		echo '<script type="text/javascript">
				alert("请先登陆");
				window.location.href="admin.php";
			</script>';
		
	} else {
		
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		
		$count = 10;
		
		$table = 'url';
		
		$join = "*";
		
		$total = $db->count($table);
		
		$pageNum = intval(ceil($total / $count));
		
		$page = $page > $pageNum ? $pageNum : $page;
		
		$offset = ($page - 1) * $count;
		
		$where = array("ORDER" => 'url_id ASC', 'LIMIT' => array($offset, $count));
		
		$urlList = $db->select($table, $join, $where);
		
		//var_dump($urlList);
		
	}
	
	
?>
<html>
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
* {
	font-family: arial;
}

a {
	text-decoration: none;
}

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
a.page:hover {
	background: blue;
}

</style>
</head>
<body style="font:Arial;">
<div>
<div align="center" style="padding-top:100px;" >
<table width="60%" border="1" cellpadding="3" cellspacing="1" align="center" style="border-collapse: collapse;">
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
<td style=\"text-align:center\" width=\"25%\">
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
	
	
	
	if( $page > 1 ) {
		$tmp = $page - 1;
		echo '<a class="page" href="?page=1">&lt;&lt;</a>&nbsp&nbsp;';
		echo '<a class="page" href="?page='.$tmp.'">&lt;</a>&nbsp&nbsp;';
	}
	if( $page > 4 ) {
		echo '...';
	}
	for ($i = 1; $i < $page + 3 && $i <= $pageNum; $i++) {
		if( abs($page - $i) < 3 ) {
			if( $i == $page ) {
				echo '<b>'.$i.'</b>&nbsp;&nbsp;';
			} else {
				echo '<a class="page" href="?page='.$i.'">'.$i.'</a>&nbsp&nbsp;';
			}
		}
	}
	if( ($pageNum - $page) > 3) {
		echo '...';
	}
	
	if( $page < $pageNum ) {
		$tmp = $page + 1;
		echo '<a class="page" href="?page='.$tmp.'">&gt;</a>&nbsp&nbsp;';
		echo '<a class="page" href="?page='.$pageNum.'">&gt;&gt;</a>&nbsp&nbsp;<br />';
	}
?>
<div style="margin-top:50px;">
<form action="create_url.php" method="post" align="center">
新URL:&nbsp;&nbsp;<input type="text" name="new_url" style="width:30%"/>&nbsp;&nbsp;
<input type="submit" value="添加" text-align="center"/>
</form>
</div>
<div align="center" style="margin-top:20px"><a href="logout.php" align="center"><b>登&nbsp;出</b></a></div>
</div>
<div id="light" class="white_content">
<form id="edit_form" action="" method="post" align="center" style="padding-top:30px">
	URL:&nbsp;&nbsp;<input type="text" name="new_url" id="edit_url" style="width:40%"/><br /><br /><br />
	<input type="submit" value="更新" />&nbsp;&nbsp;
	<input type="button" value="取消" onclick="closePanel()"/>
</form>
</div>
<div id="fade" class="black_overlay"></div>
</body>
</html>