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

            <div id="searchUser">

                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-search"> </i>
                    </span>
                    <input type="text" class="form-control" placeholder="{{trans('ibusiness::userbusinesses.table.add')}}" aria-describedby="basic-addon1">
                </div> 

            </div>

            <br><br>

            <table id="tableUsers" class="table table-striped table-bordered table-condensed ">
                <thead>
                    <tr>
                        <th>{{trans('ibusiness::userbusinesses.users.first_name')}}</th>
                        <th>{{trans('ibusiness::userbusinesses.users.last_name')}}</th>
                        <th>{{trans('ibusiness::userbusinesses.users.email')}}</th>
                        <th>{{trans('ibusiness::userbusinesses.users.role')}}</th>
                    </tr>
                </thead>
                <tbody>

                    @for($i=0;$i<4;$i++)
                        <tr>
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
                            <td scope="row">
                                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i></button>
                            </td>
                        </tr>
                    @endfor
                    
                    
                </tbody>
            </table>


            <div id="pagination-users">
                <ul class="pagination pull-right">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                </ul>
            <div>

        </div>

        
            
</div>

@push('js-stack')

<script type="text/javascript">

    $(function(){ 

       
    });

</script>


@endpush