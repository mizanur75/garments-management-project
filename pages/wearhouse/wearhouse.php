<div class="app-title">
  <h3>Wear House</h3>
</div>
<div class="row">
  <div class="col-sm-12">
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
</div>


<script type="text/javascript">
  $(function(){
    $('#wearhouse').DataTable();
  });
</script>