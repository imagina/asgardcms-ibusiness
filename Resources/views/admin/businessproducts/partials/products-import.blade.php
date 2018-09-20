<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title text-uppercase ">
                    <strong>{{trans('ibusiness::businessproducts.table.products import')}}</strong>
        </h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>

        <div class="box-body">
            <div id="importProducts">
            <form role="form" method="post" action="{{url('backend/ibusiness/import_product/'.$business->id)}}" enctype='multipart/form-data' action="#">
                {{csrf_field()}}
                <div class="col-sm-5">

                    <div class="form-group">
                        <label for="InputFile">{{trans('icommerce::products.bulkload.Select File')}}</label>
                        <input type="file" id="InputFile" name="importfile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        <p class="help-block">{{trans('icommerce::products.bulkload.Select Filecompatible files CSV, XLSX')}}</p>
                    </div>

                </div>

                <div class="col-sm-7">

                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-flat btn-lg text-uppercase">{{trans('icommerce::products.bulkload.Submit')}}</button>
                    </div>

                </div>

            </form>
            </div>

        </div>

    </div>
</div>
