<?php
// اتصال به پایگاه داده
$db = new PDO('mysql:host=localhost;dbname=hesabfa', 'root', '');

// دریافت ID محصول از درخواست
$id = $_GET['id'];

// دریافت اطلاعات محصول
$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// includes/header.php را در اینجا قرار دهید
include('includes/header.php');
?>

<div class="container">
    <h2>ویرایش محصول</h2>
    <form action="update_product.php" method="post">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <div class="form-group">
            <label for="name">نام محصول:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="price">قیمت:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">توضیحات:</label>
            <textarea class="form-control" id="description" name="description"><?php echo $product['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">ذخیره</button>
    </form>
</div>

<?php
// includes/footer.php را در اینجا قرار دهید
include('includes/footer.php');
?>