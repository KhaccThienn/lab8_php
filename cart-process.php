<?php

session_start(); // khởi động session
include 'connection/connect.php';
// lấy các tham số trên url
$id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
$action = !empty($_GET['action']) ? $_GET['action'] : 'add';
$quantity = !empty($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

// truy vấn dữ liệu book theo id
$query = mysqli_query($conn, "SELECT * FROM book WHERE id = $id");
$book = mysqli_fetch_assoc($query); // Duyệt dữ liệu về dạng mảng

/**
 * thực hiện lưu thông tin book vào session
 * nếu có $book && $action == 'add'
 */
if ($book && $action == 'add') {
  /**
   * kiểm tra sự tồn tại của book trong giỏ hàng
   * nếu book đó có rồi thì chỉ cần tăng số lượng lên
   */
  if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantity'] += $quantity;
  } else {
    /**
     * Nếu book chưa tồn tại trong giỏ hàng thì lưu vào session
     * Tạo thông tin của sản phẩm trong session giỏ hàng
     */
    $cart = [
      'id' => $book['id'],
      'name' => $book['name'],
      'image' => $book['image'],
      'price' => $book['price'],
      'quantity' => $quantity
    ];
    // tạo session key là cart để lưu book
    $_SESSION['cart'][$id] = $cart;
  }
}

if ($action == 'delete') {
  if (isset($_SESSION['cart'][$id])) {
    // xóa phần tử book ra khỏi mảng $_SESSION['cart']
    unset($_SESSION['cart'][$id]);
  }
}

if ($action == 'update') {
  $quantity = $quantity >= 1 ? $quantity : 1; // validate dữ liệu cho quantity
  if (isset($_SESSION['cart'][$id])) { // Kiểm tra sản phẩm đã có trong giỏ hang chua
    $_SESSION['cart'][$id]['quantity'] = $quantity; // Cập nhật lại số luơng
  }
}


header('location: viewcart.php');
exit;
// in mảng $_SESSION['cart'] để xem thử
// echo '
// <pre>';
// print_r($_SESSION['cart']);