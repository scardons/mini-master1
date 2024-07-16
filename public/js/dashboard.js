$(document).ready(function() {
    // Verifica si el elemento #total_sales está presente en el DOM
    if (document.getElementById('total_sales')) {
        // Obtener el total de ventas del día
        $.ajax({
            url: 'http://localhost/mini-master1/orderController/getTotalSalesOfDay',
            type: 'GET',
            success: function(response) {
                try {
                    console.log('Total Sales of the Day Response:', response);
                    var data = JSON.parse(response);
                    var totalSalesAmountElement = document.getElementById('total_sales');

                    if (totalSalesAmountElement) {
                        totalSalesAmountElement.textContent = parseFloat(data.total_sales).toFixed(2);
                    } else {
                        console.error('El elemento #total_sales no se encontró en el DOM.');
                    }
                } catch (error) {
                    console.error('Error en el manejo de la respuesta JSON: ' + error.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX: ' + textStatus);
            }
        });

        // Obtener las ventas de los últimos 5 días y crear el gráfico
        $.ajax({
            url: 'http://localhost/mini-master1/orderController/getTotalSalesOfLastFiveDays',
            type: 'GET',
            success: function(response) {
                try {
                    console.log('Sales Data for the Last Five Days Response:', response);
                    var salesData = JSON.parse(response);
                    var dates = [];
                    var salesAmounts = [];

                    salesData.forEach(function(sale) {
                        dates.push(sale.sale_date);
                        salesAmounts.push(parseFloat(sale.total_sales_amount));
                    });

                    console.log('Dates:', dates);
                    console.log('Sales Amounts:', salesAmounts);

                    var ctx = document.getElementById('salesChart').getContext('2d');
                    if (ctx) {
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: dates,
                                datasets: [{
                                    label: 'Ventas de los últimos 5 días',
                                    data: salesAmounts,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    } else {
                        console.error('El elemento #salesChart no se encontró en el DOM.');
                    }
                } catch (error) {
                    console.error('Error en el manejo de la respuesta JSON: ' + error.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX: ' + textStatus);
            }
        });
    } else {
        console.log('El elemento #total_sales no está presente en esta página.');
    }
});
