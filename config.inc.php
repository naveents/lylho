<?php
/* Title : Ajax Pagination with jQuery & PHP
Example URL : http://www.sanwebe.com/2013/03/ajax-pagination-with-jquery-php */

$db_username 		= 'thun_lylho'; //database username
$db_password 		= 'TN&Mpnl;GOB!'; //dataabse password
$db_name 			= 'thun_lylho'; //database name
$db_host 			= 'localhost'; //hostname or IP
$item_per_page 		= 5; //item to display per page

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}


?>