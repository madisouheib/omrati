<div class="panel">
    <div class="panel-title"><strong>{{__("محتوى السيارة")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{__("العنوان")}}</label>
            <input type="text" value="{!! clean($translation->title) !!}" placeholder="{{__("اسم السيارة")}}" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("المحتوى")}}</label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
            </div>
        </div>
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("فيديو يوتيوب")}}</label>
                <input type="text" name="video" class="form-control" value="{{$row->video}}" placeholder="{{__("رابط الفيديو على يوتيوب")}}">
            </div>
        @endif
        <div class="form-group-item">
            <label class="control-label">{{__('الأسئلة الشائعة')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("العنوان")}}</div>
                    <div class="col-md-5">{{__('المحتوى')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($translation->faqs))
                    @php if(!is_array($translation->faqs)) $translation->faqs = json_decode($translation->faqs); @endphp
                    @foreach($translation->faqs as $key=>$faq)
                        <div class="item" data-number="{{$key}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="faqs[{{$key}}][title]" class="form-control" value="{{$faq['title']}}" placeholder="{{__('مثال: متى وأين ينتهي الجولة؟')}}">
                                </div>
                                <div class="col-md-6">
                                    <textarea name="faqs[{{$key}}][content]" class="form-control" placeholder="...">{{$faq['content']}}</textarea>
                                </div>
                                <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('إضافة عنصر')}}</span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="{{__('مثال: هل يمكنني إحضار حيواني الأليف؟')}}">
                        </div>
                        <div class="col-md-6">
                            <textarea __name__="faqs[__number__][content]" class="form-control" placeholder=""></textarea>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("صورة البانر")}}</label>
                <div class="form-group-image">
                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">{{__("المعرض")}}</label>
                {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
            </div>
        @endif
    </div>
</div>

@if(is_default_lang())
    <div class="panel">
        <div class="panel-title"><strong>{{__("معلومات إضافية")}}</strong></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("الركاب")}}</label>
                        <input type="number" value="{{$row->passenger}}" placeholder="{{__("مثال: 3")}}" name="passenger" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("نوع التحول")}}</label>
                        <input type="text" value="{{$row->gear}}" placeholder="{{__("مثال: أوتوماتيك")}}" name="gear" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("الأمتعة")}}</label>
                        <input type="number" value="{{$row->baggage}}" placeholder="{{__("مثال: 5")}}" name="baggage" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("عدد الأبواب")}}</label>
                        <input type="number" value="{{$row->door}}" placeholder="{{__("مثال: 4")}}" name="door" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
