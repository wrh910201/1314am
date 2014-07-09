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
<head>
<script type="text/javascript">

function closePanel() {
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none';
}


function showPanel() {
	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block'
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

		foreach ($urlList as $k => $v) {

			echo "
<tr style=\"text-align:center\">
<td style=\"text-align:center\">".$v['url_id']."</td>
<td>".$v['url']."</td>
<td style=\"text-align:center\">
<a href=\"index.php?id=".$v['url_id']."\">预览</a>&nbsp;&nbsp;
<a href=\"javascript:void(0)\" onclick=\"showPanel();\">编辑</a>&nbsp;&nbsp;
<a href=\"delete_url.php?id=".$v['url_id']."\">删除</a>				
</td>
</tr>";
		}
	}
?>

</table><br />
<div style="margin-top:50px;">
<form action="create_url.php" method="post" align="center">
新URL:<input type="text" name="new_url" style="width:40%"/>&nbsp;&nbsp;
<input type="submit" value="添加" />
</form>
</div>
<div align="center" style="margin-top:20px"><a href="logout.php" align="center">登出</a></div>
</div>
<div id="light" class="white_content">
<form action="update_url.php?id=<?php echo $id;?>" method="post" align="center" style="padding-top:30px">
	URL:<input type="text" name="new_url" value="<?php echo isset($urlInfo['url'])?$urlInfo['url']:'';?>" style="width:40%"/><br /><br /><br />
	<input type="submit" value="更新" />&nbsp;&nbsp;
	<input type="button" value="取消" onclick="closePanel()"/>
</form>
</div>
<div id="fade" class="black_overlay"> 
</div>
</body>