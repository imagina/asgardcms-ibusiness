<div class="box">

        <div class="box-header with-border">

            <h3 class="box-title text-uppercase ">
                <strong>{{trans('ibusiness::businesses.single')}}</strong>
            </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>

        </div>

        <div class="box-body">

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">{{trans('ibusiness::businesses.title.name')}}</div>
                    <div class="panel-body">{{$business->name}}</div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">{{trans('ibusiness::businesses.title.description')}}</div>
                    <div class="panel-body">{{$business->description}}</div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">{{trans('ibusiness::businesses.title.nit')}}</div>
                    <div class="panel-body">{{$business->nit}}</div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">{{trans('ibusiness::businesses.title.limit_budget')}}</div>
                    <div class="panel-body">{{$business->budget}}</div>
                </div>
            </div>

        </div>

</div>
