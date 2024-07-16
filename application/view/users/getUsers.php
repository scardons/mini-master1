<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="card-header bg-primary text-white">
        <h4>Actions User</h4>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Document</th>
                    <th>Type Document</th>
                    <th>Names</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($user as $value) : ?>
                    <tr>
                      <td><?php echo $value['idUser']; ?></td>
                      <td><?php echo $value['Document']; ?></td>
                      <td><?php echo $value['Description']; ?></td>
                      <td><?php echo $value['Names']; ?></td>
                      <td><?php echo $value['Lastname']; ?></td>
                      <td><?php echo $value['Phone']; ?></td>
                      <td><?php echo $value['Email']; ?></td>
                      <td><?php echo $value['RolDescription']; ?></td>
                      <td><?php echo $value['Username']; ?></td>
                      <td>
                        <?php if ($value['Stat'] == 1) : ?>
                          <label class="badge badge-pill badge-success">Available</label>
                        <?php else : ?>
                          <label class="badge badge-pill badge-danger">UnAvailable</label>
                        <?php endif; ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit" onclick="dataUser('<?php echo $value['idUser']; ?>')"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-warning btn-xs" onclick="changeStatus('<?php echo $value['idUser']; ?>')"><i class="fa fa-refresh"></i></button>
                        <button type="button" class="btn btn-danger btn-xs" onclick="deleteUser('<?php echo $value['idUser']; ?>')"><i class="fa fa-trash"></i></button>
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
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="" method="post">


          <input type="hidden" name="txtIdUser" id="txtIdUser">
          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Type Document</label>
            <div class="col-md-6 col-sm-6 ">
              <select class="form-control" name="selDocType" id="selDocType">
                <option>Choose option</option>
                <?php foreach ($typeDocument as $value) : ?>
                  <option value="<?php echo $value['idTypeDocument']; ?>"><?php echo $value['doc']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="Document">Document<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="number" id="txtDocument" required="required" class="form-control" name="txtDocument">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" id="txtNames" required="required" class="form-control" name="txtNames">
            </div>
          </div>

        </div>
        <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" id="txtLastname" name="txtLastname" required="required" class="form-control">
        </div>
        </div>

        <div class="item form-group">
        <label for="Phone Number" class="col-form-label col-md-3 col-sm-3 label-align">Phone Number</label>
        <div class="col-md-6 col-sm-6 ">
          <input id="txtPhone" class="form-control" type="number" name="txtPhone" required="required">
        </div>
        </div>

        <div class="item form-group">
        <label for="Address" class="col-form-label col-md-3 col-sm-3 label-align">Address</label>
        <div class="col-md-6 col-sm-6 ">
          <input id="txtAddress" class="form-control" type="text" name="txtAddress" required="required">
        </div>
        </div>

        <div class="item form-group">
        <label for="Email" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
        <div class="col-md-6 col-sm-6 ">
          <input id="txtEmail" class="form-control" type="email" name="txtEmail" required="required">
        </div>
        </div>

        <div class="item form-group">
          <label for="Username" class="col-form-label col-md-3 col-sm-3 label-align">Username</label>
          <div class="col-md-6 col-sm-6 ">
            <input id="txtUser" class="form-control" type="text" name="txtUser" required="required">
          </div>
        </div>

        <div class="item form-group">
          <label for="Password" class="col-form-label col-md-3 col-sm-3 label-align">Password</label>
          <div class="col-md-6 col-sm-6 ">
            <input id="txtPassword" class="form-control" type="password" name="txtPassword" required="required">
          </div>
        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="btnUpdate" class="btn btn-primary">Save changes</button>
          </div>

        </div>


     </form>
  </div>


</div>
</div>
</div>