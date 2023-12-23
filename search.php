<?php
require_once __DIR__."/autoload/autoload.php";

// Kiểm tra xem người dùng đã submit form tìm kiếm chưa
if (isset($_REQUEST['btnsearch'])) {
    // Lấy giá trị từ ô tìm kiếm và xử lý tránh SQL injection
    $search = addcslashes($_REQUEST['search'], " \t\n\r\0\x0B");

    // Kiểm tra xem ô tìm kiếm có rỗng hay không
    if (empty($search)) {
        echo "Yêu cầu nhập dữ liệu vào ô trống";
    } else {
        // Sử dụng câu truy vấn LIKE để tìm kiếm sản phẩm theo tên
        $query = "SELECT * FROM product WHERE name LIKE '%{$search}%'";
        
        // Thực hiện câu truy vấn
        $arr_result = $db->fetchsql($query);

        // Hiển thị kết quả tìm kiếm
        if ($arr_result) {
            // Nếu có dữ liệu trả về
            foreach ($arr_result as $row) {
                // Hiển thị sản phẩm tìm kiếm
                // (Bạn có thể thay đổi phần hiển thị sản phẩm ở đây)
                echo '<div class="col-md-3 col-xs-12 item-product">';
                echo '    <div class="item-product-custom border bor">';
                echo '        <a href="product-detail.php?id=' . $row['id'] . '">';
                echo '            <img src="' . uploads() . '/product/' . $row['thumbar'] . '" class="" width="100%" height="180">';
                echo '        </a>';
                echo '        <div class="info-item">';
                echo '            <h1 class="info-product-item">';
                echo '                <a href="product-detail.php?id=' . $row['id'] . '">' . $row['name'] . '</a>';
                echo '            </h1>';

                if ($row['sale'] > 0) {
                    echo '            <p><strike class="sale">' . formatPrice($row['price']) . '</strike><br>';
                    echo '               <b class="price">' . formatpricesale($row['price'], $row['sale']) . '</b></p>';
                } else {
                    echo '            <p><b style="color: #ea3a3c;">' . formatPrice($row['price']) . '</b></p>';
                }

                echo '        </div>';
                echo '        <div class="hidenitem">';
                echo '            <p><a href="product-detail.php?id=' . $row['id'] . '"><i class="fa fa-search"></i></a></p>';
                echo '            <p><a href=""><i class="fa fa-heart"></i></a></p>';
                echo '            <p><a href="addcart.php?id=' . $row['id'] . '"><i class="fa fa-shopping-basket"></i></a></p>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
        } else {
            // Hiển thị thông báo nếu không có kết quả tìm kiếm
            echo 'Không tìm thấy sản phẩm nào.';
        }
    }
}
?>

<?php require_once __DIR__."/layouts/header.php"; ?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <div class="product-show">
            <div class="product-title">
                <h2>
                    <a href="#">
                        Tìm kiếm sản phẩm
                    </a>
                </h2>
                <div class="title_hr_office">
                    <div class="title_hr_icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="product-search showitem">
                <!-- Kết quả tìm kiếm sẽ được hiển thị ở đây -->
            </div>
        </div>
    </section>
</div>
<?php require_once __DIR__."/layouts/footer.php"; ?>
