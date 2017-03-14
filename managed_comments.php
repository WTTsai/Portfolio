<?php
  $con = mysqli_connect("127.0.0.1","wtsai9_cs242","4933575");
  if (!$con)
  {
    
    die('Could not connect: ' . mysql_error());
  
  }


  if($_POST){
	  mysqli_select_db($con, 'wtsai9_Assignment3');
	  
	  $user_name = $_POST['name'];
	  $comment = $_POST['comment'];
	  
	  //User mysqli_real_escape_string to avoid users attempt to use an sql injection attack 
	  $comment =  mysqli_real_escape_string($con, $comment);
	  $user_name = mysqli_real_escape_string($con, $user_name);
	  
	  $filter_query = "SELECT * FROM  `Filter` LIMIT 0 , 30";
	  $filters = mysqli_query($con, $filter_query);
	  
	  //use str_replace to replace red flag words with replacement words
	  while ($row = mysqli_fetch_array($filters, MYSQL_ASSOC)) 
    	  {
		$comment = str_replace($row["red_flag"], $row["replace_with"], $comment);
    	  }
    	  
    	  //parent = -1 is the root, otherwise it's the child of some comment
    	  //child = -1 no child, update to 1 when theres child 
    	  //pageID is the assignment number 0, 1, or 2
	  $query = "INSERT INTO `wtsai9_Assignment3`.`Comments` (`id`, `name`, `comment`, `parent`, `child`, `pageID`) 
	  VALUES ('', '$user_name', '$comment',   ".$_POST["parent"].", '-1',  ".$_POST["pageID"].");";
	  mysqli_query($con, $query);
	  
	  //parent has child
	  if($_POST["parent"] != -1){
	  	$update = "UPDATE `Comments` SET `child` = 1 WHERE id = ".$_POST["parent"]."";
	  	mysqli_query($con, $update);
	  	
	  }
	  
		  
}



?>