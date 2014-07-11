<?php
	@session_start();
	require 'config.db.php';

    $uri = $_SERVER['REQUEST_URI'];

    echo $uri."<br />";

    $pattern = "#id=[0-9]{1,}#";

    if( $uri == '/' ||  preg_match($pattern, $uri) ) {
        
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
		

     } else {

         $table = 'url';

         $columns = '*';

         $alia = str_replace("/", '', $uri);

         $where = array('alia' => $alia, 'ORDER' => 'url_id DESC');

         $urlInfo = $db->get($table, $columns, $where);

         var_dump($urlInfo);

     }

	if( $urlInfo ) {
			
        header("location:".$urlInfo['url']);
			
    }

