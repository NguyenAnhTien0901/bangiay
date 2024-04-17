

<div class="container" style="width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
     <h2>Danh Sách Sản Phẩm</h2>
     <table style="margin-left: -10px; text-align: center;">
          <tr>
               <th>ID Sản Phẩm</th>
               <th>Tên Sản Phẩm</th>
               <th>Kích cỡ</th>
               <th>Giá</th>
               <th>Hình Ảnh</th>
               <th>Tồn Kho</th>
               <th>ID Danh Mục</th>
               <th>Mô Tả</th>
               <th></th>
               <th></th>
          </tr>
          <?php
          // Truy vấn dữ liệu từ bảng sanpham
          $sql = "SELECT * FROM sanpham";
          $result = mysqli_query($conn, $sql);


          // Hiển thị dữ liệu trong một bảng
          if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                    $gia_co_dau = number_format($row["gia"], 0, ',', '.');
                    $images = explode(',', $row['hinhanh']);
                    if (!empty($images)) {
                         $first_image = $images[0];
                         $second_image = isset($images[1]) ? $images[1] : $images[0];
                       }
                    echo "<tr>";
                    echo "<td>" . $row["sanpham_id"] . "</td>";
                    echo "<td>" . $row["tensanpham"] . "</td>";
                    echo "<td>";
                    echo "<select name='size'>";
                    $sizes = explode(',', $row['size']);
                    foreach ($sizes as $size) {
                         echo "<option value='$size'>$size</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "<td>" . $gia_co_dau . "</td>";
                    // echo "<td><img src='" . $first_image . "' alt='Product Image' class='product-image'></td>";

                    echo "<td><img src='Dashboard/layout/quanlysanpham/uploads/" . $first_image . "' alt='Product Image' class='product-image'></td>";
                    echo "<td>" . $row["tonkho"] . "</td>";
                    echo "<td>" . $row["danhmuc_id"] . "</td>";
                    echo "<td style='max-width: 500px; word-wrap: break-word;overflow-wrap: break-word;' >" . $row["mota"] . "</td>";
                    echo "<td><a href='?action=sanpham&query=sua&id=" . $row["sanpham_id"] . "' style='background-color: var(--orange);
                    color: white;
                    padding: 5px 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;' >Sửa</a></td>";
                    echo "<td><a href='Dashboard/layout/quanlysanpham/xoa.php?id=" . $row["sanpham_id"] . "' style='background-color: var(--red);
                    color: white;
                    padding: 5px 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;' >Xóa</a></td>";
                    echo "</tr>";
               }
          } else {
               echo "<tr><td colspan='9'>Không có sản phẩm nào.</td></tr>";
          }
          ?>
     </table>
</div>