<?php
if($_SESSION['usertype'] == 0)
{
	echo"<a href='studentScreen.php'>> Home Screen</a>
	<a href='logout.php'>> Logout</a>";
}

if($_SESSION['usertype'] == 1)
{
	echo"<a href='adminScreen.php'>> Admin Screen</a>
	<a href='studentScreen.php'>> Student Screen</a>
	<a href='logout.php'>> Logout</a>";
}
?>