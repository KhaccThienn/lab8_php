<?php
session_start();
$carts = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <a href="book.php" class="btn btn-outline-dark">Return to Book page</a>
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">THÔNG TIN GIỎ HÀNG</div>
      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th>STT</th>
            <th>ẢNH</th>
            <th>TÊN SẢN PHẨM</th>
            <th>GIÁ</th>
            <th>SỐ LƯỢNG</th>
            <th>THÀNH TIỀN</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $n = 1;
          foreach ($carts as $item) :
            $thanh_tien = $item['price'] * $item['quantity'];
          ?>
            <?php if (!$carts) { ?>
              <p>No Data Returned</p>
            <?php } else { ?>
              <tr>
                <td><?php echo $n; ?></td>
                <td>
                  <img src="<?php echo $item['image']; ?>" width="60">
                </td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo number_format($item['price']); ?> đ</td>
                <td>
                  <form action="cart-process.php">
                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                    <input type="hidden" name="action" value="update">
                    <input type="number" name="quantity" value="<?= $item['quantity']; ?>" style="width:60px">
                    <input type="submit" value="Cập nhật" class="btn btn-xs btn-success">
                  </form>
                </td>

                <td><?php echo number_format($thanh_tien); ?> đ</td>
                <td>
                  <a href="cart-process.php?id=<?php echo $item['id'] ?>&action=delete" class="btn btn-xs btn-danger">Xóa</a>
                </td>
              </tr>
            <?php } ?>
          <?php $n++;
          endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>