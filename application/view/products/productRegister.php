	<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="card-header bg-primary text-white">
									<h4>Created Products</h4>
									
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="formRegisterProduct" action="productRegister" method="post">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Product Name</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="txtProduct_name" required="required" class="form-control" name="txtProduct_name">
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="product-price">Product Price<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="number" id="txtProduct_price" required="required" class="form-control" name="txtProduct_price">
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="product-quantity">Product Quantity<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="number" id="txtProduct_quantity" required="required" class="form-control" name="txtProduct_quantity">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Product Status</label>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control" name="txtProduct_status" id="txtProduct_status">
                                                    <option value="Activo">Active</option>
                                                    <option value="Inactivo">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <div class="col-md-5 col-sm-5">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="btnRegisterProduct" class="btn btn-primary">Register Product</button>
                                        </div>
                                        </div>
                                    </form>


								</div>
							</div>
						</div>
					</div>
