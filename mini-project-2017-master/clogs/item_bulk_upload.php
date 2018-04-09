<?php

  require_once('db_connect.php');
  require_once('functions.php');
  require_once('tables.php');
  $d_folder = "bulk_upload/";
  $file = null;
  if (isset($_FILES['file_inp']) && (strlen($_FILES['file_inp']['name']) != 0)) {

    $imageFileType = pathinfo($_FILES['file_inp']['name'], PATHINFO_EXTENSION);
    if ($imageFileType != 'csv'){
      echo "Only .csv files are allowed!";
      die();
    }
    else {
      $file_name = rand(1,1000).$_FILES['file_inp']['name'];
      if(move_uploaded_file($_FILES['file_inp']['tmp_name'], $d_folder.$file_name))
        $file = $d_folder.$file_name;
        
    }
  }
  else{
    echo "No File Recieved!";
    die();
  }


  $error_code = 0;

  $csv = array_map('str_getcsv', file($file));
  $col_size = sizeof($csv[0]);
  $line_num = 1;
  $img_counter = 0;
  $num_counter = 0;
  $date_counter = 0;
  $time_counter = 0;

  
  function is_date_valid($date) {
  		$dt = DateTime::createFromFormat("Y-m-d", $date);
		return $dt !== false && !array_sum($dt->getLastErrors());
  }
   
  array_walk($csv, function(&$a, &$error_code) use ($csv, $error_code) {

    	global $col_size, $date_counter, $time_counter;
    	global $line_num, $img_counter, $num_counter, $items;

    	$is_dir = '^[a-zA-Z]:\\(((?![<>:"/\\|?*]).)+((?<![ .])\\)?)*$^';
/*      echo sizeof($a);
*/    	if (sizeof($a) == $col_size){
	 		// if all the fields are present, check for individual fileds' correct-ness

      		$a = array_combine($csv[0], $a);

				// Name, !notEmpty
				// Main-Image, !notEmpty
				// Image-1,Image-2,Image-3, !optional
				// Starting-Price, !notEmpty
				// Max-Price, !defalut: 9999
				// Bid-Interval, !default: Rs 5
				// Auction-Start-Date, !notEmpty
				// Auction-Durration, !notEmppty (in days)
				// Description !notEmpty

      		if (!empty($a['Name']) && !empty($a['Main-Image']) && !empty($a['Starting-Price'])
      				&& !empty($a['Auction-Start-Date']) && !empty($a['Auction-Duration'])
      					&& !empty($a['Description']) && !empty($a['Category'])){

/*            echo "checking errors";
*/
      			// default max-proce to 999
      			if (empty($a['Max-Price']))
      				$a['Max-Price']= 999;

      			// check if numeric input
      			if (!is_numeric($a['Starting-Price']) || !is_numeric($a['Max-Price']) 
      					|| !is_numeric($a['Bid-Interval']))
      				$num_counter++;
      			// check if date if valid.. :date(format):: YYYY-MM-DD
      			if (!is_date_valid($a['Auction-Start-Date']))
      				$date_counter++;

            if (!file_exists($a['Main-Image']) && !file_exists($a['Image-1']) 
                  && !file_exists($a['Image-2']) && !file_exists($a['Image-3']))
              $img_counter++;

            if (!preg_match('/(2[0-4]|[01][1-9]|10):([0-5][0-9])/', $a['Auction-time'])){
              echo "<br>".$a['Auction-time']."<br>";
              $time_counter++;
            }

/*            echo "error check complete";
*/            
			}
			else {
      			echo "Error at line ".$line_num.". Seems like not all required fields and filled!<br>";
      			die();
			}

      if ($time_counter > 1) {
        echo "Error in Action-Time. Plesae check all the time fields.";
        die();
      }

			if ($date_counter > 1){
				echo "Error Found in Auction Start Date, at line ".$line_num;
				die();
			}

      if ($img_counter > 1){
        echo "Some Images were not found! Please check the image paths!".$line_num;
        die();
      }

			if ($num_counter > 1){
				echo "Error Found in filled fields, at line ".$line_num;
				die();
			}

			if ($img_counter > 1){
				echo "Error Found in Image path, at line ".$line_num;
				die();
			}

      
    	}
      	else{
      		echo "Error at line ".$line_num."<br>";
      		die();
      	}

      	$line_num++;
        echo 'line number ++';
      	
    });
    array_shift($csv); # remove column header
    // file has all the valid data.
    array_walk($csv, function(&$a) use ($csv){

        global $link, $itm_prefix, $items;

        $d_img_folder = "item_img/";


        $file_name = pathinfo($a['Main-Image'],PATHINFO_BASENAME);
        $file_name_1 = pathinfo($a['Image-1'],PATHINFO_BASENAME);
        $file_name_2 = pathinfo($a['Image-2'],PATHINFO_BASENAME);
        $file_name_3 = pathinfo($a['Image-3'],PATHINFO_BASENAME);

        $img_path_main = $d_img_folder.rand(1,1000).rand(1,1000).$file_name;
        $img_path_main_1 = $d_img_folder.rand(1,1000).rand(1,1000).$file_name_1;
        $img_path_main_2 = $d_img_folder.rand(1,1000).rand(1,1000).$file_name_2;
        $img_path_main_3 = $d_img_folder.rand(1,1000).rand(1,1000).$file_name_3;


        copy($a['Main-Image'], $img_path_main);
        copy($a['Image-1'], $img_path_main_1);
        copy($a['Image-2'], $img_path_main_2);
        copy($a['Image-3'], $img_path_main_3);

        $date_start = $a['Auction-Start-Date'];
        $time_start = $a['Auction-time'];
        $date = $date_start." ".$time_start;
        
        $user_id = "AUCBAY-9285-592";
        $item_id = $itm_prefix.rand(1,1000).rand(1,1000);
        $name = clean($link, $a['Name']);
        $cat = clean($link, $a['Category']);
        $sp = clean($link, $a['Starting-Price']);
        $mp = clean($link, $a['Max-Price']);
        $bi = clean($link, $a['Bid-Interval']);
        $dur = clean($link, $a['Auction-Duration']);
        $desp = clean($link, $a['Description']);
        $url_name = clean($link, strtolower(str_replace(' ', '-', clean($link, $a['Name']))));
        $expiry_date = addDayswithdate($date_start." ".$time_start, $dur);



        $q = "INSERT INTO $items VALUES('$item_id', '$user_id', '$name', '$cat', '$desp', '$img_path_main', '$img_path_main_1', '$img_path_main_2', '$img_path_main_3', '$sp', '$mp', '$bi', '$url_name','$date', '$dur', '$expiry_date')";

        if (!mysqli_query($link, $q)){
          echo "Sorry, could not save data. Please try again."
          die();
        }else $cc++; 
          
    })
        if ($cc == $col_size)
          echo "Items uploaded succesfully!";
  
   
?>