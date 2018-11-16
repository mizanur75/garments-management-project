<div class="app-title">
  <h3>User Details</h3>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=1">Create User</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=3">User Details</a>
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-12">
  <div class="tile">
    <div class="tile-body">
      <table class="table table-hover table-bordered table-sm" id="userTable">
      	<thead class="bg-primary" style="color: white;">
      	<tr>
			<th>ID</th>
			<th>Userame</th>
			<th>Role</th>
			<th>Added On</th>
			<th>Status</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>

<?php
	if (isset($_POST["btnDelete"])) {
		$id = $_POST["txtId"];
		$db->query("delete from mr_gms_user where id='$id'");

		echo "Successfully Deleted!";
	}
	$user_table=$db->query("select gu.id,gu.username,gr.name,gu.added_on,gu.inactive from mr_gms_user gu,mr_gms_role gr where gr.id=gu.role_id"); 
	while(list($id,$username,$role_id,$added_on,$inactive)=$user_table->fetch_row()){
	
		$status=$inactive==0?"<ul class='book'><li></li></ul>":"Inactive";
		
		echo "<tr>
				<td>$id</td>
				<td>$username</td>
				<td>$role_id</td>
				<td>$added_on</td>
				<td>$status</td>
				<td class='text-center'><form action='home.php?page=4' method='post' style='display:inline'>
						<input type='hidden' name='txtId' value='$id' />
						<button type='submit' name='btnEdit' class='btn btn-info btn-sm'><i class='fa fa-edit'></i></button>
					</form>
					<form action='home.php?page=3' method='post' onsubmit='return confirm(\"Are you sure?\")' style='display:inline'>
						<input type='hidden' name='txtId' value='$id' />
						<button type='submit' name='btnDelete' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>
					</form>
				</td>
			  </tr>";
		
	}
?>
</table>
</div>
</div>
</div>
</div>

<script type="text/javascript">
	$(function(){
		$('#userTable').DataTable()
	});
</script>
