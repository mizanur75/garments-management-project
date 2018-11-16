<div class="app-title">
  <h3>Person Details</h3>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=7">Create Person</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=6">Person Details</a>
    </div>
  </div>
</div>

<div class="row">
<div class="col-md-12">
  <div class="tile">
    <div class="tile-body">
      <table class="table table-hover table-bordered table-sm" id="view_employee">
      	<thead class="bg-primary" style="color: white;">
      		<tr>
				<th>ID</th>
				<th>Designation</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Present_Address</th>
				<th>Parmanent_Address</th>
				<th>Join_Date</th>
				<th>Action</th>
			</tr>
		</thead>
<?php

	$employee_table=$db->query("select e.id,ed.name,e.name,e.phone,e.email,e.present_address,e.permanent_address,e.join_date from mr_employee e,mr_employee_designation ed where ed.id=e.designation_id");
	while(list($id,$designation,$name,$phone,$email,$present_address,$parmanent_address,$join_date)=$employee_table->fetch_row()){
	
		
		
		echo "<tr>
				<td>$id</td>
				<td>$designation</td>
				<td>$name</td>
				<td>$phone</td>
				<td>$email</td>
				<td>$present_address</td>
				<td>$parmanent_address</td>
				<td>$join_date</td>
				<td>
					<form action='home.php?page=9' method='post' style='display:inline'>
						<input type='hidden' name='txtId' value='$id' />
						<button type='submit' name='btnEdit' class='btn btn-info btn-sm'><i class='fa fa-edit'></i></button>
					</form>
					<form action='home.php?page=8' method='post' onsubmit='return confirm(\"Are you sure?\")' style='display:inline'>
						<input type='hidden' name='txtId' value='$id' />
						<button type='submit' name='btnDelete' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>
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
		$('#view_employee').DataTable();
	});
</script>
