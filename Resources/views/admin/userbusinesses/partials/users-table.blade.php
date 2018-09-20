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

            @foreach ($business->users as $user)

                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach ($user->roles as $role)
                                {{$role->name}}
                        @endforeach
                    </td>

                    <td>
                        <div class="btn-group">
                            <button title="{{trans('ibusiness::userbusinesses.table.unlink')}}" class="btn btn-sm btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.ibusiness.userbusiness.destroy', [$business->id,$user->id]) }}">
                                <i class="fa fa-unlink"></i>
                            </button>
                        </div>
                    </td>

                </tr>

            @endforeach

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
