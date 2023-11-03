<div class="item-list">
    @if($row->discount_percent)
        <div class="sale_info">{{$row->discount_percent}}</div>
    @endif
    <div class="row">
        <div class="col-md-3">
            @if($row->is_featured == "1")
                <div class="featured">
                    {{__("مميز")}}
                </div>
            @endif
            <div class="thumb-image">
                <a href="{{$row->getDetailUrl()}}" target="_blank">
                    @if($row->image_url)
                        <img src="{{$row->image_url}}" class="img-responsive" alt="">
                    @endif
                </a>
                <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                    <i class="fa fa-heart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="item-title">
                <a href="{{$row->getDetailUrl()}}" target="_blank">
                    {{$row->title}}
                </a>
            </div>
            <div class="location">
                @if(!empty($row->location->name))
                    <i class="icofont-paper-plane"></i>
                    {{__("الموقع")}}: {{$row->location->name ?? ''}}
                @endif
            </div>
            <div class="location">
                <i class="icofont-money"></i>
                {{__("السعر")}}: <span class="sale-price">{{ $row->display_sale_price_admin }}</span> <span class="price">{{ $row->display_price_admin }}</span>
            </div>
            <div class="location">
                <i class="icofont-ui-settings"></i>
                {{__("الحالة")}}: <span class="badge badge-{{ $row->status }}">{{ $row->status_text }}</span>
            </div>
            <div class="location">
                <i class="icofont-wall-clock"></i>
                {{__("آخر تحديث")}}: {{ display_datetime($row->updated_at ?? $row->created_at) }}
            </div>
            <div class="control-action">
                <a href="{{$row->getDetailUrl()}}" target="_blank" class="btn btn-info">{{__("عرض")}}</a>
                @if(!empty($recovery))
                    <a href="{{ route("car.vendor.restore",[$row->id]) }}" class="btn btn-recovery btn-primary" data-confirm="{{__('"هل تريد استعادة العنصر؟"')}}">{{__("استعادة")}}</a>
                    @if(Auth::user()->hasPermission('car_delete'))
                        <a href="{{ route("car.vendor.delete",['id'=>$row->id,'permanently_delete'=>1]) }}" class="btn btn-danger" data-confirm="{{__('"هل تريد حذفه نهائيا؟"')}}">{{__("حذف نهائي")}}</a>
                    @endif
                @else
                    @if(Auth::user()->hasPermission('car_update'))
                        <a href="{{ route("car.vendor.edit",[$row->id]) }}" class="btn btn-warning">{{__("تعديل")}}</a>
                    @endif
                    @if(Auth::user()->hasPermission('car_delete'))
                        <a href="{{ route("car.vendor.delete",[$row->id]) }}" class="btn btn-danger" data-confirm="{{__('"هل تريد حذفه؟"')}}">{{__("حذف")}}</a>
                    @endif
                    @if($row->status == 'publish')
                        <a href="{{ route("car.vendor.bulk_edit",[$row->id,'action' => "make-hide"]) }}" class="btn btn-secondary">{{__("إخفاء")}}</a>
                    @endif
                    @if($row->status == 'draft')
                        <a href="{{ route("car.vendor.bulk_edit",[$row->id,'action' => "make-publish"]) }}" class="btn btn-success">{{__("نشر")}}</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
