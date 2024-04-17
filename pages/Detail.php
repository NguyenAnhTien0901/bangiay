<?php
if(isset($_GET['id']))
{ 

  $idsp = $_GET['id'];
  $sql = "SELECT * FROM sanpham where sanpham_id = '" . $idsp . "'";
  $result = mysqli_query($conn, $sql);
  
  if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
    $images = explode(',', $product['hinhanh']);
    $sizes = explode(',', $product['size']);
    $a = $sizes[0];
    
    if (!empty($images)) {
      $first_image = $images[0];
      $second_image = isset($images[1]) ? $images[1] : $images[0];
    }
    $danhmuc_id = $product['danhmuc_id'];
    $sql_danhmuc = "SELECT tendanhmuc FROM danhmuc WHERE danhmuc_id = $danhmuc_id";
    $result_danhmuc = mysqli_query($conn, $sql_danhmuc);
    $row_danhmuc = mysqli_fetch_assoc($result_danhmuc);
    $tendanhmuc = $row_danhmuc['tendanhmuc'];

    
      ?>


    <main id="main" class="container">
      <div class="container-details">
        <div class="detail">

          <div class="all-detail">
            <div class="slide-img-detail">
              <div class="gallery">
                <div class="gallery-inner">
                  <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $first_image ?>" alt="" />
                </div>

                <!-- <div class="control prev">
                  <i class="fa-solid fa-arrow-left"></i>
                </div>
                <div class="control next">
                  <i class="fa-solid fa-arrow-right"></i>
                </div> -->
                
              </div>

              <div>
                <div class="list">
                  <?php foreach ($images as $image) {
                  ?>
                    <div>
                      <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $image ?>" alt="" />
                    </div>
                  <?php } ?>
                </div>
              </div>

            </div>

            <div class="detail-product">
              <div class="detail-brand"><?php echo $tendanhmuc ?></div>

              <h4 class="detail-name">
                <?php echo $product['tensanpham'] ?>
              </h4>

              <div class="detail-price"><?php echo number_format($product['gia'], 0, ',', '.') . ' VNĐ'; ?>
              </div>

              <div class="title-size"> SIZE</div>
              <ul class="size">
                <?php foreach ($sizes as $size) { 
                  $ref = '';
                  if(isset($_GET['size'])) {
                      if($_GET['size'] == $size)
                      {
                        $ref = 'selected';
                      }
                      else{
                        $ref = '';
                      }
                  }?>
                  
                  <li>
                  <a  href="index.php?action=chitietsanpham&id=<?php echo $product['sanpham_id']; ?>&size=<?php echo $size; ?>" data-size="<?php echo $size; ?>" style="color: <?php echo $ref ?>;" class="<?php echo $ref ?>" >
                          <?php echo $size; ?>
                      </a>
                  </li>
                <?php } ?>
              </ul>



              <!-- <form action="" method="post" class="size" id="sizeForm">
    <?php 
    $first = true; // Biến để theo dõi label đầu tiên
    foreach ($sizes as $size) { 
        $checked = $first ? 'checked' : ''; // Kiểm tra nếu là label đầu tiên
    ?>
        <input type="radio" name="size" value="<?php echo $size; ?>" id="<?php echo $size; ?>" style="display: none;" <?php echo $checked; ?>>
        <label for="<?php echo $size; ?>" onclick="selectSize('<?php echo $size; ?>')"><?php echo $size; ?></label>
    <?php 
        $first = false; // Đã qua label đầu tiên, đặt biến $first thành false
    } 
    ?>
    <button type="submit" >Submit</button>
</form> -->


              <div class="parameter-detail">
                <div class="para">Code: <b>VIBES-<?php echo $product['sanpham_id']?></b></div>
                <div class="para">Tình trạng: <b><?php echo $product["tonkho"] >=1 ? 'Còn hàng' : 'Đã hết hàng' ?></b></div>
                <div class="para">Hãng sản xuất: <b><?php echo $tendanhmuc ?></b></div>
                <div class="para">Xuất xứ thương hiệu: <b>Hàng xách tay</b></div>
                <!-- <div class="para">Chủng loại: <b>Giày</b></div> -->
              </div>

              <div class="detail-ship">
                <div class="detail-icon">
                  <img src="./images/img-icon/icon_service_product_1.svg" alt="">
                  <p>Giao hàng toàn quốc (Hỗ trợ ship COD nhận hàng thanh toán)
                  <p>
                </div>
                <div class="detail-icon">
                  <img src="./images/img-icon/icon_service_product_2.svg" alt="">
                  <p>Nhận ngay QUÀ TẶNG và VOUCHER giảm giá cho lần mua hàng tiếp theo
                  <p>
                </div>
                <div class="detail-icon">
                  <img src="./images/img-icon/icon_service_product_3.svg" alt="">
                  <p>
                    Hỗ trợ đổi size và đổi mẫu trong vòng 5 ngày
                  <p>
                </div>
                <div class="detail-icon">
                  <img src="./images/img-icon/icon_service_product_4.svg" alt="">
                  <p>Cam kết hàng chính hãng 100%
                  <p>
                </div>
              </div>

              <div class="detail-like">
                <i class="fa-regular fa-heart"></i>
                <p>Yêu thích</p>
              </div>

              <div style="margin-top: 10px;">
                <p>Số lượng sản phầm: <?php echo $product["tonkho"] ?></p>
              </div>

              <div class="detail-pay">
                <a href="pages/addProduct.php?idsp=<?php echo $product['sanpham_id'] ?>&size=<?php  echo $_GET['size'] ?>&them" class="detail-add-pay">Thêm vào giỏ hàng</a>
                 <a href="pages/addProduct.php?idsp=<?php echo $product['sanpham_id'] ?>&size=<?php  echo $_GET['size'] ?>&muangay" class="detail-buy">Mua Ngay</a href="">
                 <!-- <a href="index.php?action=chitietsanpham&id=<?php echo $_GET['id']?>" id="submitBtn" class="detail-buy">Mua Ngay</a href=""> -->
              </div>

              <div class="detail-contact">
                <div class="zalo">Liên hệ Zalo</div>
                <div class="faebook">Liên hệ Fanpage Facebook</div>
                <div class="insta">Liên hệ Instagam</div>
              </div>

            </div>
          </div>
        </div>
      </div>


      <!-- sanpham lien quan -->
      <div class="product-hot " >
          <div class="title-hot"><h1>Sản phẩm liên quan</h1></div>
          <div class="content-products">
               <?php
               $products_per_page = 5;
               $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
               $start_index = ($current_page - 1) * $products_per_page;

               $sql = "SELECT * FROM sanpham WHERE danhmuc_id = $danhmuc_id and sanpham_id != $idsp LIMIT $start_index, $products_per_page";

               $result = mysqli_query($conn, $sql);

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
                              <a href="index.php?action=chitietsanpham&id=<?php echo $product['sanpham_id']; ?>&size=<?php echo $first_size?>">

                                   <!-- <div class="discount"> -20% </div> -->
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
               } 
              ?>
          </div>
      </div>

     <!-- phan trang -->
     <div class="pagination">
    <?php
        $sql_count = "SELECT COUNT(*) AS total FROM sanpham WHERE danhmuc_id = $danhmuc_id";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count);
        $total_pages = ceil($row_count['total'] / $products_per_page);
                
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='index.php?action=chitietsanpham&id=$idsp&size=$first_size&page=$i'>$i</a>";
        }
    ?>
    </div>



    </main>
<?php }
} }?>

<?php
?>

<script>
  function handle(e)
{
    e.preventDefault()
}


</script>

