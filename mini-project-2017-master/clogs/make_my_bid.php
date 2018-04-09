<?php

	require_once('db_connect.php');
	require_once('functions.php');
	global $bids, $users_info;


	if (isset($_POST['user_id']) && isset($_POST['item_id']) 
			&& isset($_POST['bid_amt'])) {

		$amt = clean($link, $_POST['bid_amt']);
		$user_id = clean($link, $_POST['user_id']);
		$item_id = clean($link, $_POST['item_id']);
		$bid_id = "BID".rand(1,9999).rand(1,9999);

		
		if (!find_bid($link, $item_id, $user_id)) 
			$qq = "INSERT INTO $bids (bid_id, item_id, user_id, bid_amt) VALUES ('$bid_id', '$item_id', '$user_id', '$amt')";
		else
			$qq = "UPDATE $bids SET bid_amt = '$amt' WHERE user_id = '$user_id' AND item_id='$item_id'";

		$exec = mysqli_query($link, $qq);
		if ($exec) {
			$bids_left = get_bids_left($link, $user_id);
			$bids_left--;
			$qqq = "UPDATE $users_info SET bids_left = '$bids_left' WHERE id = '$user_id'";
			if (!mysqli_query($link, $qqq)){
				echo mysqli_error($link);
				die();
			}
			else
				echo "Congratulations! Your bid has been placed.";		
		}
		
		} 

?>