<?php
$vendor = $row->author;
?>
@if(!empty($vendor->id))
<div class="owner-info widget-box">
    <div class="media">
        <div class="media-left">
            <a href="{{route('user.profile',['id'=>$vendor->user_name ?? $vendor->id])}}" target="_blank" class="avatar-cover" style="background-image: url('{{$vendor->getAvatarUrl()}}')" >
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><a class="author-link" href="{{route('user.profile',['id'=>$vendor->user_name ?? $vendor->id])}}" target="_blank">{{$vendor->getDisplayName()}}</a>
                @if($vendor->is_verified)
                    <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/ico-vefified-1.svg')}}" title="{{__("تم التحقق")}}" alt="{{__("تم التحقق")}}">
                @else
                    <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/ico-not-vefified-1.svg')}}" title="{{__("لم يتم التحقق")}}" alt="{{__("تم التحقق")}}">
                @endif
            </h4>
            <p>{{ __("عضو منذ :time",["time"=> date("M Y",strtotime($vendor->created_at))]) }}</p>
            @if((!Auth::id() or Auth::id() != $row->author_id ) and setting_item('inbox_enable'))
                <a class="btn btn-sm btn-primary" href="{{route('user.chat',['user_id'=>$row->author_id])}}" ><i class="icon ion-ios-chatboxes"></i> {{__('رسالة للمضيف')}}</a>
            @endif
        </div>
    </div>
</div>
@endif
