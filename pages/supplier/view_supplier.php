<div class="app-title">
  <h3>Supplier Details</h3>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=14">Create Supplier</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=23">View Supplier</a>
    </div>
  </div>
</div>
<div style="margin-bottom: 10px; height: 450px;">
<?php
	if(isset($_POST["btnDelete"])){
		$id=$_POST["txtId"];
		$db->query("delete from mr_supplier where id='$id'");
	}

	$perpage = 10;
	$pg=(isset($_GET["pg"])) ? (int)$_GET["pg"]:1;
	$start_at= $perpage * ($pg - 1);

	$rows = $db->query("select count(*) from mr_supplier");
	list($total)=$rows->fetch_row();
	$totalPages = ceil($total / $perpage);
	
	$supplier_table=$db->query("select id,name,phone,email,address from mr_supplier limit $start_at,$perpage");

	echo "<table class='table table-striped table-sm'>";
	echo "<tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Address</th><th>Action</th></tr>";

	while (list($id,$name,$phone,$email,$address)=$supplier_table->fetch_row()) {
		echo "<tr>
		<td>$id</td>
		<td>$name</td>
		<td>$phone</td>
		<td>$email</td>
		<td>$address</td>
		<td>
			<form action='home.php?page=24' method='post' style='display:inline'>
				<input type='hidden' name='txtId' value='$id' />
				<input type='submit' name='btnEdit' class='material-icons' value='edit' />
			</form>
			<form action='home.php?page=23' method='post' onsubmit='return confirm(\"Are you sure?\")'  style='display:inline'>
				<input type='hidden' name='txtId' value='$id' />
				<input type='submit' name='btnDelete' class='material-icons' style='color:red;' value='delete' />
			</form>
		</td>
		</tr>";
	}
	echo "</table>";
?>
</div>
<div>
	<?php
	echo pagination($pg,$totalPages,23);
	?>
</div>