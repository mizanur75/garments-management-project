<?php
	
	//require_once("../db_config.php");
	if(isset($_POST["save"])){
		
		$role_id=$_POST["cmbRole"];
		$username=$_POST["txtUsername"];
		$password=md5(trim($_POST["txtPassword"]));
		$repassword=md5(trim($_POST["txtRePassword"]));
		//$user_id=$_SESSION["s_id"];
    $added_on=date("Y-m-d H:i:s");
    $hiddenName=$_POST["hiddenName"];
		
		
		if($password==$repassword){
			$db->query("insert into mr_gms_user(username,password,role_id,added_on,inactive,qty)values('$username','$password','$role_id','$added_on',0,'$hiddenName')");
			echo "Successfully Added!";
		}else{
			echo "Password Doesn't match!!!";
		}
	}

?>


<body>
  <div class="app-title">
    <h3>Create User</h3>
    <div class="toolbar">
      <div class="group">
        <a class="btn btn-sm btn-outline-primary active" href="home.php?page=1">Create User</a>
        <a class="btn btn-sm btn-outline-primary" href="home.php?page=3">User Details</a>
      </div>
    </div>
  </div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
	<form action="home.php?page=1" method="post">
      <div class="form-group row justify-content-center">
        <label class="col-md-2">Role</label>
        <div class="col-md-3">
        <select class="form-control" name="cmbRole">
            <?php
                $db=new mysqli("localhost","root","","gms");
                $role_table=$db->query("select id,name from mr_gms_role");
                
                while(list($id,$name)=$role_table->fetch_row()){
                    
                    echo "<option value='$id'>$name</option>";
                }
                
                
            ?>
        </select>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label class="col-md-2">Username</label>
        <div class="col-md-3">
        <input type="text" class="form-control" id="txtUsername"  placeholder="Enter Username" name="txtUsername">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label class="col-md-2">Password</label>
        <div class="col-md-3">
        <input type="password" class="form-control"  placeholder="Enter Password" name="txtPassword">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label class="col-md-2">Re-Enter Password</label>
        <div class="col-md-3">
        <input type="password" class="form-control"  placeholder="Re-Enter Password" name="txtRePassword">
        </div>
      </div>
      <input type="hidden" name="hiddenName" value="1">
    
      <div class="form-group row justify-content-center">
        <label class="col-md-2"></label>
        <div class="col-md-3" align="right">
      	<input type="submit" class="btn btn-primary" name="save" value="Save" />
        </div>
      </div>
	</form>
</div>
</div>
</div>
</div>

</body>
