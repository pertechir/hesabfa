<?php
// اتصال به پایگاه داده
$db = new PDO('mysql:host=localhost;dbname=hesabfa', 'root', '');

// دریافت لیست محصولات
$stmt = $db->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// includes/header.php را در اینجا قرار دهید
include('includes/header.php');
?>

<div class="container">
    <h2>فهرست محصولات</h2>
    <a href="add_product.php" class="btn btn-success">افزودن محصول جدید</a>

    <table class="table">
        <thead>
            <tr>
                <th>نام محصول</th>
                <th>قیمت</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-warning">ویرایش</a>
                        <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// includes/footer.php را در اینجا قرار دهید
include('includes/footer.php');
?>