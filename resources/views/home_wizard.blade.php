@extends('layouts.app')

@section('content')
    <style>
        .form-outline i {
            position: absolute;
            top: 60%;
            right: 90%;
            pointer-events: none;
        }

        ul.wizard,
        ul.wizard li {
            margin: 0;
            padding: 0;
            display: flex;
            width: 100%;
        }

        ul.wizard {
            counter-reset: num;
        }

        ul.wizard li {
            flex-direction: column;
            align-items: center;
            position: relative;
        }


        /* Cerchio*/

        ul.wizard li::before {
            counter-increment: num;
            content: counter(num);
            width: 1.8em;
            height: 1.8em;
            text-align: center;
            line-height: 1.5em;
            border-radius: 50%;
            background: #c1c1c1;
            cursor: pointer;
        }


        /* Linea */

        ul.wizard li~li::after {
            content: '';
            position: absolute;
            width: 100%;
            right: 50%;
            height: 4px;
            background-color: #c1c1c1;
            top: calc(0.75em - 2px);
            z-index: -1;
        }


        /* Tutte le righe che vengono dopo l'ultimo completed */

        ul.wizard li.completed~li::after {
            content: '';
            position: absolute;
            width: 100%;
            right: 50%;
            height: 7px;
            background-color: #c1c1c1;
            top: calc(0.75em - 2px);
            z-index: -1;
        }

        ul.wizard li.active::before {
            background: #246E9E;
            color: white;
        }

        ul.wizard li.active::after {
            background: #246E9E;
            color: white;
        }

        ul.wizard span {
            color: #333;
            font-size: 20px;
            word-break: break-all;
        }


        /*  updated sample  */


        /*  number and circle  */

        ul.wizard li.completed::before {
            background: #68e870;
            color: #333;
        }

        ul.wizard li.completed span {
            /*  text  */
            color: #000;
        }

        ul.wizard li.completed+li::after {
            /*  line after circle  */
            background: #68e870;
        }

        ul.wizard li.completed::after {
            /*  line before circle  */
            background: #68e870;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body ">

                        <h3 class="text-center mt-4 mb-4"> أحجز عمرتك الان</h3>
                        <p>
                            بعد تعبئة النموذج وتقديمه، يتم معالجة الطلب من قبل الجهة المسؤولة ويتم إبلاغ المتقدم بالمواعيد
                            المحتملة وأية معلومات إضافية. يهدف هذا النموذج إلى جعل عملية تسجيل العمرة مبسطة وفعالة
                            للمستخدمين.






                        </p>
                        <div class="container mt-2">

                            <div class="card p-4" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">



                                <hr class="mt-2">
                                <section id="personal-data">
                                    <h3> المعلومات الشخصية</h3>
                                    <form>
                                        <div class="row p4">

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> الاسم</label>
                                                    <input type="text" class="form-control ps-5" placeholder="محمد" />
                                                    <i class="fas fa-user ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> اللقب</label>
                                                    <input type="text" class="form-control ps-5" placeholder="اندلسي" />
                                                    <i class="fas fa-user ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> البريد الالكتروني</label>
                                                    <input type="email" class="form-control ps-5"
                                                        placeholder="البريد الالكتروني " />
                                                    <i class="fas fa-envelope ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> رقم الهاتف</label>
                                                    <input type="number" class="form-control ps-5"
                                                        placeholder="+1 34 43 43 " />
                                                    <i class="fas fa-phone ms-3"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <section id="panel-switch mt-4" style="margin-top:3%;">
                                            <div class="row mt-2">
                                                <div class="col-6">



                                                </div>
                                                <div class="col-6">

                                                    <button onclick="nextToReservation()" type="button"
                                                        class="btn btn-success shadow-1" style="float: left;"> مواصلة
                                                    </button>

                                                </div>


                                            </div>
                                        </section>
                                </section>
                                <section id="personal-reservation" style="display: none">
                                    <h3> معلومات الحجز</h3>
                                    <form>
                                        <div class="row p4">

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> عدد الأشخاص</label>
                                                    <input type="number" class="form-control ps-5" placeholder="محمد" />
                                                    <i class="fas fa-plus ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> الجنسية</label>
                                                    <select name="country" class="form-control">
                                                        <option value="" disabled selected>إختر</option>
                                                        <option value="أفغانستان">أفغانستان</option>
                                                        <option value="ألبانيا">ألبانيا</option>
                                                        <option value="الجزائر">الجزائر</option>
                                                        <option value="أندورا">أندورا</option>
                                                        <option value="أنغولا">أنغولا</option>
                                                        <option value="أنتيغوا وباربودا">أنتيغوا وباربودا</option>
                                                        <option value="الأرجنتين">الأرجنتين</option>
                                                        <option value="أرمينيا">أرمينيا</option>
                                                        <option value="أستراليا">أستراليا</option>
                                                        <option value="النمسا">النمسا</option>
                                                        <option value="أذربيجان">أذربيجان</option>
                                                        <option value="البهاما">البهاما</option>
                                                        <option value="البحرين">البحرين</option>
                                                        <option value="بنغلاديش">بنغلاديش</option>
                                                        <option value="باربادوس">باربادوس</option>
                                                        <option value="بيلاروسيا">بيلاروسيا</option>
                                                        <option value="بلجيكا">بلجيكا</option>
                                                        <option value="بليز">بليز</option>
                                                        <option value="بنين">بنين</option>
                                                        <option value="بوتان">بوتان</option>
                                                        <option value="بوليفيا">بوليفيا</option>
                                                        <option value="البوسنة والهرسك ">البوسنة والهرسك </option>
                                                        <option value="بوتسوانا">بوتسوانا</option>
                                                        <option value="البرازيل">البرازيل</option>
                                                        <option value="بروناي">بروناي</option>
                                                        <option value="بلغاريا">بلغاريا</option>
                                                        <option value="بوركينا فاسو ">بوركينا فاسو </option>
                                                        <option value="بوروندي">بوروندي</option>
                                                        <option value="كمبوديا">كمبوديا</option>
                                                        <option value="الكاميرون">الكاميرون</option>
                                                        <option value="كندا">كندا</option>
                                                        <option value="الرأس الأخضر">الرأس الأخضر</option>
                                                        <option value="جمهورية أفريقيا الوسطى ">جمهورية أفريقيا الوسطى
                                                        </option>
                                                        <option value="تشاد">تشاد</option>
                                                        <option value="تشيلي">تشيلي</option>
                                                        <option value="الصين">الصين</option>
                                                        <option value="كولومبيا">كولومبيا</option>
                                                        <option value="جزر القمر">جزر القمر</option>
                                                        <option value="كوستاريكا">كوستاريكا</option>
                                                        <option value="ساحل العاج">ساحل العاج</option>
                                                        <option value="كرواتيا">كرواتيا</option>
                                                        <option value="كوبا">كوبا</option>
                                                        <option value="قبرص">قبرص</option>
                                                        <option value="التشيك">التشيك</option>
                                                        <option value="جمهورية الكونغو الديمقراطية">جمهورية الكونغو
                                                            الديمقراطية</option>
                                                        <option value="الدنمارك">الدنمارك</option>
                                                        <option value="جيبوتي">جيبوتي</option>
                                                        <option value="دومينيكا">دومينيكا</option>
                                                        <option value="جمهورية الدومينيكان">جمهورية الدومينيكان</option>
                                                        <option value="تيمور الشرقية ">تيمور الشرقية </option>
                                                        <option value="الإكوادور">الإكوادور</option>
                                                        <option value="مصر">مصر</option>
                                                        <option value="السلفادور">السلفادور</option>
                                                        <option value="غينيا الاستوائية">غينيا الاستوائية</option>
                                                        <option value="إريتريا">إريتريا</option>
                                                        <option value="إستونيا">إستونيا</option>
                                                        <option value="إثيوبيا">إثيوبيا</option>
                                                        <option value="فيجي">فيجي</option>
                                                        <option value="فنلندا">فنلندا</option>
                                                        <option value="فرنسا">فرنسا</option>
                                                        <option value="الغابون">الغابون</option>
                                                        <option value="غامبيا">غامبيا</option>
                                                        <option value="جورجيا">جورجيا</option>
                                                        <option value="ألمانيا">ألمانيا</option>
                                                        <option value="غانا">غانا</option>
                                                        <option value="اليونان">اليونان</option>
                                                        <option value="جرينادا">جرينادا</option>
                                                        <option value="غواتيمالا">غواتيمالا</option>
                                                        <option value="غينيا">غينيا</option>
                                                        <option value="غينيا بيساو">غينيا بيساو</option>
                                                        <option value="غويانا">غويانا</option>
                                                        <option value="هايتي">هايتي</option>
                                                        <option value="هندوراس">هندوراس</option>
                                                        <option value="المجر">المجر</option>
                                                        <option value="آيسلندا">آيسلندا</option>
                                                        <option value="الهند">الهند</option>
                                                        <option value="إندونيسيا">إندونيسيا</option>
                                                        <option value="إيران">إيران</option>
                                                        <option value="العراق">العراق</option>
                                                        <option value="جمهورية أيرلندا ">جمهورية أيرلندا </option>
                                                        <option value="فلسطين">فلسطين</option>
                                                        <option value="إيطاليا">إيطاليا</option>
                                                        <option value="جامايكا">جامايكا</option>
                                                        <option value="اليابان">اليابان</option>
                                                        <option value="الأردن">الأردن</option>
                                                        <option value="كازاخستان">كازاخستان</option>
                                                        <option value="كينيا">كينيا</option>
                                                        <option value="كيريباتي">كيريباتي</option>
                                                        <option value="الكويت">الكويت</option>
                                                        <option value="قرغيزستان">قرغيزستان</option>
                                                        <option value="لاوس">لاوس</option>
                                                        <option value="لاوس">لاوس</option>
                                                        <option value="لاتفيا">لاتفيا</option>
                                                        <option value="لبنان">لبنان</option>
                                                        <option value="ليسوتو">ليسوتو</option>
                                                        <option value="ليبيريا">ليبيريا</option>
                                                        <option value="ليبيا">ليبيا</option>
                                                        <option value="ليختنشتاين">ليختنشتاين</option>
                                                        <option value="ليتوانيا">ليتوانيا</option>
                                                        <option value="لوكسمبورغ">لوكسمبورغ</option>
                                                        <option value="مدغشقر">مدغشقر</option>
                                                        <option value="مالاوي">مالاوي</option>
                                                        <option value="ماليزيا">ماليزيا</option>
                                                        <option value="جزر المالديف">جزر المالديف</option>
                                                        <option value="مالي">مالي</option>
                                                        <option value="مالطا">مالطا</option>
                                                        <option value="جزر مارشال">جزر مارشال</option>
                                                        <option value="موريتانيا">موريتانيا</option>
                                                        <option value="موريشيوس">موريشيوس</option>
                                                        <option value="المكسيك">المكسيك</option>
                                                        <option value="مايكرونيزيا">مايكرونيزيا</option>
                                                        <option value="مولدوفا">مولدوفا</option>
                                                        <option value="موناكو">موناكو</option>
                                                        <option value="منغوليا">منغوليا</option>
                                                        <option value="الجبل الأسود">الجبل الأسود</option>
                                                        <option value="المغرب">المغرب</option>
                                                        <option value="موزمبيق">موزمبيق</option>
                                                        <option value="بورما">بورما</option>
                                                        <option value="ناميبيا">ناميبيا</option>
                                                        <option value="ناورو">ناورو</option>
                                                        <option value="نيبال">نيبال</option>
                                                        <option value="هولندا">هولندا</option>
                                                        <option value="نيوزيلندا">نيوزيلندا</option>
                                                        <option value="نيكاراجوا">نيكاراجوا</option>
                                                        <option value="النيجر">النيجر</option>
                                                        <option value="نيجيريا">نيجيريا</option>
                                                        <option value="كوريا الشمالية ">كوريا الشمالية </option>
                                                        <option value="النرويج">النرويج</option>
                                                        <option value="سلطنة عمان">سلطنة عمان</option>
                                                        <option value="باكستان">باكستان</option>
                                                        <option value="بالاو">بالاو</option>
                                                        <option value="بنما">بنما</option>
                                                        <option value="بابوا غينيا الجديدة">بابوا غينيا الجديدة</option>
                                                        <option value="باراغواي">باراغواي</option>
                                                        <option value="بيرو">بيرو</option>
                                                        <option value="الفلبين">الفلبين</option>
                                                        <option value="بولندا">بولندا</option>
                                                        <option value="البرتغال">البرتغال</option>
                                                        <option value="قطر">قطر</option>
                                                        <option value="جمهورية الكونغو">جمهورية الكونغو</option>
                                                        <option value="جمهورية مقدونيا">جمهورية مقدونيا</option>
                                                        <option value="رومانيا">رومانيا</option>
                                                        <option value="روسيا">روسيا</option>
                                                        <option value="رواندا">رواندا</option>
                                                        <option value="سانت كيتس ونيفيس">سانت كيتس ونيفيس</option>
                                                        <option value="سانت لوسيا">سانت لوسيا</option>
                                                        <option value="سانت فنسينت والجرينادينز">سانت فنسينت والجرينادينز
                                                        </option>
                                                        <option value="ساموا">ساموا</option>
                                                        <option value="سان مارينو">سان مارينو</option>
                                                        <option value="ساو تومي وبرينسيب">ساو تومي وبرينسيب</option>
                                                        <option value="السعودية">السعودية</option>
                                                        <option value="السنغال">السنغال</option>
                                                        <option value="صربيا">صربيا</option>
                                                        <option value="سيشيل">سيشيل</option>
                                                        <option value="سيراليون">سيراليون</option>
                                                        <option value="سنغافورة">سنغافورة</option>
                                                        <option value="سلوفاكيا">سلوفاكيا</option>
                                                        <option value="سلوفينيا">سلوفينيا</option>
                                                        <option value="جزر سليمان">جزر سليمان</option>
                                                        <option value="الصومال">الصومال</option>
                                                        <option value="جنوب أفريقيا">جنوب أفريقيا</option>
                                                        <option value="كوريا الجنوبية">كوريا الجنوبية</option>
                                                        <option value="جنوب السودان">جنوب السودان</option>
                                                        <option value="إسبانيا">إسبانيا</option>
                                                        <option value="سريلانكا">سريلانكا</option>
                                                        <option value="السودان">السودان</option>
                                                        <option value="سورينام">سورينام</option>
                                                        <option value="سوازيلاند">سوازيلاند</option>
                                                        <option value="السويد">السويد</option>
                                                        <option value="سويسرا">سويسرا</option>
                                                        <option value="سوريا">سوريا</option>
                                                        <option value="طاجيكستان">طاجيكستان</option>
                                                        <option value="تنزانيا">تنزانيا</option>
                                                        <option value="تايلاند">تايلاند</option>
                                                        <option value="توغو">توغو</option>
                                                        <option value="تونجا">تونجا</option>
                                                        <option value="ترينيداد وتوباغو">ترينيداد وتوباغو</option>
                                                        <option value="تونس">تونس</option>
                                                        <option value="تركيا">تركيا</option>
                                                        <option value="تركمانستان">تركمانستان</option>
                                                        <option value="توفالو">توفالو</option>
                                                        <option value="أوغندا">أوغندا</option>
                                                        <option value="أوكرانيا">أوكرانيا</option>
                                                        <option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة
                                                        </option>
                                                        <option value="المملكة المتحدة">المملكة المتحدة</option>
                                                        <option value="الولايات المتحدة">الولايات المتحدة</option>
                                                        <option value="أوروغواي">أوروغواي</option>
                                                        <option value="أوزبكستان">أوزبكستان</option>
                                                        <option value="فانواتو">فانواتو</option>
                                                        <option value="فنزويلا">فنزويلا</option>
                                                        <option value="فيتنام">فيتنام</option>
                                                        <option value="اليمن">اليمن</option>
                                                        <option value="زامبيا">زامبيا</option>
                                                        <option value="زيمبابوي">زيمبابوي</option>
                                                    </select>


                                                    <i class="fas fa-flag ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">

                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> نوع التأشيرة</label>
                                                    <select name="country" class="form-control">
                                                        <option> تأشيرة سياحية </option>
                                                        <option> تأشيرة عمرة </option>
                                                    </select>
                                                    <i class="fas fa-plane ms-3"></i>
                                                </div>


                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> مكان الاقامة</label>
                                                    <input type="text" class="form-control ps-5"
                                                        placeholder=" مكان الاقامة" />
                                                    <i class="fas fa-map ms-3"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <section id="panel-switch mt-4" style="margin-top:3%;">
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <button onclick="returnToPersonal()" type="button"
                                                        class="btn btn-light shadow-1" style="float:right;"> العودة
                                                    </button>

                                                </div>
                                                <div class="col-6">

                                                    <button onclick="nextToUmrah()" type="button"
                                                        class="btn btn-success shadow-1" style="float: left;"> مواصلة
                                                    </button>

                                                </div>


                                            </div>
                                        </section>
                                </section>
                                <section id="personal-umrah" style="display: none;">
                                    <h3> معلومات العمرة </h3>
                                    <form>
                                        <div class="row p4">

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> عدد الأيام في مكة</label>
                                                    <input type="number" class="form-control ps-5"
                                                        placeholder="عدد الأيام في مكة" />
                                                    <i class="fas fa-plus ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> فندق مكة</label>


                                                    <select class="form-control">

                                                        <option>فندق إعمار إيليت </option>
                                                        <option> فندق إعمار إيليت </option>
                                                    </select>
                                                    <i class="fas fa-hotel ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> عدد الأيام في المدينة</label>
                                                    <input type="email" class="form-control ps-5"
                                                        placeholder="عدد الأيام في المدينة  " />
                                                    <i class="fas fa-plus ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> فندق مدينة المنورة </label>
                                                    <select class="form-control">

                                                        <option>فندق إعمار إيليت </option>
                                                        <option> فندق إعمار إيليت </option>
                                                    </select>
                                                    <i class="fas fa-hotel ms-3"></i>

                                                </div>
                                            </div>
                                        </div>
                                        <section id="panel-switch mt-4" style="margin-top:3%;">
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <button onclick="returnToReservation()" type="button"
                                                        class="btn btn-light shadow-1" style="float:right;"> العودة
                                                    </button>

                                                </div>
                                                <div class="col-6">

                                                    <button onclick="nextToPlus()" type="button"
                                                        class="btn btn-success shadow-1" style="float: left;"> مواصلة
                                                    </button>

                                                </div>


                                            </div>
                                        </section>
                                </section>
                                <section id="personal-plus" style="display: none">
                                    <h3> تفضيلات </h3>
                                    <form>
                                        <div class="row p4">

                                            <div class="col-md-12 col-xs-6 col-lg-12 mt-4">
                                                <label style="font-weight: bold;"> هل تريد خدمة النقل؟ </label>
                                                <div class="row">


                                                    <div class="col-5">

                                                        <div class="form-outline">
                                                            <label> نعم</label>
                                                            <input type="radio" class="form-control ps-5" />

                                                        </div>
                                                    </div>
                                                    <div class="col-5">

                                                        <div class="form-outline">
                                                            <label> لا </label>
                                                            <input type="radio" class="form-control ps-5" />

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-12 col-xs-6 col-lg-12 mt-4">
                                                <label style="font-weight: bold;"> هل تريد جولات سياحية خلال برنامجك
                                                    السياحي ؟</label>
                                                <div class="row">


                                                    <div class="col-5">

                                                        <div class="form-outline">
                                                            <label> نعم</label>
                                                            <input type="radio" class="form-control ps-5" />

                                                        </div>
                                                    </div>
                                                    <div class="col-5">

                                                        <div class="form-outline">
                                                            <label> لا </label>
                                                            <input type="radio" class="form-control ps-5" />

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>


                                        </div>
                                        <section id="panel-switch mt-4" style="margin-top:3%;">
                                            <div class=" row mt-2">
                                                <div class="col-6">
                                                    <button onclick="returnToUmrah()" type="button"
                                                        class="btn btn-light shadow-1" style="float:right;"> العودة
                                                    </button>

                                                </div>
                                                <div class="col-6">

                                                    <button onclick="nextToRevision()" type="button"
                                                        class="btn btn-success shadow-1" style="float: left;"> مواصلة
                                                    </button>

                                                </div>


                                            </div>
                                        </section>
                                </section>
                                <section id="personal-revision" style="display: none">
                                    <h3> مراجعة عامة </h3>
                                    <form>
                                        <div class="row p4">



                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="card">
                                                    <img class="card-img-top"
                                                        src="https://image-tc.galaxy.tf/wijpeg-2bng9k7qkw0kv6e1wy08la3m2/penta-duplex-suite-1_wide.jpg?crop=0%2C51%2C980%2C551"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title">فندق إعمار مكة</h5>
                                                        <p class="card-text">Some quick example text to build on the card
                                                            title and make up the bulk of the card's content.</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="card">
                                                    <img class="card-img-top"
                                                        src="https://image-tc.galaxy.tf/wijpeg-2bng9k7qkw0kv6e1wy08la3m2/penta-duplex-suite-1_wide.jpg?crop=0%2C51%2C980%2C551"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title">فندق إعمار المدينة</h5>
                                                        <p class="card-text">Some quick example text to build on the card
                                                            title and make up the bulk of the card's content.</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> مراجعة عامة</label>
                                                    <input type="number" readonly class="form-control ps-5"
                                                        placeholder="عدد الأيام في مكة" />
                                                    <i class="fas fa-plus ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> عدد الأيام في المدينة</label>
                                                    <input type="number" readonly class="form-control ps-5"
                                                        placeholder="عدد الأيام في المدينة  " />
                                                    <i class="fas fa-plus ms-3"></i>
                                                </div>
                                            </div>


                                        </div>
                                        <section id="panel-switch mt-4" style="margin-top:3%;">
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <button onclick="returnToPlus()" type="button"
                                                        class="btn btn-light shadow-1" style="float:right;"> العودة
                                                    </button>

                                                </div>
                                                <div class="col-6">

                                                    <button onclick="nextToReservation()" type="button"
                                                        class="btn btn-success shadow-1" style="float: left;"> تأكيد الحجز
                                                    </button>

                                                </div>


                                            </div>
                                        </section>
                                </section>
                                </form>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


        <script>
            // ------------step-wizard-------------
            function nextToReservation() {

                var sectionPersonalData = document.getElementById("personal-data");
                var sectionReservationData = document.getElementById("personal-reservation");

                sectionPersonalData.style.display = "none";
                sectionReservationData.style.display = "block";


            }

            function returnToPersonal() {

                var sectionPersonalData = document.getElementById("personal-data");
                var sectionReservationData = document.getElementById("personal-reservation");

                sectionPersonalData.style.display = "block";
                sectionReservationData.style.display = "none";

            }

            function nextToUmrah() {


                var sectionReservationData = document.getElementById("personal-reservation");
                var sectionPersonalUmrah = document.getElementById("personal-umrah");
                sectionPersonalUmrah.style.display = "block";
                sectionReservationData.style.display = "none";


            }

            function returnToReservation() {


                var sectionReservationData = document.getElementById("personal-reservation");
                var sectionPersonalUmrah = document.getElementById("personal-umrah");
                sectionPersonalUmrah.style.display = "none";
                sectionReservationData.style.display = "block";


            }

            function nextToPlus() {



                var sectionPlusData = document.getElementById("personal-plus");
                var sectionPersonalUmrah = document.getElementById("personal-umrah");
                sectionPersonalUmrah.style.display = "none";
                sectionPlusData.style.display = "block";

            }

            function returnToUmrah() {


                var sectionPlusData = document.getElementById("personal-plus");
                var sectionPersonalUmrah = document.getElementById("personal-umrah");
                sectionPersonalUmrah.style.display = "block";
                sectionPlusData.style.display = "none";

            }

            function nextToRevision() {


                var sectionPlusData = document.getElementById("personal-plus");
                var sectionRevision = document.getElementById("personal-revision");
                sectionRevision.style.display = "block";
                sectionPlusData.style.display = "none";


            }

            function returnToPlus() {


                var sectionPlusData = document.getElementById("personal-plus");
                var sectionRevision = document.getElementById("personal-revision");
                sectionRevision.style.display = "none";
                sectionPlusData.style.display = "block";


            }
        </script>

    </div>
    </div>
@endsection
