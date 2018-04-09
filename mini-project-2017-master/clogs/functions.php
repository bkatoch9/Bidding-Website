<?php

	require_once('tables.php');

	function clean($link, $str) {
		$data = trim($str);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		
		return mysqli_escape_string($link, $data);
	}

	function user_present($link, $email) {

		global $users_info;
		$q = "SELECT COUNT(*) as num  FROM $users_info WHERE email = '$email'";
		$exec = mysqli_query($link, $q);
		
		if ($exec){
			$x = mysqli_fetch_object($exec);
			if ($x->num == 0)
				return false;
		}

		return true;
	}

	function drop_user($link, $email) {
	
		global $users_info;
		$q = "DELETE FROM $users_info WHERE email = '$email'";
		if (mysqli_query($link, $q))
			return true;

		return false;
	}

	function is_email_varified($link, $username) {

		global $user_login;
		$q = "SELECT is_email_varified FROM $user_login WHERE username = '$username'";
		$exec = mysqli_query($link,$q);
	
		if ($exec){
			$x = mysqli_fetch_object($exec);
			if ($x->is_email_varified == 1)
				return true;
		}

		return false;
	}

	function get_user_name($link, $username) {

		global $users_info;
		$q = "SELECT CONCAT(f_name,' ', l_name) AS name from $users_info WHERE email = '$username'";
		$row = mysqli_query($link, $q);
		
		if ($row && (mysqli_num_rows($row) == 1)) {
			$x = mysqli_fetch_object($row);
			return ', '.$x->name;
		}

		return $q;

	}

	function get_user_id($link, $username) {
		global $users_info;
		$q = "SELECT id FROM $users_info WHERE email = '$username'";
		$row = mysqli_query($link, $q);
		
		if ($row) {
			$x = mysqli_fetch_object($row);
			if (strlen($x->id) != 0)
				return $x->id;	
		}

		return null;
	}

	function get_active_items($link, $cat, $today) {

		global $items;
		$q = "SELECT * FROM $items WHERE expiry_date > '$today' AND category = '$cat' LIMIT 3";
		$row = mysqli_query($link, $q);
		$num = mysqli_num_rows($row);

		if ($num !=0 )
			return $row;
		else
			return null;
	}

	function get_all_items($link, $cat, $today) {

		global $items;
		$q = "SELECT * FROM $items WHERE expiry_date > '$today' AND category = '$cat'";
		$row = mysqli_query($link, $q);
		$num = mysqli_num_rows($row);

		if ($num !=0 )
			return $row;
		else
			return null;
	}

	function addDayswithdate($date,$days){

    $date = strtotime("+".$days." days", strtotime($date));
    return  date("Y-m-d H:i:s", $date);

	}
	
	function get_item($link, $item_id) {
		global $items;
		$q = "SELECT * FROM $items WHERE id = '$item_id'";
		$row = mysqli_query($link, $q);
		if ($row && (mysqli_num_rows($row) != 0)){
			$x = mysqli_fetch_object($row);
			return $x;
		}

		return null;
	}

	function get_bids($link, $item_id) {
		global $bids;
		$q = "SELECT * FROM $bids WHERE item_id = '$item_id' ORDER BY bid_amt DESC LIMIT 3";
		$row = mysqli_query($link, $q);
		if ($row && (mysqli_num_rows($row)) != 0) 
			return $row;

		return null;
	}

	function get_max_bid($link, $item_id) {
		global $bids;
		$q = "SELECT MAX(bid_amt) AS bid_amt FROM $bids WHERE item_id = '$item_id'";
		$row = mysqli_query($link, $q);
		if ($row) {
			$x = mysqli_fetch_object($row);
			return $x->bid_amt;
		}
		return null;

	}

	function get_user_info($link, $user_id) {
		global $users_info;
		$q = "SELECT * FROM $users_info WHERE id = '$user_id'";
		$row = mysqli_query($link, $q);
		if ($row && (mysqli_num_rows($row) !=0)){
			$x = mysqli_fetch_object($row);
			return $x;
		}
		return null;
	}

	function find_bid($link, $item_id, $user_id) {
		global $bids;
		$q = "SELECT COUNT(*) AS num FROM $bids WHERE user_id = '$user_id' AND item_id='$item_id'";
		$row = mysqli_query($link, $q);
		if ($row && (mysqli_num_rows($row) != 0)){
			$x = mysqli_fetch_object($row);
			if ($x->num == 1)
				return true;
			return false;
		}

			

		return false;
	}
	function get_user_id_($link, $email) {
		global $users_info;
		$q = "SELECT id AS user_id FROM $users_info WHERE email = '$email'";
		$row = mysqli_query($link, $q);
		if ($row && (mysqli_num_rows($row) !=0 )) {
			$x = mysqli_fetch_object($row);
			return $x->user_id;
		}
		return null;
	}

	function get_bids_left($link, $user_id) {
		global $users_info;
		$q = "SELECT bids_left AS bids_left FROM $users_info WHERE id = '$user_id'";
		$row = mysqli_query($link, $q);
		if ($row && mysqli_num_rows($row)) {
			$x = mysqli_fetch_object($row);
			return $x->bids_left;
		}

		return null;
	}

	/*getting the maximum bids for all the different items 

select user_id, item_id, bid_amt 
from bids 
where bid_amt in 
	(select max(bid_amt) 
     	from bids where 
     	item_id in 
     		(select distinct item_id 
             	from bids where 
             	item_id in 
             		(select id 
                     	from items 
                     	where expiry_date < '2017-11-17'
                    )
            ) 
     group by item_id)
	*/
    function get_all_winners($link) {
    	global $bids;
    	$today = date('Y-m-d H:i');
    	$q = "select user_id, item_id, bid_amt, is_payment_done from bids where bid_amt in (select max(bid_amt) from bids where item_id in (select distinct item_id from bids where item_id in (select id from items where expiry_date < '$today' )) group by item_id)";
    	$row = mysqli_query($link, $q);
    	if ($row && (mysqli_num_rows($row) != 0))
    		return $row;
    	return null;
    }

    function get_user_bids($link, $user_id) {
    	global $bids;
    	$q = "SELECT * from bids WHERE user_id = '$user_id'";
    	$row = mysqli_query($link, $q);
    	if ($row && (mysqli_num_rows($row) != 0))
    		return $row;
    	return null;
    }

    function get_all_user_items($link, $user_id, $today) {
    	global $items;
    	$q = "SELECT * FROM $items WHERE user_id = '$user_id' AND expiry_date > '$today'";
    	$row = mysqli_query($link, $q);
    	if ($row && (mysqli_num_rows($row) != 0))
    		return $row;
    	else
    		return null;
    }

    function get_category_name($link, $cat_code) {
    	global $item_category;
    	$q = "SELECT cat_name FROM $item_category WHERE cat_code = '$cat_code'";
    	$row = mysqli_query($link, $q);
    	if ($row && (mysqli_num_rows($row) == 1)){
    		$x = mysqli_fetch_object($row);
    		return $x->cat_name;
    	}

    	return null;
    }

    function get_some_auct_items($link, $num) {
    	global $bids;
    	global $items;
    	$today = date('Y-m-d H:i');
    	$q = "SELECT * FROM $bids WHERE item_id IN (SELECT id FROM $items WHERE expiry_date > '$today' ) LIMIT $num";
    	$row = mysqli_query($link, $q);
    	if ($row && (mysqli_num_rows($row) !=0 )) 
    		return $row;
    	return null;
    }

    function get_10_day_pending_items($link, $date) {
    	global $items;
    	$q  = "SELECT * FROM $items WHERE auction_date >= '$date'";
    	$row = mysqli_query($link, $q);
    	if ($row && (mysqli_num_rows($row)!=0))
    		return $row;
    	return null;
    }

?>

