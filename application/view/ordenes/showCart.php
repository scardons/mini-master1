<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Sales</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Users Sales</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Sale</th>
                            <th>Users</th>
                            <th>Sales Date</th>
                            <th>Price Sell</th>
                            <th>Products</th>
                            <th>Action</th> <!-- Nuevo encabezado para el botón PDF -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $currentSaleId = null;
                        foreach ($sales as $sale): 
                            if ($currentSaleId != $sale['sale_id']) {
                                if ($currentSaleId !== null) {
                                    // Cerrar la fila anterior si hay una venta diferente
                                    echo '<td><button type="button" class="btn btn-primary" onclick="generatePDF(' . $currentSaleId . ')">Generate PDF</button></td></tr>';
                                }
                                // Abrir nueva fila para la venta actual
                                echo '<tr>';
                                echo '<td>' . $sale['sale_id'] . '</td>';
                                echo '<td>' . $sale['username'] . '</td>';
                                echo '<td>' . $sale['sale_date'] . '</td>';
                                echo '<td>' . $sale['total_amount'] . '</td>';
                                echo '<td>';
                                echo $sale['product_name'] . ' (' . $sale['product_quantity'] . ' x $' . $sale['product_price'] . ')<br>';
                                $currentSaleId = $sale['sale_id'];
                            } else {
                                // Si es el mismo ID de venta, solo agregar productos
                                echo $sale['product_name'] . ' (' . $sale['product_quantity'] . ' x $' . $sale['product_price'] . ')<br>';
                            }
                        endforeach; 
                        if ($currentSaleId !== null) {
                            // Cerrar la última fila si hay ventas pendientes
                            echo '<td><button type="button" class="btn btn-primary" onclick="generatePDF(' . $currentSaleId . ')">Generate PDF</button></td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</html>
