<?php
	if(isset($_POST["btnUpdate"])){
		$user_id=$_POST["txtId"];
		$role_id=$_POST["cmbRole"];
		$username=$_POST["txtUsername"];
		$password=md5(trim($_POST["txtPassword"]));
		$repassword=md5(trim($_POST["txtRePassword"]));
		echo "$user_id";
		if($password==$repassword){
			$db->query("update  mr_gms_user set username='$username',role_id='$role_id' where id='$user_id'");
			echo "Successfully Updated!";
		}else{
			echo "Password Doesn't match!!!";
		}
	}
	
	
	if(isset($_POST["btnEdit"])){
			$id=$_POST["txtId"];
			
			$gms_user=$db->query("select username,password,role_id,inactive from mr_gms_user where id='$id'");
			list($username,$password,$role_id,$inactive)=$gms_user->fetch_row();
	}

?>

<div class="app-title">
  <h3>Edit User</h3>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=1">Create User</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=3">User Details</a>
    </div>
  </div>
</div>
	<form action="#" method="post" >
      <div class="form-group row">
        <label class="col-md-2">ID</label>
        <div class="col-md-3">
        <input type="text" name="txtId" class="form-control" value="<?php echo isset($id)?$id:""?>">
        </div>
       </div>
      <div class="form-group row">
        <label class="col-md-2">Role</label>
        <div class="col-md-3">
        <select class="form-control" name="cmbRole">
            <?php
                $role_table=$db->query("select id,name from mr_gms_role");
                
                while(list($id,$name)=$role_table->fetch_row()){
                    
                    echo "<option value='$id'>$name</option>";
                }
                
                
            ?>
        </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2">Username</label>
        <div class="col-md-3">
        <input type="text" class="form-control"  value="<?php echo isset($username)?$username:"";?>" name="txtUsername">
      </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2">Password</label>
        <div class="col-md-3">
        <input type="password" class="form-control"  placeholder="Enter Password" name="txtPassword">
      </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2">Re-Enter Password</label>
        <div class="col-md-3">
        <input type="password" class="form-control"  placeholder="Re-Enter Password" name="txtRePassword">
      </div>
      </div>
      
    
      <div class="form-group row">
        <label class="col-md-2"></label>
        <div class="col-md-3">
      	<input type="submit" align="right" class="btn btn-primary" name="btnUpdate" value="Update" />
       </div>
      </div>
	</form>

