<!doctype html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include "partial/header.php";
?>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php include "partial/nav.php" ?>
    <?php include "partial/sidebar.php" ?>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic form layout section start -->
                <div id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="content-body">
                                            <section id="dom">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">All Products </h4>
                                                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                                                <div class="heading-elements">
                                                                    <ul class="list-inline mb-0">
                                                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                                        <li><a data-action="close"><i class="ft-x"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="card-content collapse show">
                                                                    <div class="card-body card-dashboard">
                                                                        <table style="width: 100%" class="table display nowrap table-striped table-bordered scroll-horizontal ">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Product ID</th>
                                                                                    <th>Name</th>

                                                                                    <th>Details</th>
                                                                                    <th>Status</th>
                                                                                    <th>First Price</th>
                                                                                    <th>Price</th>
                                                                                    <th>Category</th>
                                                                                    <th>Image</th>
                                                                                    <th>qyt</th>
                                                                                    <th>Actions</th>


                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                include_once "partial/DB_CONNECTION.php";
                                                                                $limit = 3;
                                                                                $page = $_GET['page1'] ?? 1;
                                                                                $offset = ($page - 1) * $limit;
                                                                                $query = "select * from products limit $limit offset $offset";

                                                                                $result = mysqli_query($connection, $query);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                                                        if ($row['status'] == 1) {
                                                                                            $status = "<span class='badge badge-success'>Active</span>";
                                                                                        } else {
                                                                                            $status = "<span class='badge badge-danger'>Block</span>";
                                                                                        }
                                                                                        echo "<tr>" .
                                                                                            "<td>" . $row['id'] . "</td>" .
                                                                                            "<td>" . $row['name'] . "</td>" .
                                                                                            "<td>" . $row['details'] . "</td>" .
                                                                                            "<td>" . $status . "</td>" .
                                                                                            "<td>" . $row['first_price'] . "</td>" .
                                                                                            "<td>" . $row['price'] . "</td>";
                                                                                        $query1 = "SELECT * FROM categories where id=" . $row['category_id'];
                                                                                        $result1 = mysqli_query($connection, $query1);
                                                                                        $category_row = mysqli_fetch_assoc($result1);
                                                                                        echo "<td>" . $category_row['name'] . "</td>";

                                                                                        $query2 = "SELECT * FROM product_file where product_id=" . $row['id'];
                                                                                        $result2 = mysqli_query($connection, $query2);
                                                                                        echo "<td>";
                                                                                        while ($product_file_row = mysqli_fetch_assoc($result2)) {
                                                                                            echo "<img src='uploads/images/" . $product_file_row['image'] . "' width='100px' height='100px'/>";
                                                                                        }
                                                                                        echo "</td> <td>" . $row['name'] . "</td>";

                                                                                        echo "<td>
                                                                                            <a href='update_product.php?id=" . $row['id'] . "' 
                                                                                            class='btn btn-outline-primary  box-shadow-3 mr-1 mb-1'>
                                                                                            <i class='icon-eye'></i></a>
                                                                                            

                                                                                            <a href='delete_product.php?id=" . $row['id'] . "' 
                                                                                            class='btn btn-danger delete_product'
                                                                                               id='delete-btn'>
                                                                                               DELETE
                                                                                            </a>
                                                                                            
                                                                                            
                                                                                               </td>"
                                                                                            . "</tr>";
                                                                                    }
                                                                                }

                                                                                ?>

                                                                            </tbody>
                                                                        </table>
                                                                        <div class="justify-content-center d-flex">
                                                                        </div>
                                                                        <div class="col-12">

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="justify-content-center d-flex">


                    <div class="row">


                        <div class="col-md-12">
                            <?php
                            $query = "SELECT count(id) as row_no from products";
                            $result = mysqli_query($connection, $query);
                            $row = mysqli_fetch_assoc($result);
                            $page_count = ceil($row['row_no'] / $limit);
                            echo "<ul class='pagination'>";
                            for ($i = 1; $i <= $page_count; $i++) {
                                echo "<li class='page-item'><a class='page-link' href='show_product.php?page1=$i'>$i</a></li>";
                            }


                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>
    <?php
    include "partial/footer.php";
    ?>
</body>

</html>