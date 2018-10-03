@if(Auth::user()->hasAccess(['ibusiness.orders.permissions.index']))
<a class="dropdown-item text-white bg-transparent" href="{{url('/business')}}" >
    <i class="fa fa-address-book-o mr-2" aria-hidden="true"></i>{{trans('ibusiness::frontend.title.preorder')}}
</a>
@endif
