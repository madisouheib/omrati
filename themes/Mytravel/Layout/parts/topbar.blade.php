<div class="bravo_topbar u-header__hide-content u-header__topbar u-header__topbar-lg border-bottom @if(!empty($is_home)|| !empty($header_transparent))border-color-white @else  border-color-8 @endif" style="background-color:#0A704B; ">
   <div class="{{$container_class ?? 'container'}}">
       <div class="d-flex align-items-center">
           <div class="list-inline u-header__topbar-nav-divider mb-0 topbar_left_text font-size-14 @if(!empty($is_home)|| !empty($header_transparent)) @else  list-inline-dark @endif">
               {!! setting_item_with_lang("topbar_left_text") !!}
           </div>
           <div class="ml-auto d-flex align-items-center">
               <div class="d-flex align-items-center text-white px-3">
                   <i class="flaticon-phone-call mr-2 ml-1 font-size-18"></i>
                   <span class="d-inline-block font-size-14 mr-1">{{ setting_item("phone_contact") }}</span>
               </div>
               @include('Core::frontend.currency-switcher')
               @include('Language::frontend.switcher')
               @include('Layout::parts.notification')
               <div class="position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
                   @if(!Auth::id())
                       <a href="javascript:;" class="d-flex align-items-center text-white py-3"
                          data-toggle="modal" data-target="#login">
                           <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                           <span class="d-inline-block font-size-14 mr-1">{{ __("تسجيل الدخول أو التسجيل") }}</span>
                       </a>
                   @else
                       <div class="d-flex align-items-center text-white py-3 dropdown">
                           <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                           <span class="d-inline-block font-size-14 mr-1 dropdown-nav-link" data-toggle="dropdown">
                            {{__("مرحباً، :name",['name'=>Auth::user()->getDisplayName()])}}
                        </span>

                           <ul class="dropdown-menu dropdown-menu-user text-left dropdown">
                               @if(empty( setting_item('wallet_module_disable') ))
                                   <li class="credit_amount">
                                       <a href="{{route('user.wallet')}}"><i class="fa fa-money"></i> {{__("الرصيد: :amount",['amount'=>auth()->user()->balance])}}</a>
                                   </li>
                               @endif
                               @if(is_vendor())
                                   <li class=""><a href="{{route('vendor.dashboard')}}" class=""><i class="icon ion-md-analytics"></i> {{__("لوحة التحكم للبائع")}}</a></li>
                               @endif
                               <li class="@if(is_vendor())  @endif">
                                   <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("ملفي الشخصي")}}</a>
                               </li>
                               @if(setting_item('inbox_enable'))
                                   <li class=""><a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("الرسائل")}}</a></li>
                               @endif
                               <li class=""><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("سلة الحجوزات")}}</a></li>
                               <li class=""><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("تغيير كلمة المرور")}}</a></li>
                               @if(is_admin())
                                   <li class=""><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("لوحة التحكم للمشرف")}}</a></li>
                               @endif
                               <li class="">
                                   <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('تسجيل الخروج')}}</a>
                               </li>
                           </ul>
                           <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
                               {{ csrf_field() }}
                           </form>
                       </div>
                   @endif
               </div>

           </div>
       </div>
   </div>
</div>
