<div class="table-responsive">
        <table id="tableUsers" class="data-table table table-bordered table-striped table-condensed">
            <thead>
            <tr>
                <th>ID</th>
                <th>{{trans('ibusiness::userbusinesses.users.first_name')}}</th>
                <th>{{trans('ibusiness::userbusinesses.users.last_name')}}</th>
                <th>{{trans('ibusiness::userbusinesses.users.email')}}</th>
                <th>{{trans('ibusiness::userbusinesses.users.role')}}</th>
                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
            </tr>
            </thead>
            <tbody>
                
            @for($i=0;$i<4;$i++)
           
                <tr>
                    <td>{{$i}}</td>
                    <td>xxxxx</td>
                    <td>xxxxx</td>
                    <td>xxxxx@email.com</td>
                    <td>
                        @if($i%2==0)
                            <span class="label label-info">XXXXXXXX</span>
                        @else
                            <span class="label label-warning">XXXXXXXX</span>
                        @endif
                    </td>
                        
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
                <th>{{trans('ibusiness::userbusinesses.users.first_name')}}</th>
                <th>{{trans('ibusiness::userbusinesses.users.last_name')}}</th>
                <th>{{trans('ibusiness::userbusinesses.users.email')}}</th>
                <th>{{trans('ibusiness::userbusinesses.users.role')}}</th>
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