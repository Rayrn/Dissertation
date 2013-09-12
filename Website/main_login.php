<!DOCTYPE html>
<html>
<head>
	<title>Admin Interface</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<h2>Member Login </h2>
<form name="form1" method="post" action="checklogin.php">
<td>
<table width="300" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="myusername" type="text" id="myusername"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="mypassword" type="text" id="mypassword"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input id="proceed" class="active" type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>

</body>
</html>