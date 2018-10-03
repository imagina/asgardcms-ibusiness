<div class="table-responsive">
    <table class="data-table table table-bordered table-hover">
        <thead>
        <tr class="titles">
            <th>ID</th>
            <th>{{trans('icommerce::products.table.title')}}</th>
            <th>SKU</th>
            <th>Status</th>
            <th>{{trans('icommerce::products.table.price')}}</th>
            <th>{{ trans('core::core.table.created at') }}</th>
            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>{{trans('icommerce::products.table.title')}}</th>
            <th>SKU</th>
            <th>Status</th>
            <th>{{trans('icommerce::products.table.price')}}</th>
            <th>{{ trans('core::core.table.created at') }}</th>
            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
        </tr>
        </tfoot>
    </table>
</div>
@include('core::partials.delete-modal')
@push('js-stack')
<?php $locale = locale(); ?>
<script type="text/javascript">
  //Var to update price
  var business_id="";
  var product_id="";
  //Var to update price
    $(function(){

        var locale = "<?php echo $locale ?>";

        var table = $('.data-table').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{route('admin.ibusiness.businessproducts.searchTable',[$business->id])}}",
            "lengthMenu": [[20, 35, 50, 100], [20, 35, 50, 100]],
            "columns": [
                {"data":"id","name":"icommerce__products.id"},
                {"data":"title","name":"icommerce__products.title",
                    "render":function ( data, type, row, meta ) {
                    if (typeof data === "object")
                        return data[locale];
                    else
                        return data;
                }},
                {"data":"sku","name":"icommerce__products.sku"},
                {"data":"status","name":"icommerce__products.status",
                    "render":function ( data, type, row, meta ) {
                        if(data==0){
                            return "{{trans('icommerce::status.disabled')}}";
                        }else{
                            return "{{trans('icommerce::status.enabled')}}";
                        }

                }},

                {"data":"price","name":"ibusiness__businessproducts.price"},
                {"data":"created_at","name":"ibusiness__businessproducts.created_at"},
                {"data":"id","name":"icommerce__products.id"},

                ],
                "columnDefs": [ {
                    "targets": 6,
                    "data": "",
                    "render": function ( data, type, row, meta ) {
                        rBase = "{{url('')}}";
                        rDel = "/backend/ibusiness/businessproducts/{!!$business->id!!}/product/"+data;
                        rutaDel = rBase+rDel;
                        htmlDel = '<a href="#" title="{{trans('ibusiness::userbusinesses.table.unlink')}}" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="'+rutaDel+'" class="btn btn-sm btn-danger btn-flat" style="margin-left:2px;"><i class="fa fa-unlink"></i></a>';
                        htmlUpd = '<button title="{{trans('ibusiness::userbusinesses.table.editPrice')}}" onclick="editPrice({!!$business->id!!},'+data+')" type="button" class="btn btn-sm btn-info btn-flat" style="margin-left:2px;"><i class="fa fa-edit"></i></button>';
                        htmlResult = htmlUpd+htmlDel;
                        return htmlResult;
                    }//render
                  } ],
                "order": [[ 5, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }

            });

    });

    function editPrice(business_id,product_id){
      business_id_update=business_id;
      product_id_update=product_id;
      $.ajax({
        url:"{{url('/')}}"+'/backend/ibusiness/getProduct',
        type:'POST',
        headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
        dataType:"json",
        data:{business_id:business_id,product_id:product_id},
        success:function(result){
          if(result.success){
            $('#price_product').val(result.data.price);
            $('#name_product').val(result.data.product.title.es);
          }else{
            console.log('Error get product: '+result.msg);
          }
        },
        error:function(error){
          console.log(error);
        }
      });//ajax
      $('#modal-update-price').modal();
    }//editPrice

    function updatePrice(){
      var new_price_product=$('#price_product').val();
      if(new_price_product==""){
        alert("{{trans('ibusiness::businessproducts.validation.price_product_blank')}}");
      }else if(new_price_product<=0){
        alert("{{trans('ibusiness::businessproducts.validation.price_product_min')}}");
      }else{
        $.ajax({
          url:"{{url('/')}}"+'/backend/ibusiness/updatePriceProduct',
          type:'POST',
          headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
          dataType:"json",
          data:{business_id:business_id_update,product_id:product_id_update,price:new_price_product},
          success:function(result){
            if(result.success){
              alert(result.msg);
              $('#price_product').val("");
              $('#name_product').val("");
              $('#modal-update-price').modal("hide");
              location.reload();
            }else{
              console.log('Error, update price product: '+result.msg);
            }//else
          },
          error:function(error){
            console.log(error);
          }
        });//ajax
      }//else
    }//updatePrice
</script>


@endpush
