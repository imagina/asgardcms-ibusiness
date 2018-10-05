<div  id="orderApproversCheck" class="col-12">
    <div class="card">

        <div class="card-header bg-secondary text-white">
            <i class="fa fa-check-square-o" aria-hidden="true"></i>
            {{trans('ibusiness::frontend.title.approversCheck')}}
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-8">

                    <div class="form-group">
                        <label for="status">{{trans('icommerce::orders.table.status')}}</label>
                        
                        <select :disabled="preorder.status!=10" v-model="statusSelected" class="form-control"  id="newstatus" name="newstatus">
                            <option v-for="(option, index) in approversStatus" v-bind:value="index">
                              @{{option}}
                            </option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="comment">{{trans('icommerce::orders.table.comment')}}</label>
                        <textarea :disabled="preorder.status!=10" class="form-control" v-model="approver_comment" rows="5" id="comment">@{{approver.comment}}</textarea>
                    </div>

                </div>

                <div class="col-4 align-self-center text-center">

                    <button v-if="preorder.status==10" v-on:click="update_status()" id="addstatus" type="button" class="btn btn-success btn-lg text-uppercase">
                        <i class="fa fa-check-square-o mr-1" aria-hidden="true"></i>
                        {{trans('ibusiness::frontend.buttons.save')}}
                    </button>

                </div>

            </div>
        </div>

    </div>


</div>
