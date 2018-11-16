<?php
  if (isset($_POST["btnCategory"])) {
    $name = $_POST["txtName"];

    $db->query("insert into mr_product_category(name)values('$name')");
    echo "Successfull!";
  }
?>
<div class="modal fade" id="myCategory">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form action="#" method="post">
          <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="txtName" required>
                </div>
              </div> 
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-sm btn-success" name="btnCategory" value="Add">
          </div>
        </form>
      </div>
    </div>
</div>