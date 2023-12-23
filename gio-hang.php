<?php
require_once __DIR__."/autoload/autoload.php";
//_debug($_SESSION['cart']);

$sum = 0;

if ( !isset($_SESSION['cart']) | count($_SESSION['cart']) == 0)
{
    echo "<script>alert('Không có sản phẩm trong giỏ hàng');location.href='index.php'</script>";
}

?>

<?php require_once __DIR__."/layouts/header.php"; ?>
<div class="col-md-9 bor">

    <section class="box-main1">
        <div class="product-title">
            <h2>
                <a href="#">
                    Giỏ hàng của bạn
                </a>
            </h2>
            <div class="title_hr_office">
                <div class="title_hr_icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="notification-text">
            <?php if (isset($_SESSION['success'])) :?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
        </div>
        <!--End.notification-text-->

        <div class="order-cart">
            <table class="table table-hover table-bordered" id="shoppingcart_info">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; foreach ($_SESSION['cart'] as $key => $value):  ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td>
                                <img src="<?php echo uploads() ?>product/<?php echo $value['thumbar'] ?>" width="80px" height="80px" />
                            </td>
                            <td>
                                <input type="number" name="qty" value="<?php echo $value['qty'] ?>" class="form-control qty"  min="0"/>
                            </td>
                            <td><?php echo formatPrice($value['price']) ?></td>
                            <td><?php echo formatPrice($value['price'] * $value['qty']) ?></td>
                            <td>
                                <ul class="order-cart-list">
                                    <li>
                                        <a href="remove.php?key=<?php echo $key ?>" class="btn btn-danger" title="Xóa">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="btn btn-success updatecart" data-key=<?php echo $key ?> title="Cập nhật">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>

                        <?php
                            $sum += $value['price'] * $value['qty'];
                            $_SESSION['tongtien'] = $sum;
                        ?>
                    <?php $stt++; endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="orderCart-info">
            <div class="row">
                <div class="col-xs-12 col-md-5 pull-right">
                    <div class="order-content list-group">
                        <ul>
                            <li class="list-group-item">
                                <h3>Thông tin đơn hàng</h3>
                            </li>
                            <li class="list-group-item">
                                <span class="badge"><?php echo formatPrice($_SESSION['tongtien']) ?></span>
                                Số tiền
                            </li>
                            <li class="list-group-item">
                                <span class="badge">10 %</span>
                                Thuế VAT
                            </li>
                            <li class="list-group-item">
                                <span class="badge">
                                    <?php
                                    $_SESSION['total'] = $_SESSION['tongtien'] * 110/100;
                                    echo formatPrice($_SESSION['total']);
                                    ?>
                                </span>
                                Tổng tiền thanh toán
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url() ?>" class="btn btn-danger">Tiếp tục mua hàng</a>
                                <a style="float: right" href="thanh-toan.php" class="btn btn-success">Thanh toán</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nội dung -->
    </section>
</div>
<?php require_once __DIR__."/layouts/footer.php"; ?>


