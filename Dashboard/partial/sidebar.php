<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="index.php"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>

            </li>
            <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="nav.templates.main">Categories</span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">
                        <?php
                        include_once "partial/DB_CONNECTION.php";
                        $query = "select * from categories";
                        $result = mysqli_query($connection, $query);
                        echo mysqli_num_rows($result);
                        ?>
                    </span></a>
                <ul class="menu-content">

                    <ul class="menu-content">
                        <li><a class="menu-item" href="add_category.php" data-i18n="nav.templates.horz.classic">Add Category</a>
                        </li>
                        <li><a class="menu-item" href="show_category.php" data-i18n="nav.templates.horz.top_icon">Show All Categories</a>
                        </li>
                    </ul>

                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="nav.templates.main">Products</span>
                    <span class="badge badge-pill badge-success float-right  mr-2">
                        <?php
                        include_once "partial/DB_CONNECTION.php";
                        $query1 = "select * from products";
                        $result1 = mysqli_query($connection, $query1);
                        echo mysqli_num_rows($result1);
                        ?>
                    </span></a>
                <ul class="menu-content">

                    <ul class="menu-content">
                        <li><a class="menu-item" href="add_product.php" data-i18n="nav.templates.horz.classic">Add New Product</a>
                        </li>
                        <li><a class="menu-item" href="show_product.php" data-i18n="nav.templates.horz.top_icon">Show All Products</a>
                        </li>
                    </ul>

                </ul>
            </li>

    </div>
</div>