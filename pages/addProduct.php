<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['size'])) {
    $get_size = $_GET['size'];
}


// them san pham
if (isset($_GET['idsp']) && isset($_GET['muangay'])) {
    $id = $_GET['idsp'];
    $soluong = 1;
    $sql = "SELECT * FROM sanpham WHERE sanpham_id = '$id' ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {
          $images = explode(',', $row['hinhanh']);
          if (!empty($images)) {
               $first_image = $images[0];
             }
        $new_product = array(
            'id' => $id,
            'hinhanh' => $first_image,
            'tensp' => $row['tensanpham'],
            'size' => $get_size,
            'soluong' => $soluong,
            'gia' => $row['gia'],
        );

        $found = false;
        foreach ($_SESSION['cart'] as &$cart_item) 
        {
            if ($cart_item['id'] == $id && $cart_item['size'] == $get_size) {
                $cart_item['soluong'] += $soluong;
                $found = true;
                break;
            }
        }
          if(!$found) {
              // Nếu sản phẩm không có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
              $_SESSION['cart'][] = $new_product;
          }
    }
    echo "<script>window.location.href = '../index.php?action=thanhtoan';</script>";
}
elseif (isset($_GET['idsp']) && isset($_GET['them'])) {
     $id = $_GET['idsp'];
     $soluong = 1;
     $sql = "SELECT * FROM sanpham WHERE sanpham_id = '$id' ";
     $query = mysqli_query($conn, $sql);
     $row = mysqli_fetch_array($query);
     if ($row) {
         $new_product = array(
             'id' => $id,
             'hinhanh' => $row['hinhanh'],
             'tensp' => $row['tensanpham'],
             'size' => $get_size,
             'soluong' => $soluong,
             'gia' => $row['gia'],
         );
 
         $found = false;
         foreach ($_SESSION['cart'] as &$cart_item) 
         {
             if ($cart_item['id'] == $id && $cart_item['size'] == $get_size) {
                 $cart_item['soluong'] += $soluong;
                 $found = true;
                 break;
             }
         }
           if(!$found) {
               // Nếu sản phẩm không có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
               $_SESSION['cart'][] = $new_product;
           }
     }
     echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng');</script>";
     echo "<script>window.history.back();</script>";
 }







// xoa san pham
if (isset($_SESSION['cart']) && isset($_GET['xoa']) && isset($_GET['size'])) {
     $id_to_delete = $_GET['xoa'];
     $size_to_delete = $_GET['size'];

     // Duyệt qua mảng giỏ hàng
     foreach ($_SESSION['cart'] as $key => &$cart_item) {
          // Kiểm tra xem id và size của sản phẩm có trùng với id và size cần xóa không
          if ($cart_item['id'] == $id_to_delete && $cart_item['size'] == $size_to_delete) {
               // Xóa sản phẩm khỏi giỏ hàng
               unset($_SESSION['cart'][$key]);
               // Sau khi xóa, bạn có thể thêm các xử lý khác nếu cần
          }
     }

     // Cập nhật lại session giỏ hàng sau khi xóa
     $_SESSION['cart'] = array_values($_SESSION['cart']);

     // Chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác tùy thuộc vào yêu cầu của bạn
     header("Location: ../index.php?action=giohang");
     exit(); // Đảm bảo dừng kịch bản sau khi chuyển hướng
}



//tang so luong san pham


if (isset($_GET['increase'])) {
     $id_to_delete = $_GET['increase'];

     // Duyệt qua mảng giỏ hàng
     foreach ($_SESSION['cart'] as $key => &$cart_item) {
          // Kiểm tra xem id của sản phẩm có trùng với id cần xóa không
          if ($cart_item['id'] == $id_to_delete) {
               // Xóa 1 sản phẩm khỏi giỏ hàng
               $cart_item['soluong']++;
               $cart_itemp['gia'] = $cart_itemp['gia'] * $cart_item['soluong']; 
               if ($cart_item['soluong'] <= 0) {
                    unset($_SESSION['cart'][$key]);
               }
               break; // Sau khi giảm số lượng, thoát khỏi vòng lặps
          }
     }
     // Cập nhật lại session giỏ hàng sau khi giảm số lượng
     $_SESSION['cart'] = array_values($_SESSION['cart']);

     // Chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác tùy thuộc vào yêu cầu của bạn
     // echo "<script>window.history.back();</script>";
     // exit(); // Đảm bảo dừng kịch bản sau khi chuyển hướng

     header("Location: ../index.php?action=giohang");
     exit();
}
//giam so luong san pham

if (isset($_GET['decrease'])) {
     $id_to_delete = $_GET['decrease'];

     // Duyệt qua mảng giỏ hàng
     foreach ($_SESSION['cart'] as $key => &$cart_item) {
          // Kiểm tra xem id của sản phẩm có trùng với id cần xóa không
          if ($cart_item['id'] == $id_to_delete) {
               // Xóa 1 sản phẩm khỏi giỏ hàng
               $cart_item['soluong']--;
               if ($cart_item['soluong'] <= 0) {
                    unset($_SESSION['cart'][$key]);
               }
               break; // Sau khi giảm số lượng, thoát khỏi vòng lặp
          }
     }
     // Cập nhật lại session giỏ hàng sau khi giảm số lượng
     $_SESSION['cart'] = array_values($_SESSION['cart']);

     // Chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác tùy thuộc vào yêu cầu của bạn
     echo "<script>window.history.back();</script>";
     exit(); // Đảm bảo dừng kịch bản sau khi chuyển hướng
}

?>
