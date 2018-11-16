<?php 
	$db = new mysqli("localhost","root","","gms");
	if(isset($_POST["customerLogin"])){
		$name = $_POST["txtName"];
		$address = $_POST["txtAddress"];
		$phone = $_POST["txtPhone"];
		$email = $_POST["txtEmail"];

		$db->query("insert into mr_customer(name,address,phone,email)values('$name','$address','$phone','$email')");
		echo "successfull!";
	}
?>
<body>
  <div class="app-title">
    <h3>Create Buyer</h3>
    <div class="toolbar">
      <div class="group">
        <a class="btn btn-sm btn-outline-primary active" href="home.php?page=15">Create Buyer</a>
        <a class="btn btn-sm btn-outline-primary" href="home.php?page=27">Buyer Details</a>
      </div>
    </div>
  </div>
	<form action="#" method="post">

      <div class="form-group row">
        <label class="col-sm-2">Name</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" id="txtName" name="txtName">
        </div>
      </div>
	  <div class="form-group row">
        <label class="col-sm-2">Address</label>
        <div class="col-sm-3">
        <textarea type="text" class="form-control" id="txtAddress" name="txtAddress"></textarea>
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
        <label class="col-sm-4"></label>
        <div class="col-sm-2">
      <input type="submit" class="btn btn-primary" name="customerLogin" value="Save" />
      </div>
      </div>
	</form>

</body>