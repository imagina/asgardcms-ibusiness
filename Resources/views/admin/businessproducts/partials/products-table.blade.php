<div class="table-responsive">
        <table id="tableUsers" class="data-table table table-bordered table-striped table-condensed">
            <thead>
            <tr>
                <th>ID</th>
                <th>{{trans('icommerce::products.table.title')}}</th>
                <th>Slug</th>
                <th>{{trans('icommerce::products.table.price')}}</th>
                <th>{{trans('icommerce::products.table.weight')}}</th>
                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
            </tr>
            </thead>
            <tbody>
                
            @for($i=0;$i<4;$i++)
           
                <tr>
                    <td>{{$i}}</td>
                    <td>xxxxx</td>
                    <td>xxxxx</td>
                    <td>0000</td>
                    <td>0</td>
                        
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target=""><i class="fa fa-unlink"></i></button>
                        </div>
                    </td>

                </tr>
                
            @endfor

            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>{{trans('icommerce::products.table.title')}}</th>
                <th>Slug</th>
                <th>{{trans('icommerce::products.table.price')}}</th>
                <th>{{trans('icommerce::products.table.weight')}}</th>
                <th>{{ trans('core::core.table.actions') }}</th>
            </tr>
            </tfoot>
        </table>
        <!-- /.box-body -->
</div>

@include('core::partials.delete-modal')

@push('js-stack')

<?php $locale = locale(); ?>

<script type="text/javascript">

    $(function(){ 

        $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
        });
       
    });

</script>


@endpush