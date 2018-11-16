<?php
	if(isset($_POST["btnSubmit"])){
		$code=$_POST["txtCode"];
		$basic=$_POST["txtBasic"];
		$house=$_POST["txtHouse"];
		$health=$_POST["txtHealth"];
		
		$salary_table
	}
?>




<form action="" method="post">
    <div class="form-group">
        <label>Employee Code</label>
        <input class="form-control form-control-sm" type="text" name="txtCode" >
    </div>
    <div class="form-group">
        <label>Basic</label>
        <input class="form-control form-control-sm" type="text" name="txtBasic" >
    </div>
    <div class="form-group">
        <label>House Rent</label>
        <input class="form-control form-control-sm" type="text" name="txtHouse" >
    </div>
    <div class="form-group">
        <label>Health</label>
        <input class="form-control form-control-sm" type="text" name="txtHealth" >
    </div>
    <input type="submit" class="btn btn-primary" name="btnSubmit" value="Save" />

     
</form>