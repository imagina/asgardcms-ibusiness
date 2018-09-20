<div  v-if="approversCant>0" id="orderApprovers" class="col-12">
    <div class="card">

        <div class="card-header bg-secondary text-white">
            <i class="fa fa-address-book-o mr-2" aria-hidden="true"></i>
             {{trans('ibusiness::frontend.title.approvers')}}   
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table">

                    <th>Email<th>
                    <th>Status<th>
                    <th>{{trans('ibusiness::frontend.table.comment')}}<th>
                    <th>{{trans('ibusiness::frontend.table.created_at')}}<th>
                    <th>{{trans('ibusiness::frontend.table.updated_at')}}<th>

                    <tbody>
                        <tr v-for="approver in preorder.approvers">
                            <td>@{{approver.email}}<td>
                            <td>@{{approver.status}}<td>
                            <td>@{{approver.comment}}<td>
                            <td>@{{approver.created_at}}<td>
                            <td>@{{approver.updated_at}}<td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>