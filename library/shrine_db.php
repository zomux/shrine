<?php
switch($_CONFIG['DbType']){
	case 'access':
		require_once('Shrine_Db-access.php'); break;
	case 'mssql':
		require_once('Shrine_Db-mssql.php'); break;
	case 'mysql':
		require_once('drivers/mysql.php'); break;
	default:
		require_once('drivers/mysql.php'); break;
}
?>