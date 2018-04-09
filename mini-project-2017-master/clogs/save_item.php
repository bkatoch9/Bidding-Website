<?php
	
	session_start();
	require_once('db_connect.php');
	require_once('functions.php');
	global $items;
	global $auct_max;
	$d_folder = 'item_img/';

	function is_img($ext) {
		if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg')
			return true;
		return false;
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_POST['itm_name']) && isset($_POST['itm_cat'])
				&& isset($_POST['auct_time']) && isset($_POST['auct_date'])
				&& isset($_POST['auct_dur']) && isset($_POST['auct_starting_price'])
				&& isset($_POST['auct_bid_interval']) && isset($_POST['itm_desc']) 
				&& isset($_FILES)) {

			$itm_name = clean($link, $_POST['itm_name']);
			$itm_cat = clean($link, $_POST['itm_cat']);
			$auct_date_time = clean($link, $_POST['auct_date'])." ".clean($link, $_POST['auct_time']);
			$auct_starting_price = clean($link, $_POST['auct_starting_price']);
			$auct_bid_interval = clean($link, $_POST['auct_bid_interval']);
			$itm_desc = clean($link, $_POST['itm_desc']);
			$auct_dur = $_POST['auct_dur'];

			$img0 = strtolower(pathinfo($_FILES['itm_img']['name'][0], PATHINFO_EXTENSION));
 			$img1 = strtolower(pathinfo($_FILES['itm_img']['name'][1], PATHINFO_EXTENSION));
 			$img2 = strtolower(pathinfo($_FILES['itm_img']['name'][2], PATHINFO_EXTENSION));
 			$img3 = strtolower(pathinfo($_FILES['itm_img']['name'][3], PATHINFO_EXTENSION));

 			if (!is_img($img0) || !is_img($img1)
 				 || !is_img($img2) || !is_img($img3)) {

 					echo "Valid Item Image could not be found! Please Try Again.";
 					echo $img0.$img1.$img2.$img3;
 					die();
 			}else{

 			$f0 = $d_folder.rand(1,9999).$_FILES['itm_img']['name'][0];
 			$f1 = $d_folder.rand(1,9999).$_FILES['itm_img']['name'][1];
 			$f2 = $d_folder.rand(1,9999).$_FILES['itm_img']['name'][2];
 			$f3 = $d_folder.rand(1,9999).$_FILES['itm_img']['name'][3];
 			
 			if ( !move_uploaded_file($_FILES['itm_img']['tmp_name'][0], $f0) &&
 				 !move_uploaded_file($_FILES['itm_img']['tmp_name'][0], $f1) &&
 				 !move_uploaded_file($_FILES['itm_img']['tmp_name'][0], $f2) &&
 				 !move_uploaded_file($_FILES['itm_img']['tmp_name'][0], $f3)) {

 					echo "Could not upload the Image! Please try again.";
 					die();
 			} 
 			else {
 				
 				$fp[0] = $f0;
 				$fp[1] = $f1;
 				$fp[2] = $f2;
 				$fp[3] = $f3;
 				$fp[4] = 1;
 				$user = $_SESSION['username_'];
 				$itm_id = "GEU-".rand(1,9999);
 				$user_id = get_user_id($link, $user);
 				$url_name = strtolower(preg_replace('#[ -]+#', "-", $itm_name));
 				$expiry_date = addDayswithdate($auct_date_time, $auct_dur);

 				if ($user_id != null){

	 				$q = "INSERT INTO $items (id, user_id, name, category, item_desc, img, img1, img2, img3, bid_min_amt, bid_max_amt, bid_interval, item_url_name, auction_date, expiry_date) VALUES ('$itm_id', '$user_id', '$itm_name', '$itm_cat', '$itm_desc', '$f0', '$f1', '$f2', '$f3', '$auct_starting_price','$auct_max', '$auct_bid_interval', '$url_name', '$auct_date_time', '$expiry_date')";
	 		
	 				if (mysqli_query($link, $q)){
	 					echo "Item Saved Successfully!";	
	 				} 
	 				else
	 					echo "Could not save data. Please try again!";

	 				
 				}
 				else
 					echo "No Username found!";

 			}
 		}

					/*var_dump($_FILES['itm_img']['tmp_name'][2]) ;*/
		}

		else {
			echo "Please fill all the required fields!";
		}

	}
?>