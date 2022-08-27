
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/template.css">
	</head>
<body>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}

function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</body>
</html>

<?php
	echo '<div class="navbar">';
	
	echo' <div id="mySidebar" class="sidebar">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>';
				
		$accessLevel = $_COOKIE['accessLevel'];
		if(isset($accessLevel) AND $accessLevel==99)
		{
		echo '<a href="insertincharge.php">
				Create New Event
				</a>';
		echo '<br /><br />';
		
		echo '<a href="insertfaculty.php">
				Create new Faculty
				</a>';
		echo '<br /><br />';
		
		echo '<a href="createuser.php">
				Create User
				</a>';
		echo '<br /><br />';
		
		echo '<a href="editlogin.php">
				Edit login details
				</a>';
		echo '<br /><br />';
		
		echo '<a href="editfaculty.php">
				Edit faculty details
				</a>';
		echo '<br /><br />';
		
		echo '<a href="displayevent.php">
				View Event Details
				</a>';
		//echo '<br /><br />';
		
		echo '<a href="report.php">
				Generate report
				</a>';
		echo '<br /><br />';
		
		echo '<a href="deleteevent.php">
				Delete Event
				</a>';
		echo '<br /><br />';
		
		echo '<a href="index.php?status=logout">
				Logout&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				</a>';
		echo '<br /><br />';
		}
		
		if(isset($accessLevel) AND $accessLevel==25)
		{
		echo '<a href="insertevent.php">
				Add Event Details
				</a>';
		echo '<br /><br />';
		
		echo '<a href="editevent.php">
				Edit Event Details
				</a>';
		echo '<br /><br />';
		
		echo '<a href="displayevent.php">
				View Event Details
				</a>';
		echo '<br /><br />';
		
		echo '<a href="index.php?status=logout">
				Logout&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				</a>';
		echo '<br /><br />';
		}
		
		if(isset($accessLevel) AND $accessLevel==78)
		{
		echo '<a href="insertincharge.php">
				Create New Event
				</a>';
		echo '<br /><br />';
		
		echo '<a href="displayforHOD.php">
				View Events
				</a>';
		echo '<br /><br />';
		
		echo '<a href="index.php?status=logout">
				Logout&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				</a>';
		echo '<br /><br />';
		}
		
		echo' </div>
		<div id="main">
			<button class="openbtn" onclick="openNav()">☰</button>
			<a href="index.php">Home</a>
		</div>

		</div>';
		
		


	echo '</div>';
	
?>