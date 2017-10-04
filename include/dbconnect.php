<?php
	$conn = mysql_connect("160.153.16.7", "searchnow","Abcd@1234") or die ('Error Connect Database');
	mysql_query("SET character_set_results=utf8");
	mb_language('uni');
	mb_internal_encoding('UTF-8');
	mysql_select_db("db_tshirtno1") or die ('Error Connect Database');
	