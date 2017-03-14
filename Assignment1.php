<!--Template from https://templated.co/interphase-->
<?php
	include_once "parse.php";
	include_once "managed_comments.php";
	$assignment0 = new Assignment("Assignment1.0", "svn_log.xml", "svn_list.xml");
	$assignment1 = new Assignment("Assignment1.1", "svn_log.xml", "svn_list.xml");
	$assignment2 = new Assignment("Assignment1.2", "svn_log.xml", "svn_list.xml");
	
	$assignment = new Assignment("Assignment0", "svn_log.xml", "svn_list.xml");
	
	function print_comment($parentID, $comm, $comments)
	{
	    if($comm["parent"] == $parentID)
	    {
	    
	      $name = $comm['name'];
	      $comment = $comm['comment'];
	      $parent = $comm['parent'];
	      $id = $comm['id'];	  
	      $name = htmlspecialchars($comm['name'],ENT_QUOTES);
	      $comment = htmlspecialchars($comm['comment'],ENT_QUOTES);
	      
	      if($parent == -1){
	
		      echo "  <div id = 'comment_container' style='margin:20px 50px; border-width:3x; border-style:solid; border-color: #FF0000;  padding: 1em; background-color:#E8F6EF'>
		      <b><ins>$name</ins></b><br />
		      $comment<br />
		      </div> ";   
		       
		      echo "<form action='Assignment1.php#comments' id = 'myform' method='post'>";
		       echo "  <div style='margin:30px 50px;'>";
		       echo "<h4>"."Leave a reply..."."</h4>";
		       echo "Name: <input type='text' name='name' id='name'>"."<br />";						
		       echo "Comment:"."<br />";
		       echo "<textarea name='comment' id='comment'></textarea>"."<br/>";		
		       echo "<input type='hidden' name='parent' value=".$id.">";
		       echo "<input type= 'hidden' name='pageID' value = '1'>";	
		       echo "<input type='submit' value='Submit' onclick='send_data()'>";
		       echo "</div>";
		       echo "</form>";
		       echo "<hr style = 'background-color:#696969; border-width:0; color:#000000; height:3px; lineheight:0; display: inline-block; margin:0px 30px ; width:96%;' />";
		       
		}
		else{
		     echo "  <div id = 'comment_container' style='margin:20px 300px; border-width:3x; border-style:solid; border-color: #FF0000;  padding: 1em; background-color:#E8F6EF; width:76%'>
		       <b><ins>$name</ins></b><br />
		      $comment<br />
		      </div> ";   
		        echo "<form action='Assignment1.php#comments' id = 'myform' method='post'>";
		        echo "  <div style='margin:30px 300px;'>";
		        echo "<h4>"."Leave a reply..."."</h4>";
		        echo "Name: <input type='text' name='name' id='name'>"."<br />";						
			echo "Comment:"."<br />";
			echo "<textarea name='comment' id='comment'></textarea>"."<br/>";		
		        echo "<input type='hidden' name='parent' value=".$id.">";
		        echo "<input type= 'hidden' name='pageID' value = '1'>";	
			echo "<input type='submit' value='Submit' onclick = 'send_data()'>";
			echo "</div>";
			echo "</form>";
			echo "<hr style = 'background-color: #C0C0C0; border-width:0; color:#000000; height:2px; lineheight:0; display: inline-block; margin:0px 300px ; width:80%;' />";
	 	}
	    	
	    	//if comment has child, print the child comments
	    	if($comm["child"] == 1)
	    	{
	    	    foreach($comments as $child_comment)
	     	    {
	     	        print_comment($comm["id"], $child_comment, $comments);
	     	    } 
	    	}
	    	

	    }
	    else
	    {
	    	return;
	    }    
	    
	}			
