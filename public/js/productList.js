
let products = []; //variable para inicializar, alcamena los productos arrray 

//Este código maneja las interacciones con la API y actualiza la lista de productos en la interfaz de usuario.

//hacemos iteraccion con la interfaz usuario para agregar productos a una lista de compras, obtenemos los datos desde el servidor atravez de ajax y actualizar los productos a la vista del usuario

//asincronica enviando una solicitud ajax al servidor para que me devuelva la promesa de matrimonio con los datos del producto 
async function getProductDetails(productName) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'http://localhost/mini-master1/orderController/getProductPrice',
            type: 'POST',
            data: { product_name: productName },
            success: function(response) {
                try {
                    var data = JSON.parse(response);
                    resolve(data);
                } catch (error) {
                    reject('Error en el manejo de la respuesta JSON: ' + error.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                reject('Error en la solicitud AJAX: ' + textStatus);
            }
        });
    });
}   
// solicitar el producto los socitia con document.getElementByID las guarda en constante
async function addProduct() {
    try {
        const productNameElement = document.getElementById('product_name');

        if (!productNameElement) {
            throw new Error('Campo de entrada no encontrado');
        }

        const productName = productNameElement.value.trim();

        if (!productName) {
            alert('Por favor ingresa un nombre de producto válido.');
            return;
        }

        // Obtener los detalles del producto desde el servidor
        const productDetails = await getProductDetails(productName);

        if (!productDetails || productDetails.error) {
            throw new Error('Este producto no existe en la base de datos');
        }

        // Asegurar que el precio sea un número
        const productPrice = parseFloat(productDetails.product_price);

        // Agregar el producto a la lista de productos
        products.push({
            product_id: productDetails.product_id, // Usar el ID del servidor
            product_name: productDetails.product_name,
            product_price: productPrice,
            product_quantity: 1 // Cantidad fija de 1 por ahora
        });

        updateProductList();
        updateTotalAmount();

        // Limpiar el campo después de agregar el producto
        productNameElement.value = '';
    } catch (error) {
        alert('Error: ' + error.message);
    }
}

function removeProduct(index) {
    products.splice(index, 1);
    updateProductList();
    updateTotalAmount();
}
// actualiza los productos de la tabla hay que realizar la tabla dinamica 
function updateProductList() {
    const productList = document.getElementById('product_list');
    productList.innerHTML = '';

    products.forEach((product, index) => {
        const total = product.product_price * product.product_quantity;
        const row = `
            <tr>
                <td>${product.product_id}</td>
                <td>${product.product_name}</td>
                <td>${product.product_price.toFixed(2)}</td>
                <td>${product.product_quantity}</td>
                <td>${total.toFixed(2)}</td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeProduct(${index})">Eliminar</button></td>
                <input type="hidden" name="products[${index}][product_id]" value="${product.product_id}">
                <input type="hidden" name="products[${index}][product_quantity]" value="${product.product_quantity}">
                <input type="hidden" name="products[${index}][price]" value="${product.product_price}">
            </tr>
        `;
        productList.insertAdjacentHTML('beforeend', row);
    });
}

function updateTotalAmount() {
    const totalAmount = products.reduce((total, product) => total + (product.product_price * product.product_quantity), 0);
    document.getElementById('total_amount').value = totalAmount.toFixed(2);
}

function cancelOrder() {
    products = [];
    updateProductList();
    updateTotalAmount();
}

//esto es una validacion del formulario con un hermosmo addeventListener con condicional para evitar que se envie en 0 
// document.querySelector('form').addEventListener('submit', function(event) {
//     const totalAmountElement = document.getElementById('total_amount');
//     const totalAmount = parseFloat(totalAmountElement.value);
    
//     if (isNaN(totalAmount) || totalAmount <= 0) {
//         alert('El monto total no puede ser cero o negativo.');
//         event.preventDefault();
//     }
// });

// esto es para solicitar el valor por ajax y me lo devuelva en promesa para jeison 

function generatePDF() {
    // Obtener el ID de la venta, puedes obtenerlo de la tabla u otro método adecuado
    var saleId = '<?php echo $saleId; ?>'; // Asegúrate de que esta variable contenga el ID correcto de la venta

    // Redireccionar a generate_pdf.php con el ID de la venta
    window.location.href = 'generate_pdf.php?sale_id=' + saleId;
}