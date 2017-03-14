<?php 
	include_once "managed_comments.php";
	
	//automatically post comment with document.test_form.submit()
	function post_comment_test(){
		
		echo "<form name = 'test_form' method='post'>";
		echo "<input type='hidden' name='name' value='name_test7'>";						
		echo "<input type = 'hidden' name='comment' value = 'comment_test7'>";		
	        echo "<input type='hidden' name='parent' value='-1'>";
	        echo "<input type= 'hidden' name='pageID' value = '4'>";	
		echo "<script language='JavaScript'>document.test_form.submit()";
		echo "</script>";
		echo "</form>";
		
	}
	
	//replace the word with appropriate phrase
	function post_red_flag_test(){
		echo "<form name = 'test_form' method='post'>";
		echo "<input type='hidden' name='name' value='red_flag_Test'>";						
		echo "<input type = 'hidden' name='comment' value = 'This assignment sucks'>";		
	        echo "<input type='hidden' name='parent' value='-1'>";
	        echo "<input type= 'hidden' name='pageID' value = '4'>";	
		echo "<script language='JavaScript'>document.test_form.submit()";
		echo "</script>";
		echo "</form>";
	
	}
	
	//reply to comment with ID 1
	function post_reply_test(){
		echo "<form name = 'test_form' method='post'>";
		echo "<input type='hidden' name='name' value='red_flag_Test'>";						
		echo "<input type = 'hidden' name='comment' value = 'Reply Page'>";		
	        echo "<input type='hidden' name='parent' value='1'>";
	        echo "<input type= 'hidden' name='pageID' value = '4'>";	
		echo "<script language='JavaScript'>document.test_form.submit()";
		echo "</script>";
		echo "</form>";	
	
	}
	
	
	post_comment_test();
	
	post_red_flag_test();
	
	post_reply_test();	
	
?>