?>
<!DOCTYPE html>
<html lang = "en">
		<head>
		<meta charset="UTF-8">
		<title>Portfolio</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="jquery.min.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<script>
		//gotten from http://www.w3schools.com/xml/ajax_xmlhttprequest_create.asp
		function load_iframe(str) {
		var xhttp;
	       if (window.XMLHttpRequest) {
		    // code for modern browsers
		    xhttp = new XMLHttpRequest();
		    } 
		  else {
		    // code for IE6, IE5
		    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xhttp.onreadystatechange = function() {
		    if (xhttp.readyState == 4 && xhttp.status == 200) {
		      
		      document.getElementById("myframe").innerHTML = xhttp.responseText;
		      
		    }
		  }
		  xhttp.open("GET", "iframe_ajax.php?url="+str, true);	  
		  xhttp.send();
		}
		</script>
		<script>
		function send_data(){			
			$('#myform').click(function(ev){
				ev.preventDefault();
				$.ajax({
					type: 'POST',
					url: "managed_comments.php",
					data: $('#myform').serialize(),
					success:function(data){
						$('.comment_container').append(data);
					},
					error:function(jqXHR, textStatus, errorThrown){
						alert(textStatus + ': ' + errorThrown);
					}
					
				});
			});
			window.alert("Thank you for your comment");
		}
		</script>

	<body>
	<header id="header">
				<nav id="nav">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="Assignment0.php">Assignment0</a></li>
						<li><a href="Assignment1.php">Assignment1</a></li>
						<li><a href="Assignment2.php">Assignment2</a></li>
					</ul>
				</nav>
	</header>

	<section id="main" class="wrapper">
		<div class="container">

			<header class="major">
				<h2>Assignment1.0</h2>
				<h3>Chess Game</h3>			
		<?php
		echo "Name: ".$assignment0->title."<br/>";
		echo "Date: ".$assignment0->date."<br/>";
		echo "Version: ".$assignment0->version."<br/>";
		echo "Summary: ".$assignment0->summary."<br/>";
		?>
	</header>
		</div>
	</section>
<!-- Table -->
	<section>
		<div class="container">
			<header class="major">
				<h3>Files</h3>
			</header>
		</div>
		<div class="table-wrapper">
			<table>
				<thead>
					<tr>
						<th>File Path</th>
						<th>Type</th>
						<th>Size</th>
						<th>Version</th>
					</tr>
				</thead>
				<tbody>

					
						<?php
						foreach($assignment0->fileList as $f){
							$onclick = "load_iframe('".$f->path."')";
							echo "<tr>";
							echo "<td><a href='#myframe'>".$f->path."</a></td>";
							echo "<td>".$f->type."</td>";
							echo "<td>".$f->size."</td>";
                                      						
							echo "<td>".(string)(count($f->version))."</td>";
								foreach($f->version as $ver){
									echo "<tr>";
									echo "<td colspan= 4>";
									echo "Version number: ".$ver->revision."<br/>";
									echo "Author: ".$ver->author."<br/>";
									echo "Date: ".$ver->date."<br/>";
                                                                        echo "<a href='#myframe'><button onclick=".$onclick.">View source</button></a>";
                                                                       
                                                                        echo "</td>";
									echo "</tr>";
								}
							echo "</tr>";
							
						}
						?>
			</table>
		</div>
	</section>
	<section id="main" class="wrapper">
		<div class="container">

			<header class="major">
				<h2>Assignment1.1</h2>
			
		<?php
		echo "Name: ".$assignment1->title."<br/>";
		echo "Date: ".$assignment1->date."<br/>";
		echo "Version: ".$assignment1->version."<br/>";
		echo "Summary: ".$assignment1->summary."<br/>";
		?>
	</header>
		</div>
	</section>
<!-- Table -->
	<section>
		<div class="container">
			<header class="major">
				<h3>Files</h3>
			</header>
		</div>
		<div class="table-wrapper">
			<table>
				<thead>
					<tr>
						<th>File Path</th>
						<th>Type</th>
						<th>Size</th>
						<th>Version</th>
					</tr>
				</thead>
				<tbody>

				<?php
						foreach($assignment1->fileList as $f){
							$onclick = "load_iframe('".$f->path."')";
							echo "<tr>";
							echo "<td><a href='#myframe'>".$f->path."</a></td>";
							echo "<td>".$f->type."</td>";
							echo "<td>".$f->size."</td>";
                                      						
							echo "<td>".(string)(count($f->version))."</td>";
								foreach($f->version as $ver){
									echo "<tr>";
									echo "<td colspan= 4>";
									echo "Version number: ".$ver->revision."<br/>";
									echo "Author: ".$ver->author."<br/>";
									echo "Date: ".$ver->date."<br/>";
                                                                        echo "<a href='#myframe'><button onclick=".$onclick.">View source</button></a>";
                                                                       
                                                                        echo "</td>";
									echo "</tr>";
								}
							echo "</tr>";
							
						}
						?>
			</table>
		</div>
	</section>
	<section id="main" class="wrapper">
		<div class="container">

			<header class="major">
				<h2>Assignment1.2</h2>

			
		<?php
		echo "Name: ".$assignment2->title."<br/>";
		echo "Date: ".$assignment2->date."<br/>";
		echo "Version: ".$assignment2->version."<br/>";
		echo "Summary: ".$assignment2->summary."<br/>";
		?>
	</header>
		</div>
	</section>
<!-- Table -->
	<section>
		<div class="container">
			<header class="major">
				<h3>Files</h3>
			</header>
		</div>
		<div class="table-wrapper">
			<table>
				<thead>
					<tr>
						<th>File Path</th>
						<th>Type</th>
						<th>Size</th>
						<th>Version</th>
					</tr>
				</thead>
				<tbody>

					
				<?php
						foreach($assignment2->fileList as $f){
							$onclick = "load_iframe('".$f->path."')";
							echo "<tr>";
							echo "<td><a href='#myframe'>".$f->path."</a></td>";
							echo "<td>".$f->type."</td>";
							echo "<td>".$f->size."</td>";
                                      						
							echo "<td>".(string)(count($f->version))."</td>";
								foreach($f->version as $ver){
									echo "<tr>";
									echo "<td colspan= 4>";
									echo "Version number: ".$ver->revision."<br/>";
									echo "Author: ".$ver->author."<br/>";
									echo "Date: ".$ver->date."<br/>";
                                                                        echo "<a href='#myframe'><button onclick=".$onclick.">View source</button></a>";
                                                                       
                                                                        echo "</td>";
									echo "</tr>";
								}
							echo "</tr>";
							
						}
						?>
			</table>
			<header class="major">
				<h3>Source Code</h3>
			</header>
			<div id="myframe"></div>
			 <a href="#top">Back to Top</a>;
		</div>
	</section>
		<section>
		<div class="container">
			<header class="major" id ="comments">
				<h2>Comments</h2>
			</header>
		</div>
		<?php
		  $con = mysqli_connect("127.0.0.1","wtsai9_cs242","4933575");
		  if (!$con)
		  {
		    
		    die('Could not connect: ' . mysql_error());
		  
		  }	  
		  mysqli_select_db($con, 'wtsai9_Assignment3');
		  
		  $query = "SELECT * FROM  `Comments` WHERE `pageID` = 1 LIMIT 0 , 30";
		  $comments = mysqli_query($con, $query);
		  
		  $comment_ary = array();
		  while($row = mysqli_fetch_array($comments, MYSQL_ASSOC))
		  {
			array_push($comment_ary, $row);	  

		  }
			
	     	 foreach($comment_ary as $comment)
	     	 {
	     	     
	     	     print_comment(-1, $comment, $comment_ary);
	     	    
	     	}

	?>
		  
		
	</section>
	<section id="two" class="wrapper style2 align-center">
				<div class="container">
					<h2> Leave a comment... </h2>
					<?php
					echo "<form action='Assignment1.php#comments' id = 'myform' method='post'>";
					echo "Name: <input type='text' name='name' id='name'>"."<br />";						
					echo "Comment:"."<br />";
					echo "<textarea name='comment' id='comment'></textarea>"."<br/>";		
				        echo "<input type='hidden' name='parent' value='-1'>";
				        echo "<input type= 'hidden' name='pageID' value = '1'>";	
					echo "<input type='submit' value='Submit' onclick = 'send_data()'>";
					
			echo "</form>";
					?>
				</div>
	</section>
</body>
</html>
