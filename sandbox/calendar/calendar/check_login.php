<?
function login($try="")
{
	GLOBAL	$root,$_SERVER;
    $action=$_SERVER["PHP_SELF"];

    echo<<<EOT
<html>
<head>
<meta http-equiv="Content-Type" content="text/html">
</head>
<body bgcolor="#FFFFCC" text="#000000" background="images/bg.jpg" leftmargin="6" topmargin="0">
EOT;

    if (!empty($try))
         echo<<<EOT
    <br>
    <font color="red"><center>Sorry, you entered the wrong password, please try again</center></font>
EOT;

    echo<<<EOT
<br><br>
<center>
This area only for admins!!!<br>
Please enter Password
</center>
<br><br>
<form action="$action" method="post" name="loginForm">
<table align="center">
<tr>
<td>Password</td>
<td><input type="password" name="p" size=9></td>
</tr>
</table>
<center><input type="submit" value="Enter"></center>
</form>
</body>
</html>
EOT;
};

    session_register("access");
    if (!empty($HTTP_POST_VARS[p]))
		{
			//Только подлогинился
        require_once("pswd.php");
	  	if ($HTTP_POST_VARS[p]!=$pswd)
            {
                login(1);
                exit;
            }
			else
				$access="ok";
		}
			else
		{
			if ($access!='ok')
				{
				 login();
                        exit;
				}
		}
?>