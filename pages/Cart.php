<?php
$total_price = 0;
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { // Kiểm tra giỏ hàng có tồn tại và không rỗng
     foreach ($_SESSION['cart'] as $item) {
          $total_price += $item['gia'] * $item['soluong'];
     }
}

?>


<main id="main" class="container">
     <span class="title-frame">Giỏ Hàng Của Bạn</span>
     <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
          <!-- Kiểm tra nếu giỏ hàng không rỗng -->
          <div class="frame-prd-cart">
               <table>
                    <tr>
                         <th align="left">Sản Phẩm</th>
                         <th align="left">Đơn Giá</th>
                         <th align="left">Số Lượng</th>
                         <th align="left">Thành Tiền</th>
                         <th align="right"></th>
                    </tr>
                    <?php foreach ($_SESSION['cart'] as $item) {
                         $images = explode(',', $item['hinhanh']);
                         if (!empty($images)) {
                              $first_image = $images[0];
                              $second_image = isset($images[1]) ? $images[1] : $images[0];
                         }

                         ?>
                         <tr>
                              <td data-cell="Sản Phẩm :">

                                   <a href="index.php?action=chitietsanpham&id=<?php echo $item['id']; ?>&size=<?php echo $item['size']?>">
                                   <div class="in4-prd-cart">
                                        <div class="img-prd-cart">
                                             <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $first_image; ?>" alt="" />
                                        </div>
                                        <div style="display: flex; align-items: center;">
                                        <div class="name-prd-cart">
                                             <span><a href="" class="name-prd-link-cart"><?php echo $item['tensp']; ?></a></span><br />
                                             <?php if (isset($item['size'])) : ?>
                                                  <span>Size: <?php echo $item['size']; ?></span>
                                             <?php endif; ?>
                                        </div>
                                        </div>
                                   </div>
                                   </a>
                                   
                              </td>
                              <td data-unit-price="<?php echo $item['gia']; ?>">
                                   <?php echo number_format($item['gia']); ?>đ</td>
                              <td>
                                   <div class="up-and-downproduct">
                                        <a href="pages/addProduct.php?decrease=<?php echo $item['id']; ?>" class="quantity-decrease" data-id="<?php echo $item['id']; ?>">-</a>
                                        <span class="quantity-prd"><?php echo $item['soluong']; ?></span>
                                        <a href="pages/addProduct.php?increase=<?php echo $item['id']; ?>" class="quantity-increase" data-id="<?php echo $item['id']; ?>">+</a>
                                   </div>
                              </td>

                              <td class="sum-price-cart" data-cell="Tổng :">
                                   <span id="total" class="sum-pay-color" data-total-price="<?php echo $total_price; ?>"><?php echo number_format($item['gia'] * $item['soluong']); ?>đ</span>
                              </td>
                              <td>
                              <a href="pages/addProduct.php?xoa=<?php echo $item['id']; ?>&size=<?php echo $item['size']; ?>" class="btn-del-item-cart">Xóa</a>

                              </td>
                         </tr>
                    <?php }; ?>
               </table>
               <div class="pay-cart">
                    <span class="sum-pay">TỔNG HÓA ĐƠN: <span id="total" class="sum-pay-color"><?php echo number_format($total_price); ?>đ</span></span>
                    <a href="index.php?action=thanhtoan"> <input type="button" value="Thanh Toán" class="btn-pay-cart" /></a>
               </div>
          </div>
     <?php else : ?>
          <!-- Hiển thị thông báo khi giỏ hàng trống -->
          <h3 style="text-align:center;">Không có sản phẩm nào trong giỏ hàng!</h3>
     <?php endif; ?>
</main>