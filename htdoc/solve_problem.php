<?php 
    include_once("connection.php"); 
    if($_POST['cinfo_id'] && $_POST['cinfo_difficulty'] && $_POST['cinfo_quality'] && $_POST['cinfo_right']) { 
        $cid = $_POST['cinfo_id'];  
		$cdiff = $_POST['cinfo_difficulty'];
		$cqual = $_POST['cinfo_quality'];
		$cright = $_POST['cinfo_right'];
		
		$query = "SELECT card_difficulty, card_quality, card_solvednum, card_evalnum FROM card WHERE card_id ='$cid'";
		$result = mysqli_query($conn, $query);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$o_cdiff = $row['card_difficulty'];
			$o_cqual = $row['card_quality'];
			$o_csolv = $row['card_solvednum'];
			$o_ceval = $row['card_evalnum'];
		}
		
		//Update difficulty of the card
		if($isFirst != -1){			
			$n_cdiff = ($o_cdiff * $o_ceval + $cdiff) / ($o_ceval + 1);			
			$query = "UPDATE card SET card_difficulty='$n_cdiff' WHERE card_id ='$cid'";
		} else {
			$query = "UPDATE card SET card_difficulty='$cdiff' WHERE card_id ='$cid'";
		}
		mysqli_query($conn, $query);
		
		//Update quality of the card
		if($isFirst != -1){			
			$n_cqual = ($o_cqual * $o_ceval + $cqual) / ($o_ceval + 1);			
			$query = "UPDATE card SET card_quality='$n_cqual' WHERE card_id ='$cid'";
		} else {
			$query = "UPDATE card SET card_quality='$cqual' WHERE card_id ='$cid'";
		}
		mysqli_query($conn, $query);
		
		//Update solved number and evaluation number of the card
		if($cright > 0){
			$n_csolv = $o_csolv + 1;
		} else {
			$n_csolve = $o_csolv;
		}
		$n_ceval = $o_ceval+1;
		$query = "UPDATE card SET card_solvednum='$csolv', card_evalnum='$ceval' WHERE card_id ='$cid'";
		mysqli_query($conn, $query);
        
        mysqli_close($conn);	
		exit;  
    } 
?>
