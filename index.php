<?php session_start();
	require_once("db_config.php");
	date_default_timezone_set("asia/dhaka");
	if(isset($_POST["btnLogin"])){
		$username=trim($_POST["txtUsername"]);
		$password=md5(trim($_POST["txtPassword"]));
		
		$user_table=$db->query("select id,username,password,role_id from mr_gms_user where username='$username' and password='$password' and inactive=0");

			list($id,$_username,$_password,$_role_id)=$user_table->fetch_row();
			
			if(isset($id)){

				$_SESSION["id"]=$id;
				$_SESSION["s_username"]=$_username;
				$_SESSION["s_role_id"]=$_role_id;
				$_SESSION["last_login_timestamp"]= time();

				header("location:home.php");
		}else{
			$error="<span class='error'>Incorrect user name or password</span>";
		}
	}

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome to login</title>
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body class="body">
<div class="head">
  <h1 class="title">Welcome to <span style="color:#00711D;">LOGIN</span></h1>
</div>
<!-- Form Module-->
<div style="height:70px; width:372px;">
  <form action="" method="post">
	  <input class="input" type="text" name="txtUsername" placeholder="Username" id="username" ">  
	  <input class="input" type="password" name="txtPassword" placeholder="password" id="password" >  <br>
	  <div style="margin:7px 0px;"><span><?php echo isset($error)?$error:"";?></span>
      	<div class="div-login"><input type="submit" value="Sign In" name="btnLogin" class="login"></div>
      </div>
      
  </form>
</div>
<div class="shadow"></div>

</body>
</html>
