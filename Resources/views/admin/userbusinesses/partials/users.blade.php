<div class="box">

        <div class="box-header with-border">

            <h3 class="box-title text-uppercase ">
                <strong>{{trans('ibusiness::userbusinesses.table.users')}}</strong>
            </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>

        </div>

        <div class="box-body">

            <br>

            @include('ibusiness::admin.userbusinesses.partials.users-add')

            <br><br>

            @include('ibusiness::admin.userbusinesses.partials.users-table')

        </div>


</div>
