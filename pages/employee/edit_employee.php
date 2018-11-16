<?php
	
	//$db=new mysqli("localhost","root","","gms");
	if(isset($_POST["btnSave"])){
		$employee_id=$_POST["txtId"];
		$designation=$_POST["cmbDesignation"];
		$name=$_POST["txtName"];
		$phone=$_POST["txtPhone"];
		$email=$_POST["txtEmail"];
		$present_address=$_POST["txtAddress"];
		$permanent_address=$_POST["txtPAddress"];
		$join_date=$_POST["txtJoin"];
		
		$db->query("update mr_employee set name='$name',designation_id='$designation',phone='$phone',email='$email',present_address='$present_address',permanent_address='$permanent_address',join_date='$join_date' where id='$employee_id'");
		
		echo "Successfully Updated!";
	}
	
	if(isset($_POST["btnEdit"])){
		$id=$_POST["txtId"];
		
		$edit_employee=$db->query("select designation_id,name,phone,email,present_address,permanent_address,join_date from mr_employee where id='$id'");
		
		list($designation,$name,$phone,$email,$present_address,$parmanent_address,$join_date)=$edit_employee->fetch_row();
	}

?>

<body>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h3>Edit Person</h3>
    <div class="toolbar">
      <div class="group">
        <a class="btn btn-sm btn-outline-primary" href="home.php?page=7">Create Person</a>
        <a class="btn btn-sm btn-outline-primary" href="home.php?page=6">Person Details</a>
      </div>
    </div>
  </div>
	<form action="#" method="post" onSubmit="return confirm('Are your sure?')">
      <div class="form-group row">
        <label class="col-sm-2">ID</label>
        <div class="col-sm-3">
        <input type="text" class="form-control" id="txtId" name="txtId" value="<?php echo isset($id)?$id:""?>">
      </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Designation</label>
        <div class="col-sm-3">
        <select class="form-control" name="cmbDesignation">
            <?php
                //$db=new mysqli("localhost","root","","gms");
                $role_table=$db->query("select id,name from mr_employee_designation");
                
                while(list($id,$name)=$role_table->fetch_row()){
                    
                    echo "<option value='$id'>$name</option>";
                }
                
                
            ?>
        </select>
      </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Name</label>
         <div class="col-sm-3">
        <input type="text" class="form-control" id="txtName" name="txtName" value="<?php echo isset($name)?$name:""?>" >
      </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Phone</label>
         <div class="col-sm-3">
        <input type="text" class="form-control" id="txtPhone" name="txtPhone" value="<?php echo isset($phone)?$phone:""?>">
      </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Email</label>
         <div class="col-sm-3">
        <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo isset($email)?$email:""?>">
      </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Present Address</label>
         <div class="col-sm-3">
        <textarea type="text" class="form-control" id="txtAddress" name="txtAddress" value="<?php echo isset($present_address)?$present_address:""?>"></textarea>
      </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Parmanent Address</label>
         <div class="col-sm-3">
        <textarea type="text" class="form-control" id="txtPAddress" name="txtPAddress" value="<?php echo isset($permanent_address)?$permanent_address:""?>"></textarea>
      </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Join Date</label>
         <div class="col-sm-3">
        <input type="text" class="form-control" id="txtJoin" name="txtJoin" value="<?php echo isset($join_date)?$join_date:""?>">
      </div>
      </div>
      
      
    
    <div class="form-group row">
        <label class="col-sm-4"></label>
         <div class="col-sm-2">
      <input type="submit" class="btn btn-primary" name="btnSave" value="Update" />
      </div>
    </div>
	</form>

</body>
</html>