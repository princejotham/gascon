<div class="card mb-3">
  <div class="card-header" style="background-color: #78ffae;">
    <i class="fa fa-table"></i> Items</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="items" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Category</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stock_items as $s): ?>
          <?php
          try {
            $stmt = $PDO->prepare("SELECT * FROM item WHERE id = ?;");
            $stmt->bindValue(1, $s['item_id'], PDO::PARAM_STR);
            $stmt->execute();
            $i = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $PDO->prepare("SELECT * FROM category WHERE id = ?;");
            $stmt->bindValue(1, $i['category_id'], PDO::PARAM_STR);
            $stmt->execute();
            $c = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $PDO->prepare("SELECT SUM(item_qty) AS SumQty FROM stock_item WHERE item_id = {$s['item_id']};");
            $stmt->execute();
            $stoct_qty = $stmt->fetch(PDO::FETCH_ASSOC);
          } catch(PDOException $e) {
            echo $e->getMessage();
          }
          $date_now = date("Y-m-d");
          ?>
            <tr>
              <td><?=$c['name'];?></td>
              <td><?=$i['item_name'];?></td>
              <td><?=num_format($i['buy_price']);?></td>
              <td id="SumQty<?=$s['id']?>"><?=num_format($stoct_qty['SumQty']);?></td>
              <td>

                  <input type="hidden" name="sid" id="sid<?=$s['id']?>" value="<?=$s['id'];?>">
                  <input type="hidden" name="iid" id="iid<?=$s['id']?>" value="<?=$i['id'];?>">
                  <input type="hidden" name="ip" id="ip<?=$s['id']?>" value="<?=$i['buy_price'];?>">
                  <input type="hidden" name="iname" id="iname<?=$s['id']?>" value="<?=$i['item_name'];?>">
                  <input type="hidden" name="iex" id="iex<?=$s['id']?>" value="<?=$s['item_ex'];?>">
                  <!-- <button type="submit" name="a_cart" class="btn btn-success btn-xs" style="padding:3px;"><i class="fa fa-cart-plus"></i></button> -->
                  <div class="dropdown">
                    <button class="btn btn-success btn-xs" type="button" data-toggle="dropdown" style="padding:3px;"><i class="fa fa-cart-plus"></i></button>
                    <ul class="dropdown-menu" style="padding: 10px;">
                      <li><input type="number" name="item_qty" id="item_qty<?=$s['id']?>" class="form-control form-control-sm" placeholder="Enter Qty" min="1" value="1"></li>
                      <li style="margin-top: 10px;"><button type="button" name="a_cart" id="a_cart<?=$s['id']?>" onclick="addToCart(<?=$s['id']?>)" value="1" class="btn btn-primary btn-sm btn-block">Add</button></li>
                    </ul>
                  </div>
              </td>
            </tr>

          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
</div>