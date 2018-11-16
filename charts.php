<div class="app-title">
  <h3>Summary of All Module</h3>
</div>
<div class="row">
  <div class="col-sm-6">
    <h6><b>Wear House</b></h6>
    <div class="tile">
      <div class="tile-body">
      <table class="table table-hover table-bordered table-sm" id="wearhouse">
        <thead class="bg-primary" style="color: white;">
          <tr>
            <th>SL.</th>
            <th>Name</th>
            <th>Type</th>
            <th>Qty</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sn=1;
            function get_rowmaterials_qty($item_id){
              global $db;
              $production_details_table=$db->query("select sum(qty) from mr_production_details where item_id='$item_id'");
              list($qty)=$production_details_table->fetch_row();
              return $qty;
            }
            function add_materials($item_id){
              global $db;
              $purchase_details_table=$db->query("select sum(qty) from mr_purchase_delivery where item_id='$item_id'");
              list($qty)=$purchase_details_table->fetch_row();
              return $qty;
            }

            $stock=$db->query("select p.id,p.name,pt.name, sum(p.qty) from mr_product p,mr_product_type pt where pt.id=p.type_id and p.category_id=1 group by p.id");
            $status="In Stock";
            while (list($item_id,$name,$type,$qty)=$stock->fetch_row()) {
              echo "<tr>
                      <td>".$sn++."</td>
                      <td>$name</td>
                      <td>$type</td>
                      <td>".(($qty+add_materials($item_id))-get_rowmaterials_qty($item_id))."</td>
                      <td>$status</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  <div class="col-sm-6">
    <h6><b>Production</b></h6>
    <div class="tile">
      <div class="tile-body">
      <table class="table table-hover table-bordered table-sm" id="production">
        <thead class="bg-primary" style="color: white;">
          <tr>
            <th>SL.</th>
            <th>ID</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once("functions.php");
          $sn=1;
          $status="Proccessing";
          
          $production_table=$db->query("select id,item_id, sum(qty) from mr_production_master group by item_id");
          while (list($id,$item_id,$qty)=$production_table->fetch_row()) {
            echo "<tr>
            <td>".$sn++."</td>
            <td>$id</td>
            <td>".get_item_name($item_id)."</td>
            <td>".($qty-get_production_delivery_qty($item_id))."</td>
            <td>$status</td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-sm-6">
    <h6><b>Inventory</b></h6>
    <div class="tile">
      <div class="tile-body">
      <table class="table table-hover table-bordered table-sm" id="inventory">
        <thead class="bg-primary" style="color: white;">
          <tr>
            <th>SL.</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once("functions.php");
            $sn=1;
            $product_table=$db->query("select p.id,p.name,t.name, sum(p.qty),p.unit_price from mr_product p,mr_product_type t where t.id=p.type_id and t.id=3 group by p.name limit 5");
            while (list($item_id,$name,$type,$qty,$price)=$product_table->fetch_row()) {
               echo "<tr>
                     <td>".$sn++."</td>
                     <td>$name</td>
                     <td>".(($qty+get_production_delivery_qty($item_id))-get_sales_qty_by_item_id($item_id))."</td>
                     <td>$price</td>
                     <td>".(($qty+get_production_delivery_qty($item_id))-get_sales_qty_by_item_id($item_id))*$price."</td>
                     </tr>";
            }
            
          ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  <div class="col-sm-6">
    <h6><b>Sales</b></h6>
    <div class="tile">
      <div class="tile-body">
      <table class="table table-hover table-bordered table-sm" id="sales">
        <thead class="bg-primary" style="color: white;">
          <tr>
            <th>SL</th>
            <th>Peoduct</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          function get_sales_qty_by_item_id($item_id){
            global $db;
            $sale_table=$db->query("select sum(qty) from mr_order_delivery  where item_id='$item_id'");
            list($qty)=$sale_table->fetch_row();
            return $qty;
          }
            $sn=1;
            $order_delivery_table=$db->query("select p.name, sum(od.qty),od.unit_price from mr_product p,mr_product_type pt,mr_order_delivery od where pt.id=p.type_id and p.id=od.item_id group by p.id");
            $status="Delivered";
            while (list($name,$qty,$price)=$order_delivery_table->fetch_row()) {
              echo "<tr>
                      <td>".$sn++."</td>
                      <td>$name</td>
                      <td>$qty</td>
                      <td>$price</td>
                      <td>".$qty*$price."</td>
                      <td>$status</td>
                    </tr>";
            }
          ?>  
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<hr>
<div class="row">
  <div class="col-sm-6">
    <h6><b>Employee</b></h6>
    <div class="tile">
      <div class="tile-body">
      <table class="table table-hover table-bordered table-sm" id="employee">
        <thead class="bg-primary" style="color: white;">
          <tr>
            <th>SL</th>
            <th>Designation</th>
            <th>Number</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sn=1;
            $employee_table=$db->query("select e.id,d.name, sum(e.qty) from mr_employee e,mr_employee_designation d where d.id=e.designation_id group by d.id limit 5");
            while (list($id,$name,$qty)=$employee_table->fetch_row()) {
              echo "<tr>
                      <td>".$sn++."</td>
                      <td>$name</td>
                      <td>$qty</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  <div class="col-sm-6">
    <h6><b>Users</b></h6>
    <div class="tile">
      <div class="tile-body">
      <table class="table table-hover table-bordered table-sm">
        <thead class="bg-primary" style="color: white;">
          <tr>
            <th>SL.</th>
            <th>Role</th>
            <th>Number</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sn=1;
            $user_table=$db->query("select u.id,r.name, sum(u.qty) from mr_gms_user u,mr_gms_role r where r.id=u.role_id group by r.id limit 5");
            while (list($id,$name,$qty)=$user_table->fetch_row()) {
              echo "<tr>
                      <td>".$sn++."</td>
                      <td>$name</td>
                      <td>$qty</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  $(function(){
    $('#wearhouse').DataTable();
  });
</script>
<script type="text/javascript">
  $(function(){
    $('#production').DataTable();
  });
</script>
<script type="text/javascript">
  $(function(){
    $('#inventory').DataTable();
  });
</script>
<script type="text/javascript">
  $(function(){
    $('#sales').DataTable();
  });
</script>
<script type="text/javascript">
  $(function(){
    $('#employee').DataTable();
  });
</script>