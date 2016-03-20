<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-lg-3"><?php
            echo $categories;
            ?></div>
        <div class="col-lg-9"><div class="jumbotron">
                <div class="row">
                    <H4><?php echo $product[product_name];?></H4>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <img src="/media/img/<?php echo $product[picture_file_type].'/'.$product[picture_file_name];?>" class="img-rounded" width="300" height="300">
                    </div>
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <span><?php echo $product[product_description]?></span>
                        </div>
                        <div class ="row">
                            <span>Price: <?php echo $product[product_price]?> $</span>
                        </div>
                        <div class ="row">
                            <span>Available: <?php echo $product[product_count]?> items</span>
                        </div>
                        <div class ="row">
                            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product[product_id];?>">
                            <div class="col-lg-5"><input type="number" min="1" class="form-control bfh-number" value="1" name="product_count" id="product_count"></div>
                            <div class="col-lg-1"><button type="button" class="btn btn-success" id="send">Add</button></div>
                            <div class="col-lg-6"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $random ?>
        </div>
    </div>
</div>
<script src="/media/vkorovay/js/product.js"></script>

