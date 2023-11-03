@extends('layouts.user')
@section('content')
    <h2 class="title-bar">
        {{!empty($recovery) ?__('سيارات الانقاذ') : __("إدارة السيارات")}}
        @if(Auth::user()->hasPermission('car_create') && empty($recovery))
            <a href="{{ route("car.vendor.create") }}" class="btn-change-password">{{__("إضافة سيارة")}}</a>
        @endif
    </h2>
    @include('admin.message')
    @if($rows->total() > 0)
        <div class="bravo-list-item">
            <div class="bravo-pagination">
                <span class="count-string">{{ __("عرض :from - :to من مجموع :total سيارة",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                {{$rows->appends(request()->query())->links()}}
            </div>
            <div class="list-item">
                <div class="row">
                    @foreach($rows as $row)
                        <div class="col-md-12">
                            @include('Car::frontend.manageCar.loop-list')
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bravo-pagination">
                <span class="count-string">{{ __("عرض :from - :to من مجموع :total سيارة",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    @else
        {{__("لا توجد سيارات")}}
    @endif
@endsection
