<div class="row-fluid">
    <?php
        foreach($random_list as $k =>$value): ?>
    <div class="col-lg-4">
            <div class="jumbotron">
                <div class="row">
                    <H4><a class="product_link" shop_path="<?php echo $value[product_id]?>"><?php echo $value[product_name];?></a></H4>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <img src="/media/img/<?php echo $value[picture_file_type].'/'.$value[picture_file_name];?>" class="img-rounded" width="170" height="170">
                    </div>
                    </div>
                <div class="row">
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <p><?php echo $value[product_description]?></p>
                        </div>
                        <div class ="row">
                            <H4>Price: <span class="label label-success"><?php echo $value[product_price]?> $</span></H4>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <?php endforeach;?>
</div>
<script src="/media/vkorovay/js/product_list.js"></script>