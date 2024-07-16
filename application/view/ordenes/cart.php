<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Create Order</h4>
            </div>
            <div class="card-body">
                <form action="<?php echo URL; ?>orderController/createOrder" method="post">
                    <div class="form-group">
                        <label for="product_name">Name price:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name">
                    </div>
                  
                    <button type="button" class="btn btn-primary mb-3" onclick="addProduct()">Add product</button>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID product</th>
                                <th>Name Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="product_list"></tbody>
                    </table>

                    <div class="form-group">
                        <label for="total_amount">Mount Total:</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Finish Sell</button>
                    <button type="button" class="btn btn-danger" onclick="cancelOrder()">Cancel Sell</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
