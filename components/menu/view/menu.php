<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?php echo ($current_location=='list')?'active':''?>">
                    <a href="/">
                        List
                        <span class="sr-only">
                            (current)
                        </span>
                    </a>
                </li>
                <li class="<?php echo ($current_location=='bucket')?'active':''?>">
                    <a href="/bucket">
                        Bucket
                    </a>
                </li>
                <li class="total_price_menu <?php echo (isset($count))?'':'hidden';?>">
                    <p class="navbar-text item_count"><?php echo $count; ?> items</p>
                </li>
                <li class="total_price_menu <?php echo (isset($count))?'':'hidden';?>">
                    <p class="navbar-text total_price"><?php echo $total_price; ?> $</p>
                </li>
                <?php if ($current_location=='list'): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle menu_bar_sort_drop_down" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo 'Cheaper first'; ?>
                        <span class="caret">

                        </span></a>
                    <ul class="dropdown-menu">
                        <li><a class = "menu_bar_sort" shop_path="ASC">Cheaper first</a></li>
                        <li><a class = "menu_bar_sort" shop_path="DESC">Expensive first</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="alert alert-success navbar-fixed-bottom hidden" id="info_message"></div>
<div class="alert alert-warning navbar-fixed-bottom hidden" id="error_message"></div>
<script src="/media/vkorovay/js/menu.js"></script>
