<?php
if (isset($_POST['keyword'])) {
     $keyWord = $_POST['keyword'];
} else {
     $keyWord = '';
}

if (isset($_POST['Categories'])) {
     $categoryId = $_POST['Categories'];
} else {
     $categoryId = '';
}

$sql = "SELECT * FROM sanpham WHERE tensanpham LIKE '%" . $keyWord . "%'";


// Nếu có danh mục được chọn, thêm điều kiện lọc theo danh mục vào câu truy vấn SQL
if (!empty($categoryId)) {
     $sql .= " AND danhmuc_id = " . $categoryId;
}
$result = mysqli_query($conn, $sql);
$new = mysqli_fetch_assoc($result);

?>
<div id="main" class="container">
<div class="product-hot">
     <div class="title-hot"><h1>Sản Phẩm Tìm Thấy</h1></div>
     <div class="content-products">
          <?php
          if ($result->num_rows > 0) {
               while ($product = $result->fetch_assoc()) {
                    $images = explode(',', $product['hinhanh']);
                    $sizes = explode(',', $product['size']);
                    $first_size = $sizes[0];
                    if (!empty($images)) {
                         $first_image = $images[0];
                         $second_image = isset($images[1]) ? $images[1] : $images[0];
                    }
          ?>

                    <div class="product" onmouseover="changeImage('admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $second_image; ?>', '<?php echo $product['sanpham_id']; ?>')" onmouseout="changeImage('admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $first_image; ?>', '<?php echo $product['sanpham_id']; ?>')" data-id="<?php echo $product['sanpham_id']; ?>">
                         <a href="index.php?action=chitietsanpham&id=<?php echo $product['sanpham_id']; ?>&size=<?php echo $first_size ?>">

                              <div class="discount"> -20% </div>
                              <div class="product-image">
                                   <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $first_image; ?>" alt="">
                                   <!-- <a href="pages/addProduct.php?idsp=<?php echo $product['sanpham_id'] ?>" class="cart-popup" name="addProduct"><i class='bx bx-cart-add'></i></a> -->
                              </div>
                              <span class="heart-product" onclick="changeFavorites(this,<?php echo $product['sanpham_id']; ?>)" data-id="<?php echo $product['sanpham_id']; ?> "><i class='bx bxs-heart'></i></span>
                              <p class=" product-title"><?php echo $product['tensanpham'] ?></p>
                              <p class="product-price"><?php echo number_format($product['gia'], 0, ',', '.') . ' VNĐ'; ?>
                              </p>
                         </a>
                    </div>
          <?php
               }
          } ?>
     </div>
</div>

</div>