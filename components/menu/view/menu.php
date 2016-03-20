<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/0/ASC/1">
                        List
                        <span class="sr-only">
                            (current)
                        </span>
                    </a>
                </li>
                <li>
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
                <?php if ($show_sort_buttons): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo ($sort == ASC)?'Cheaper first': 'Expensive first'; ?>
                        <span class="caret">

                        </span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/<?php echo $category?>/ASC/1">Cheaper first</a></li>
                        <li><a href="/<?php echo $category?>/DESC/1">Expensive first</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="alert alert-success navbar-fixed-bottom hidden" id="info_message"></div>
<div class="alert alert-warning navbar-fixed-bottom hidden" id="error_message"></div>
