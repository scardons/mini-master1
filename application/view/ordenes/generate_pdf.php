<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-header { margin-bottom: 20px; }
        .invoice-header h1 { font-size: 24px; }
        .invoice-details { margin-bottom: 10px; }
        .invoice-details p { margin: 5px 0; }
        .invoice-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .invoice-table th, .invoice-table td { border: 1px solid #ddd; padding: 8px; }
        .invoice-table th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>Invoice</h1>
    </div>
    <div class="invoice-details">
        <p><strong>ID Sale:</strong> <?= $sale_id ?></p>
        <p><strong>User:</strong> <?= $username ?></p>
        <p><strong>Sale Date:</strong> <?= $sale_date ?></p>
        <p><strong>Total Amount:</strong> <?= $total_amount ?></p>
    </div>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['name'] ?></td>
                <td><?= $product['quantity'] ?></td>
                <td><?= $product['price'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
