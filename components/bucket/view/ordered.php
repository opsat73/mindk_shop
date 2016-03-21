<div class="row bucket_products">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-10">
<table class="table table-responsive">
    <thead>
    <tr>
        <th class="col-lg-5">Product name</th>
        <th class="col-lg-2">Product price</th>
        <th class="col-lg-2">Product Count</th>
        <th class="col-lg-2">Price total</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($list as $key => $value): ?>
    <tr id="row_<?php echo $value[product_id]?>">
        <td><a href="/front/product/<?php echo $value[product_id]?>"><?php echo $value[product_name]; ?></a></td>
        <td><span id="product_price_<?php echo $value[product_id]?>"><?php echo $value[product_price]; ?></span> $</td>
        <td><input type="number" min="1" class="form-control bfh-number product_count" disabled value="<?php echo $value[bucket_product_count]; ?>" name="product_count" id="product_count_<?php echo $value[product_id]?>"></td>
        <td id="summary_price_<?php echo $value[product_id]?>"><?php echo $value[summary_price]; ?> $</td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
        </div>
    <div class="col-lg-1">
    </div>

</div>
    </div>