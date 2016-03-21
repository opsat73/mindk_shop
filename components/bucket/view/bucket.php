<div class="container-fluid">
<div id="bucket_empty_info" class="row <?php echo (sizeof($list) == 0)?'':'hidden'; ?>">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="jumbotron">
        Bucket is empty
            </div>
    </div>
</div>

<div class="row bucket_products <?php echo (sizeof($list) != 0)?'':'hidden'; ?>">
    <div class="col-lg-3">
        <form id="order" method="post">
            <fieldset class="form-group required has">
                <label for="exampleInputEmail1">First name</label>
                <input data-toggle="tooltip" title="tooltip on second input!" type="text" class="form-control validate empty" id="consumer_first_name" name="consumer_first_name" placeholder="Enter first name">
            </fieldset>
            <fieldset class="form-group required">
                <label for="exampleInputEmail1">Last name</label>
                <input type="text" class="form-control has-error validate empty" id="consumer_last_name" name="consumer_last_name" placeholder="Enter last name">
            </fieldset>
            <fieldset class="form-group required">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control validate email" id="consumer_email" name="consumer_email" placeholder="Enter email">
                <small class="text-muted">After submit you get link to order on this address</small>
            </fieldset>
            <fieldset class="form-group">
                <label for="exampleInputEmail1">Telephone</label>
                <input type="text" class="form-control validate phone" id="consumer_phone" name="consumer_phone" placeholder="Enter telephone number">
            </fieldset>
            <fieldset class="form-group">
                <label for="exampleTextarea">Comment</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </fieldset>
            <fieldset class="form-group">
                <text class="text-muted"><span style="color:red">*</span> - Required fields</text>
            </fieldset>
            <span id= "send_order" class="btn btn-primary">Submit</span>
        </form>
    </div>
    <div class="col-lg-9">
<table class="table table-responsive">
    <thead>
    <tr>
        <th class="col-lg-5">Product name</th>
        <th class="col-lg-2">Product price</th>
        <th class="col-lg-2">Product Count</th>
        <th class="col-lg-2">Price total</th>
        <th class="col-lg-1"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($list as $key => $value): ?>
    <tr id="row_<?php echo $value[product_id]?>">
        <td><a href="/front/product/<?php echo $value[product_id]?>"><?php echo $value[product_name]; ?></a></td>
        <td><span id="product_price_<?php echo $value[product_id]?>"><?php echo $value[product_price]; ?></span> $</td>
        <td><input type="number" min="1" class="form-control bfh-number product_count" value="<?php echo $value[bucket_product_count]; ?>" name="product_count" id="product_count_<?php echo $value[product_id]?>"></td>
        <td id="summary_price_<?php echo $value[product_id]?>"><?php echo $value[summary_price]; ?> $</td>
        <td><button type="button" class="btn btn-danger product_delete" id="product_delete_<?php echo $value[product_id]?>">X</button></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
        </div>

<script src="/media/vkorovay/js/bucket.js"></script>
</div>
    </div>