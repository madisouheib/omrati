<div class="item">
    <a href="{{ route("tour.search",['_layout'=>'map']) }}">{{__("عرض على الخريطة")}}</a>
</div>
<div class="item">
    @php
        $param = request()->input();
        $orderby =  request()->input("orderby");
    @endphp
    <div class="item-title">
        {{ __("الترتيب حسب:") }}
    </div>
    <div class="dropdown">
        <span class=" dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @switch($orderby)
                @case("price_low_high")
                {{ __("السعر (من الأدنى إلى الأعلى)") }}
                @break
                @case("price_high_low")
                {{ __("السعر (من الأعلى إلى الأدنى)") }}
                @break
                @case("rate_high_low")
                {{ __("التقييم (من الأعلى إلى الأدنى)") }}
                @break
                @default
                {{ __("موصى به") }}
            @endswitch
        </span>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            @php $param['orderby'] = "" @endphp
            <a class="dropdown-item" href="{{ route("tour.search",$param) }}">{{ __("موصى به") }}</a>
            @php $param['orderby'] = "price_low_high" @endphp
            <a class="dropdown-item" href="{{ route("tour.search",$param) }}">{{ __("السعر (من الأدنى إلى الأعلى)") }}</a>
            @php $param['orderby'] = "price_high_low" @endphp
            <a class="dropdown-item" href="{{ route("tour.search",$param) }}">{{ __("السعر (من الأعلى إلى الأدنى)") }}</a>
            @php $param['orderby'] = "rate_high_low" @endphp
            <a class="dropdown-item" href="{{ route("tour.search",$param) }}">{{ __("التقييم (من الأعلى إلى الأدنى)") }}</a>
        </div>
    </div>
</div>
