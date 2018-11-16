<?php
	if(isset($_POST["btnUpdate"])){
		$id = $_POST["txtId"];
		$name = $_POST["txtName"];
		$phone = $_POST["txtPhone"];
		$email = $_POST["txtEmail"];
		$address = $_POST["txtAddress"];

		$db->query("update mr_customer set name='$name',phone='$phone',email='$email',address='$address' where id='$id'");
		$success="<b style='background-color:lightgreen;'>Successfuly Updated!</b>";
	}

	if (isset($_POST["btnEdit"])) {
		$id = $_POST["txtId"];
		$Customer_table=$db->query("select id,name,phone,email,address from mr_customer where id='$id'");
		list($id,$name,$phone,$email,$address)=$Customer_table->fetch_row();
	}
?>
<body>
 	<div class="app-title">
 	  <h3>Edit Customer</h3><?php echo isset($success)?$success:"";?>
 	  <div class="toolbar">
 	    <div class="group">
 	      <a class="btn btn-sm btn-outline-primary" href="home.php?page=15">Create Customer</a>
 	      <a class="btn btn-sm btn-outline-primary" href="home.php?page=27">Customer Details</a>
 	    </div>
 	  </div>
 	</div>
	<form action="#" method="post">
		
        <div class="form-group row">
        <label class="col-sm-2">ID</label>
	        <div class="col-sm-3">
	        	<input type="text" class="form-control" name="txtId" value="<?php echo isset($id)?$id:'';?>">
	      	</div>
        </div>
	    <div class="form-group row">
        <label class="col-sm-2">Name</label>
	        <div class="col-sm-3">
	        	<input type="text" class="form-control" name="txtName"  value="<?php echo isset($name)?$name:'';?>">
	      	</div>
        </div>
	  
        <div class="form-group row">
        <label class="col-sm-2">Phone</label>
	        <div class="col-sm-3">
	        	<input type="text" class="form-control" id="txtPhone" name="txtPhone" value="<?php echo isset($phone)?$phone:'';?>">
	        </div>
        </div>
        <div class="form-group row">
        <label class="col-sm-2">Email</label>
	        <div class="col-sm-3">
	        	<input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo isset($email)?$email:'';?>">
	      	</div>
        </div>

  	    <div class="form-group row">
          <label class="col-sm-2">Address</label>
          <div class="col-sm-3">
          	<textarea type="text" class="form-control" id="txtAddress" name="txtAddress" value="<?php echo isset($address)?$address:'';?>"></textarea>
          </div>
        </div>
      
      <div class="form-group row">
        <label class="col-sm-4"></label>
        <div class="col-sm-2">
      <input type="submit" class="btn btn-sm btn-primary" name="btnUpdate" value="Update" />
      </div>
      </div>
	</form>

</body>