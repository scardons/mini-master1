function changeStatus(id){
   // alert(id);
    Swal.fire({
        title:'Would you like to change Status?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it',
    }).then((result) =>{
        if(result.isConfirmed){
            Swal.fire({
                position: "",
                icon: "success",
                title: "Status changed",
                confirmButtonText: "OK",
                timer: 2000
            }).then((result) =>{
                if(result.isConfirmed){
                    $.ajax({
                        type:"post",
                        url: url + "userController/changeStatus",
                        data:{'id':id,}
                    }).done(function(answer){
                        if(answer == 1){
                            window.location = url + "userController/getUsers";
                            window.reload();
                        }else{
                            Swal.fire('Wrong to change Status', '', 'error');
                        }
                    }).fail(function(error){
                        console.log(error);
                    });
                }
            });
        }
    });
}

function deleteUser(id){
    //alert(id);
    Swal.fire({
        title:'Would you like to Delete User?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it',
    }).then((result) =>{
        if(result.isConfirmed){
            Swal.fire({
                position: "",
                icon: "success",
                title: "User Deleted",
                confirmButtonText: "OK",
                timer: 2000
            }).then((result) =>{
                if(result.isConfirmed){
                    $.ajax({
                        type:"post",
                        url: url + "userController/deleteUser",
                        data:{'id':id,}
                    }).done(function(answer){
                        if(answer == 1){
                            window.location = url + "userController/getUsers";
                            window.reload();
                        }else{
                            Swal.fire('Wrong to Delete User', '', 'error');
                        }
                    }).fail(function(error){
                        console.log(error);
                    });
                }
            });
        }
    });
    
}

function dataUser(id){
    //alert(id);
    $.ajax({
        url: url + "userController/dataUser",
        type: "post",
        dataType: "json",
        data:{'id':id,}
    }).done(function(answer){
        $.each(answer, function(index, value){
            $('#txtIdUser').val(value.idUser);
            $('#selDocType').val(value.idTypeDocument);
            $('#txtDocument').val(value.Document);
            $('#txtNames').val(value.Names);
            $('#txtLastname').val(value.Lastname);
            $('#txtPhone').val(value.Phone);
            $('#txtAddress').val(value.Address);
            $('#txtEmail').val(value.Email);
            $('#txtUser').val(value.Username);
            $('#txtPassword').val(value.PASSWORD);
        })
    }).fail(function(error){
        console.log(error);
    })
}

//----------------------------------------------------


function changeStatusProduct(id) {
    Swal.fire({
        title: 'Would you like to change Product Status?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url + "productController/changeProductStatus",
                data: {'id': id},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            position: "",
                            icon: "success",
                            title: "Product Status changed",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Actualizar la interfaz si es necesario
                        // Por ejemplo, cambiar el texto del badge de estado
                        let badge = $(`#statusBadge_${id}`);
                        if (badge.hasClass('badge-success')) {
                            badge.removeClass('badge-success').addClass('badge-danger').text('Inactivo');
                        } else {
                            badge.removeClass('badge-danger').addClass('badge-success').text('Activo');
                        }
                    } else {
                        Swal.fire('Error occurred', '', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire('Error occurred', '', 'error');
                }
            });
        }
    });
}




function deleteProduct(id) {
    Swal.fire({
        title: 'Would you like to delete this product?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url + "productController/deleteProduct",
                data: {'id': id},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            position: "",
                            icon: "success",
                            title: "Product Deleted",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to delete product!'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error occurred while deleting product!'
                    });
                }
            });
        }
    });
}



function dataProduct(id) {
    alert(id);
    $.ajax({
        url: url + "productController/dataProduct",
        type: "post",
        dataType: "json",
        data: {'id': id}
    }).done(function(answer){
        $.each(answer, function(index, value){
        $('#txtIdProduct').val(value.product_id);
        $('#txtProductName').val(value.product_name);
        $('#txtProductPrice').val(value.product_price);
        $('#txtProductQuantity').val(value.product_quantity);
        })
    }).fail(function(error) {
        console.log(error);
    });
}



//-------------------------------------------------------------------

