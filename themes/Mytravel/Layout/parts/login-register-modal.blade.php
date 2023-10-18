<div class="modal fade login" id="login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content relative">
            <div class="modal-header">
                <h4 class="modal-title">{{__('تسجيل الدخول')}}</h4>
                <span class="c-pointer" data-dismiss="modal" aria-label="إغلاق">
                    <i class="input-icon field-icon fa">
                        <img src="{{url('images/ico_close.svg')}}" alt="إغلاق">
                    </i>
                </span>
            </div>
            <div class="modal-body relative">
                @include('Layout::auth/login-form')
            </div>
        </div>
    </div>
</div>
<div class="modal fade login" id="register" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content relative">
            <div class="modal-header">
                <h4 class="modal-title">{{__('التسجيل')}}</h4>
                <span class="c-pointer" data-dismiss="modal" aria-label="إغلاق">
                    <i class="input-icon field-icon fa">
                        <img src="{{url('images/ico_close.svg')}}" alt="إغلاق">
                    </i>
                </span>
            </div>
            <div class="modal-body">
                @include('Layout::auth/register-form')
            </div>
        </div>
    </div>
</div>
