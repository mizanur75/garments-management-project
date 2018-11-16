<?php
	if(isset($_POST["btnSubmit"])){
		$name = $_POST["txtName"];
		$phone = $_POST["txtPhone"];
		$email = $_POST["txtEmail"];
		$address = $_POST["txtAddress"];

		$db->query("insert into mr_supplier(name,phone,email,address)values('$name','$phone','$email','$address')");
		echo "Successfull!";
	}
?>
<div class="app-title">
  <h3>Create Supplier</h3>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=14">Create Supplier</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=23">View Supplier</a>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-10">
        <form action="#" method="post">
        <div class="form-group row">
          <label class="col-sm-2">Name</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="txtName">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2">Phone</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="txtPhone">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2">Email</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="txtEmail">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2">Address</label>
          <div class="col-sm-3">
            <textarea type="text" class="form-control" name="txtAddress"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4"></label>
          <div class="col-sm-2">
        <input type="submit" class="btn btn-primary" name="btnSubmit" value="Save" />
         </div>
        </div>
      </form>
    </div>
</div>