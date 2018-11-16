<?php
	
	//$db=new mysqli("localhost","root","","gms");
	if(isset($_POST["btnSave"])){
		$designation=$_POST["cmbDesignation"];
		$name=$_POST["txtName"];
		$phone=$_POST["txtPhone"];
		$email=$_POST["txtEmail"];
		$present_address=$_POST["txtAddress"];
		$permanent_address=$_POST["txtPAddress"];
    $join_date=$_POST["txtJoin"];
		$hiddenname=$_POST["hiddenName"];
		
		
		$db->query("insert into mr_employee(designation_id,name,phone,email,present_address,permanent_address,join_date,qty)values('$designation','$name','$phone','$email','$present_address','$permanent_address','$join_date','$hiddenname')");
		
		echo "Successfully Added!";

	}

?>

<body>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h3>Create Person</h3>
    <div class="toolbar">
      <div class="group">
        <a class="btn btn-sm btn-outline-primary active" href="home.php?page=7">Create Person</a>
        <a class="btn btn-sm btn-outline-primary" href="home.php?page=6">Person Details</a>
      </div>
    </div>
  </div>
	<form action="#" method="post">
      <div class="form-group row">
        <label class="col-sm-2">Designation</label>
         <div class="col-sm-3">
        <select class="form-control" name="cmbDesignation">
            <?php
                $db=new mysqli("localhost","root","","gms");
                $role_table=$db->query("select id,name from mr_employee_designation");
                
                while(list($id,$name)=$role_table->fetch_row()){
                    
                    echo "<option value='$id'>$name</option>";
                }
                
                
            ?>
        </select>
         </div>
         <div class="col-sm-2">
           <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#myDesignation">
               Add New
           </button>
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Name</label>
         <div class="col-sm-3">
        	<input type="text" class="form-control" id="txtName" name="txtName">
     	 </div>
       </div>
      <div class="form-group row">
        <label class="col-sm-2">Phone</label>
         <div class="col-sm-3">
        	<input type="text" class="form-control" id="txtPhone" name="txtPhone">
         </div>
       </div>
      <div class="form-group row">
        <label class="col-sm-2">Email</label>
         <div class="col-sm-3">
        	<input type="text" class="form-control" id="txtEmail" name="txtEmail">
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Present Address</label>
         <div class="col-sm-3">
       	 <textarea type="text" class="form-control" id="txtAddress" name="txtAddress"></textarea>
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Parmanent Address</label>
         <div class="col-sm-3">
        	<textarea type="text" class="form-control" id="txtPAddress" name="txtPAddress"></textarea>
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2">Join Date</label>
         <div class="col-sm-3">
        	<input type="date" class="form-control" id="txtJoin" name="txtJoin">
         </div>
      </div>
      <input type="hidden" name="hiddenName" value="1">
      
      
    
    <div class="form-group row">
        <label class="col-sm-4"></label>
         <div class="col-sm-2">
      	<input type="submit" class="btn btn-primary" name="btnSave" value="Save" />
      </div>
     </div>
	</form>

</body>
</html>