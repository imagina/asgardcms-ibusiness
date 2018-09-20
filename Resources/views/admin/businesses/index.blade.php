@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('ibusiness::businesses.title.businesses') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('ibusiness::businesses.title.businesses') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.ibusiness.business.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('ibusiness::businesses.button.create business') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                              <th>{{trans('ibusiness::businesses.title.name')}}</th>
                              <th>{{trans('ibusiness::businesses.title.description')}}</th>
                              <th>{{trans('ibusiness::businesses.title.limit_budget')}}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($businesses)): ?>
                            <?php foreach ($businesses as $business): ?>
                            <tr>
                              <td>{{$business->name}}</td>
                              <td>{{$business->description}}</td>
                              <td>{{$business->budget}}</td>
                                <td>
                                    <a href="{{ route('admin.ibusiness.business.edit', [$business->id]) }}">
                                        {{ $business->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.ibusiness.business.edit', [$business->id]) }}" class="btn btn-default btn-flat" title="{{trans('ibusiness::businesses.table.index.business')}}"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('admin.ibusiness.userbusiness.edit', [$business->id]) }}" class="btn btn-default btn-flat btn-success" title="{{trans('ibusiness::businesses.table.index.users')}}"><i class="fa fa-users fa-inverse"></i></a>
                                        <a href="{{ route('admin.ibusiness.businessproduct.edit', [$business->id]) }}" class="btn btn-default btn-flat btn-warning" title="{{trans('ibusiness::businesses.table.index.products')}}"><i class="fa fa-object-group fa-inverse"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.ibusiness.business.destroy', [$business->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                              <th>{{trans('ibusiness::businesses.title.name')}}</th>
                              <th>{{trans('ibusiness::businesses.title.description')}}</th>
                              <th>{{trans('ibusiness::businesses.title.limit_budget')}}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('ibusiness::businesses.title.create business') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.ibusiness.business.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 3, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
