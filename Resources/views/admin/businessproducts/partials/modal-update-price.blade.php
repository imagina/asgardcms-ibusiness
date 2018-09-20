<div id="modal-update-price" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><strong>{{trans('ibusiness::businessproduct.title.UpdatePrice')}}:</strong></h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="col-md-6">
              <strong>{{trans('ibusiness::businesses.form.name_of_product')}}:</strong>
              <input type="text" style="text-align:center;" required class="form-control" required name="name_product"  value="" id="name_product" readonly>
            </div>
            <div class="col-md-6">
              <strong>{{trans('ibusiness::businesses.form.price_of_product')}}:</strong>
              <input type="number" style="text-align:center;" required class="form-control" required name="price" step="0.01" min="1" value="" id="price_product">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mx-auto">
        <button type="button" class="btn btn-success" onclick="updatePrice()" name="button">{{trans('ibusiness::businesses.form.updateBtn')}}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('core::core.button.cancel') }}</button>
      </div>
    </div>

  </div>
</div>
