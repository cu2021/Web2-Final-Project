<?php
include 'partial/DB_connection.php';
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $details = $_POST['details'];
    $first_price = $_POST['first_price'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $category_id = $_POST['category_id'];

    isset($_POST['active']) ? $active = $_POST['active'] : $active = 0;

    if (empty($_POST["name"])) {
        $errors['name'] = "Name is required";
    }
    if (empty($_POST["details"])) {
        $errors['details'] = "details is required";
    }
    if (empty($_POST["first_price"])) {
        $errors['first_price'] = "first_price is required";
    }
    if (empty($_POST["price"])) {
        $errors['price'] = "price is required";
    }
    if (empty($_POST["qty"])) {
        $errors['qty'] = "qty is required";
    }
    if (empty($_FILES['image']['name'])) {
        $errors['image'] = "Image is required";
    }

    if (!count($errors) > 0) {
        $date = date('Y-m-d h:i:s');





        $query = "INSERT INTO products (name,details,status,created_at,first_price,price,category_id,qty)
        VALUES('$name','$details','$active','$date','$first_price','$price','$category_id','$qty')";
        $result = mysqli_query($connection, $query);
        $last_query_id = mysqli_insert_id($connection);
        if ($result) {
            $success = true;
            $file_count = count($_FILES['image']['name']);
            for ($i = 0; $i < $file_count; $i++) {
                $file_name = $_FILES['image']['name'][$i];
                $file_size = $_FILES['image']['size'][$i];
                $file_type = $_FILES['image']['type'][$i];
                $file_tmp_name = $_FILES['image']['tmp_name'][$i];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $file_new_name = time() . rand(1, 100000) . "." . $file_ext;

                $upload_path = 'uploads/images/' . $file_new_name;
                move_uploaded_file($file_tmp_name, $upload_path);
                $query1 = "INSERT INTO product_file (product_id,image)
                VALUES('$last_query_id','$file_new_name')";
                $result1 = mysqli_query($connection, $query1);
                if ($result1) {
                    $success = true;
                }
            }
        } else {
            $errors['General Error'] = $connection->error;
        }
    }
}
?>

<html>
<?php
include "partial/header.php";
?>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <?php
    include "partial/nav.php";
    include "partial/sidebar.php";
    ?>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Main </a>
                                </li>
                                <li class="breadcrumb-item"><a href="">
                                        Products</a>
                                </li>
                                <li class="breadcrumb-item active">Add Product
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"></h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <?php
                                            if (!empty($errors['general_error'])) {
                                                echo "<div class='alert alert-danger'>" . $errors['general_error'] . "</div>";
                                            } elseif ($success) {
                                                echo "<div class='alert alert-success'>Product Added Successfully</div>";
                                            }


                                            ?>
                                            <form class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                                                <div class="form-body">
                                                    <h4 class="form-section"><i class="ft-home"></i>Add Product
                                                    </h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name"> Name </label>
                                                                <input type="text" id="name_ar" class="form-control" placeholder="Enter Name Of Product" name="name">
                                                                <span class="text-danger errors">
                                                                    <?php
                                                                    if (isset($errors['name'])) {
                                                                        print_r($errors['name']);
                                                                    }

                                                                    ?>

                                                                </span>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name"> Details </label>
                                                                <input type="text" id="details" class="form-control" placeholder="Enter details Of Product" name="details">
                                                                <span class="text-danger errors">
                                                                    <?php
                                                                    if (isset($errors['details'])) {
                                                                        print_r($errors['details']);
                                                                    }

                                                                    ?>

                                                                </span>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name"> first_price </label>
                                                                <input type="number" id="first_price" class="form-control" placeholder="first_price of Product" name="first_price">
                                                                <span class="text-danger errors">
                                                                    <?php
                                                                    if (isset($errors['first_price'])) {
                                                                        print_r($errors['first_price']);
                                                                    }
                                                                    ?>

                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name"> Price </label>
                                                                <input type="number" id="price" class="form-control" placeholder="price of Product" name="price">
                                                                <span class="text-danger errors">
                                                                    <?php
                                                                    if (isset($errors['price'])) {
                                                                        print_r($errors['price']);
                                                                    }
                                                                    ?>

                                                                </span>
                                                            </div>
                                                        </div>


                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name"> Quantity </label>
                                                                <input type="number" id="qty" class="form-control" placeholder="qty of Product" name="qty">
                                                                <span class="text-danger errors">
                                                                    <?php
                                                                    if (isset($errors['qty'])) {
                                                                        print_r($errors['qty']);
                                                                    }
                                                                    ?>

                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name"> Category </label>
                                                                <select class="form-control" name="category_id">
                                                                    <?php
                                                                    include 'DB_CONNECTION.php';
                                                                    $query = "SELECT * from categories";
                                                                    $result = mysqli_query($connection, $query);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                                                    }


                                                                    ?>
                                                                </select>

                                                                <span class="text-danger errors">
                                                                    <?php
                                                                    if (isset($errors['category_id'])) {
                                                                        print_r($errors['category_id']);
                                                                    }
                                                                    ?>

                                                                </span>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name"> Image </label>
                                                                <input type="file" multiple class="form-control" name="image[]">
                                                                <span class="text-danger errors">
                                                                    <?php
                                                                    if (isset($errors['image'])) {
                                                                        print_r($errors['image']);
                                                                    }
                                                                    ?>

                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-1 col-lg-3">
                                                            <input type="checkbox" value="1" name="active" id="switcheryColor4" class="switchery" data-color="success" checked />
                                                            <label for="switcheryColor4" class="card-title ml-2  mr-2">الحالة
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <section id="chkbox-radio">
                                                    <div class="row">

                                                    </div>

                                                </section>


                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                        <i class="ft-x"></i> Back
                                                    </button>
                                                    <button type="submit" id="btn_create_product" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
    <?php
    include "partial/footer.php";
    ?>
</body>

</html>