<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="card-header bg-primary text-white">
        <h4>Actions Products</h4>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Precio</th>
                    <th>cantidad</th>
                    <th>Estatus</th>
                    <th>Options</th>
                    
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($product as $product) : ?>
                  <tr>
                      <td><?php echo $product['product_id']; ?></td>
                      <td><?php echo $product['product_name']; ?></td>
                      <td><?php echo $product['product_price']; ?></td>
                      <td><?php echo $product['product_quantity']; ?></td>
                      <td>
        <?php if ($product['product_status'] == 'Activo') : ?>
            <span id="statusBadge_<?php echo $product['product_id']; ?>" class="badge badge-pill badge-success">Activo</span>
        <?php else : ?>
            <span id="statusBadge_<?php echo $product['product_id']; ?>" class="badge badge-pill badge-danger">Inactivo</span>
        <?php endif; ?>
    </td>
        <td>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit" onclick="dataProduct('<?php echo $product['product_id']; ?>')"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-warning btn-xs" onclick="changeStatusProduct('<?php echo $product['product_id']; ?>')"><i class="fa fa-refresh"></i></button>
            <button type="button" class="btn btn-danger btn-xs" onclick="deleteProduct('<?php echo $product['product_id']; ?>')"><i class="fa fa-trash"></i></button>

        </td>
    </tr>
<?php endforeach; ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal-edit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">ACTUALIZACION</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="" method="post">
    <input type="hidden" name="txtIdProduct" id="txtIdProduct" >
    
    <div class="form-group">
        <label for="Nombre del producto">Nombre del Producto</label>
        <input type="text" class="form-control" id="txtProductName" name="txtProductName" >
    </div>
    
    <div class="form-group">
        <label for="precio del producto">Precio del Producto</label>
        <input type="number" class="form-control" id="txtProductPrice" name="txtProductPrice">
    </div>
    
    <div class="form-group">
        <label for="cantidad del producto">Cantidad del Producto</label>
        <input type="number" class="form-control" id="txtProductQuantity" name="txtProductQuantity" >
    </div>
    
  

    <button type="submit" name="btnUpdateProduct" class="btn btn-primary">Guardar cambios</button>
</form>


  </div>


</div>
</div>
</div>