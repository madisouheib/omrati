@extends('layouts.app')

@section('content')
    <style>
        .form-outline i {
            position: absolute;
            top: 60%;
            right: 85%;
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

        .font-ibx {
            font-family: 'IBM Plex Sans Arabic';
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





        .invoice {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        .invoice h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        .invoice h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        .invoice a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <div class="container mt-4" id="app">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body ">

                        <h2 style="font-weight: bold" class="text-center mt-4 mb-4"> أحجز عمرتك الان</h2>
                        <img src="{{ url('/images/umrah.jpg') }}"
                            style="heigth:300px;width:300px;display: block; margin:auto;">
                        <p class="text-center ">
                            بعد تعبئة النموذج وتقديمه، يتم معالجة الطلب من قبل الجهة المسؤولة ويتم إبلاغ المتقدم بالمواعيد
                            المحتملة وأية معلومات إضافية. يهدف هذا النموذج إلى جعل عملية تسجيل العمرة مبسطة وفعالة
                            للمستخدمين.






                        </p>
                        <div class="container mt-2">

                            <div class="card p-4" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">



                                <hr class="mt-2">


                                <section id="personal-data" v-if="showPersonalData == true">
                                    <h3> المعلومات الشخصية</h3>
                                    <form>
                                        <div class="row p4">

                                            <div v-if="error_messages.length > 0" class="col-12">
                                                <div v-for="error in error_messages" :key="error"
                                                    class="alert alert-danger">
                                                    @{{ error }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> تاريخ البداية</label>
                                                    <input type="hidden"
                                                        value="{{ \Carbon\Carbon::parse(Request::segment(2))->format('Y-m-d') }}"
                                                        id="date_bd" v-model="date_b" class="form-control ps-5"
                                                        placeholder="تاريخ البداية" />
                                                    <input type="date" name="date_b"
                                                        value="{{ \Carbon\Carbon::parse(Request::segment(2))->format('Y-m-d') }}"
                                                        id="date_b" v-model="date_b" class="form-control ps-5"
                                                        placeholder="تاريخ البداية" />

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> تاريخ الانتهاء</label>
                                                    <input type="hidden" name="date_e" v-model="date_e" value=""
                                                        id="date_eb" class="form-control ps-5"
                                                        placeholder="تاريخ الانتهاء" />
                                                    <input type="date" name="date_e" v-model="date_e" value=""
                                                        id="date_e" class="form-control ps-5"
                                                        placeholder="تاريخ الانتهاء" />

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> الاسم</label>
                                                    <input type="text" v-model="first_name" name="first_name"
                                                        id="first_name" class="form-control ps-5" placeholder="محمد" />
                                                    <i class="fas fa-user ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> اللقب</label>
                                                    <input type="text" v-model="last_name" name="last_name"
                                                        id="last_name" class="form-control ps-5" placeholder="اندلسي" />
                                                    <i class="fas fa-user ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> البريد الالكتروني</label>
                                                    <input type="email" v-model="email" name="email" id="email"
                                                        class="form-control ps-5" placeholder="البريد الالكتروني " />
                                                    <i class="fas fa-envelope ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> رقم الهاتف</label>
                                                    <input type="number" name="phone" id="phone" v-model="phone"
                                                        class="form-control ps-5" placeholder="+1 34 43 43 " />
                                                    <i class="fas fa-phone ms-3"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <section id="panel-switch mt-4" style="margin-top:3%;">
                                            <div class="row mt-2">
                                                <div class="col-6">



                                                </div>
                                                <div class="col-6">

                                                    <button v-on:click="nextToReservation()" type="button"
                                                        class="btn btn-success shadow-1"
                                                        style="float: left;font-weigth:bold;">
                                                        مواصلة
                                                        <i class="fas fa-arrow-pointer"></i>
                                                    </button>


                                                </div>


                                            </div>
                                        </section>
                                </section>



                                <section id="personal-reservation" v-if="showPersonalReservation == true">
                                    <h3> معلومات الحجز</h3>
                                    <form>
                                        <div class="row p4">
                                            <div v-if="error_messages.length > 0" class="col-12">
                                                <div v-for="error in error_messages" :key="error"
                                                    class="alert alert-danger">
                                                    @{{ error }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> عدد الأشخاص</label>
                                                    <input type="number" name="nb_person" v-model="nb_person"
                                                        id="nb_person" class="form-control ps-5"
                                                        placeholder="عدد الأشخاص" />
                                                    <i class="fas fa-plus ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> الجنسية</label>
                                                    <select class="form-control" id="mySelectVillages"
                                                        v-model="nationality">


                                                        <option v-for="national in nationalies" :value="national.id"
                                                            :key="national.id">
                                                            @{{ national.name }} </option>
                                                    </select>


                                                    <i class="fas fa-flag ms-3"></i>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> مكان الاقامة</label>
                                                    <input id="residance" type="text" class="form-control ps-5" />
                                                    <i class="fas fa-map ms-3"></i>
                                                </div>
                                            </div>



                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> رقم جواز السفر</label>
                                                    <input id="passport" type="text" v-model="passport_number"
                                                        placeholder="يرجى كتابة رقم جواز السفر"
                                                        class="form-control ps-5" />
                                                    <i class="fas fa-passport ms-3"></i>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> تاريخ الاصدار</label>
                                                    <input id="passport_dateb" v-model="passport_dateb" type="date"
                                                        class="form-control ps-5" />

                                                </div>
                                            </div>


                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> تاريخ الانتهاء</label>
                                                    <input id="passport_datee" v-model="passport_datee" type="date"
                                                        class="form-control ps-5" />

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">

                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> نوع التأشيرة</label>
                                                    <select name="country" v-model="ticket" id="mySelectVisas"
                                                        class="form-control">



                                                        <option v-for="visa in list_visas" :value="visa.id"
                                                            :key="visa.id">
                                                            @{{ visa.title }} </option>
                                                    </select>
                                                    <i class="fas fa-plane ms-3"></i>
                                                </div>


                                            </div>
                                        </div>
                                        <section id="panel-switch mt-4" style="margin-top:3%;">
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <button @click="nextToReservation()" type="button"
                                                        class="btn btn-light shadow-1" style="float:right;"> العودة
                                                    </button>

                                                </div>
                                                <div class="col-6">

                                                    <button @click="nextToHotel()" type="button"
                                                        class="btn btn-success shadow-1" style="float: left;"> مواصلة
                                                        <i class="fas fa-arrow-pointer"></i>
                                                    </button>

                                                </div>


                                            </div>
                                        </section>
                                </section>

                                <section id="personal-hotel" v-if="showHotel == true">
                                    <h3> حجز الفندق </h3>


                                    <div class="row p4">

                                        <div v-if="error_messages.length > 0" class="col-12">
                                            <div v-for="error in error_messages" :key="error"
                                                class="alert alert-danger">
                                                @{{ error }}
                                            </div>
                                        </div>

                                        <div v-if="days_stay == true" class="col-12">
                                            <div class="alert alert-warning">
                                                @{{ nb_rest }} عدد الايام المتبقي
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                            <div class="form-outline">
                                                <label style="font-weight: bold;"> عدد الأيام في مكة</label>
                                                <input type="number" @change="checkTotalNumber(nb_mekkah)"
                                                    min="1" v-model="nb_mekkah" id="nbmekkahdays" name="nbmekkah"
                                                    class="form-control ps-5" placeholder="عدد الأيام في مكة" />
                                                <i class="fas fa-plus ms-3"></i>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                            <div class="form-outline">
                                                <label style="font-weight: bold;"> فندق مكة</label>


                                                <select class="form-control" @change="updateImageDataImage()"
                                                    id="mySelectMekkah" v-model="hotel_id">
                                                    <option v-for="hotelmak in list_mekkah" :value="hotelmak.id"
                                                        :key="hotelmak.id">
                                                        @{{ hotelmak.title }} </option>
                                                </select>
                                                <i class="fas fa-hotel ms-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                            <div class="form-outline">
                                                <label style="font-weight: bold;"> عدد الأيام في المدينة</label>
                                                <input type="number" v-model="nb_madina" min="1"
                                                    @change="checkTotalNumber(nb_madina)" id="nb_madina" name="nbmadina"
                                                    class="form-control ps-5" placeholder="عدد الأيام في المدينة  " />
                                                <i class="fas fa-plus ms-3"></i>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                            <div class="form-outline">
                                                <label style="font-weight: bold;">
                                                    فندق مدينة المنورة
                                                </label>
                                                <select class="form-control" id="mySelectMadina"
                                                    onchange="updateImageDataMadina()">
                                                    <option v-for="hotelmad in list_madina" :value="hotelmad.id"
                                                        :key="hotelmad.id">
                                                        @{{ hotelmad.title }} </option>

                                                </select>

                                                <i class="fas fa-hotel ms-3"></i>

                                            </div>
                                        </div>
                                        <img id="imageDisplay"
                                            style="display: block; width:500px;height:500px;margin-top:2%; margin-left:auto;margin-right:auto;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;"
                                            src="" alt="Selected Image">
                                    </div>
                                    <section id="panel-switch mt-4" style="margin-top:3%;">
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <button @click="nextToHotel()" type="button"
                                                    class="btn btn-light shadow-1" style="float:right;"> العودة
                                                </button>

                                            </div>
                                            <div class="col-6">

                                                <button @click="nextToPlus()" type="button"
                                                    class="btn btn-success shadow-1" style="float: left;"> مواصلة
                                                    <i class="fas fa-arrow-pointer"></i>
                                                </button>

                                            </div>


                                        </div>
                                    </section>
                                </section>
                                <section id="personal-plus" v-if="showPlus == true">
                                    <h3> تفضيلات </h3>

                                    <div class="row p4">

                                        <div class="col-md-12 col-xs-6 col-lg-12 mt-4">
                                            <label style="font-weight: bold;"> هل تريد خدمة النقل؟ </label>
                                            <div class="row">


                                                <div class="col-5">


                                                    <input class="form-control" id="visit" type="checkbox"
                                                        v-model="check_visit">
                                                </div>


                                            </div>
                                            <div class="row">


                                                <div class="col-5">

                                                    <div class="form-outline" id="selectList" v-if="check_visit == true">
                                                        <label style="font-weight: bold;">
                                                            اختر وسيلة النقل
                                                        </label>
                                                        <select class="form-control" id="mycar" v-model="car">
                                                            <option v-for="car in list_cars" :value="car.id"
                                                                :key="car.id">
                                                                @{{ car.title }} </option>
                                                        </select>
                                                        <i class="fas fa-hotel ms-3"></i>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-12 col-xs-6 col-lg-12 mt-4">
                                                <label style="font-weight: bold;"> هل تريد خدمات مرشد ؟ </label>
                                                <div class="row">


                                                    <div class="col-5">


                                                        <input class="form-control" id="visit" type="checkbox"
                                                            v-model="check_morchid">
                                                    </div>


                                                </div>

                                                <div class="col-5">

                                                    <div class="form-outline" id="selectList"
                                                        v-if="check_morchid == true">
                                                        <label style="font-weight: bold;">
                                                            مرشد نسك مكة
                                                        </label>
                                                        <select class="form-control" id="mycar" v-model="nusuki">
                                                            <option v-for="nusuk in list_nusuk" :value="nusuk.id"
                                                                :key="nusuk.id">
                                                                @{{ nusuk.title }} </option>
                                                        </select>

                                                        <label style="font-weight: bold;">
                                                            مرشد مزارات مدينة
                                                        </label>
                                                        <select class="form-control" id="mycar" v-model="mazarti">
                                                            <option v-for="mazart in list_mazart" :value="mazart.id"
                                                                :key="mazart.id">
                                                                @{{ mazart.title }} </option>
                                                        </select>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <section id="panel-switch mt-4" style="margin-top:3%;">
                                        <div class=" row mt-2">
                                            <div class="col-6">
                                                <button @click="nextToPlus()" type="button"
                                                    class="btn btn-light shadow-1" style="float:right;"> العودة
                                                </button>

                                            </div>
                                            <div class="col-6">

                                                <button @click="nextToRevision()" type="button"
                                                    class="btn btn-success shadow-1" style="float: left;"> مواصلة
                                                    <i class="fas fa-arrow-pointer"></i>
                                                </button>

                                            </div>


                                        </div>
                                    </section>
                                </section>
                                <section id="personal-revision" v-if="showRevision == true ">
                                    <h3> مراجعة عامة </h3>
                                    <div class="col-md-12 col-xs-12 col-lg-12 mt-4">

                                        <img class="mt-2" src="{{ url('images/check-out.png') }}"
                                            style="display: block;height:100px;width:100px;margin:auto;" />
                                    </div>
                                    <button class="btn btn-danger font-ibx"> تحميل الفاتورة <i
                                            class="fas fa-file-pdf"></i></button>
                                    <h4 class="text-center mt-2"> يتم معالجة طلبكم و التواصل معكم في أقل من 48 ساعة</h4>
                                    <div class="invoice">


                                        <div class="invoice-box rtl">
                                            <table>
                                                <tr class="top">
                                                    <td colspan="2">
                                                        <table>
                                                            <tr>
                                                                <td class="title">
                                                                    <img src="{{ url('/uploads/0000/1/2023/09/13/small.png') }}"
                                                                        alt="Company logo"
                                                                        style="width: 100%; max-width: 200px" />
                                                                </td>

                                                                <td>
                                                                    Invoice #: 123<br />
                                                                    Created: January 1, 2023<br />
                                                                    Due: February 1, 2023
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr class="information">
                                                    <td colspan="2">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    Omraty, Inc.<br />
                                                                    12345 Sunny Road<br />
                                                                    Saudia Arabia, Ryad
                                                                </td>

                                                                <td>
                                                                    <h5 class="font-ibx" v-model="last_name"></h5>.<br />
                                                                    <h5 v-model="first_name"></h5><br />
                                                                    <h5 v-model="email"></h5>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr class="heading">
                                                    <td class="font-ibx">طريقة الدفع</td>

                                                    <td>Check #</td>
                                                </tr>

                                                <tr class="details font-ibx">
                                                    <td class="font-ibx">Check</td>

                                                    <td>1000</td>
                                                </tr>

                                                <tr class="heading">
                                                    <td class="font-ibx">الخدمة</td>

                                                    <td class="font-ibx">السعر</td>
                                                </tr>

                                                <tr class="item">
                                                    <td> خدمة حجز تأشيرة</td>

                                                    <td>0 </td>
                                                </tr>

                                                <tr class="item">
                                                    <td class="font-ibx">خدمة حجز مرشد</td>

                                                    <td>$75.00</td>
                                                </tr>

                                                <tr class="item last font-ibx">
                                                    <td class="font-ibx">خدمة حجز الفندق</td>

                                                    <td>$1000.00</td>
                                                </tr>

                                                <tr class="total">
                                                    <td></td>

                                                    <td class="font-ibx">المجموع: $385.00</td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>







                                    <section id="panel-switch mt-4" style="margin-top:3%;">
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <button @click="nextToRevision()" type="button"
                                                    class="btn btn-light shadow-1" style="float:right;"> العودة
                                                </button>

                                            </div>
                                            <div class="col-6">

                                                <button @click="postData()" type="button"
                                                    class="btn btn-success shadow-1" type="submit" name="valid"
                                                    style="float: left;">
                                                    تأكيد الحجز
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
            new Vue({
                el: '#app',
                data: {
                    first_name: document.getElementById("first_name").value,
                    list_madina: {},
                    list_mazart: {},
                    list_nusuk: {},
                    nationalies: {},
                    showPersonalReservation: false,
                    showPersonalData: true,
                    showHotel: false,
                    showPlus: false,
                    days_stay: false,
                    check_visit: false,
                    showRevision: false,
                    nb_rest: 0,
                    date_b: document.getElementById("date_bd").value,
                    date_e: document.getElementById("date_eb").value,
                    list_mekkah: {},
                    dateDifference: 0,
                    list_cars: {},
                    list_visas: {},
                    error_messages: [],

                    passport_datee: "",
                    passport_dateb: "",
                    passport_number: "",
                    nusuki: "",
                    mazarti: "",
                    last_name: "",
                    ticket: false,
                    check_morchid: false,
                    phone: "",
                    hotel_id: "",
                    enable_section: 0,
                    email: "",
                    car: document.getElementById("mycar").value,
                    nb_person: 1,
                    nationality: "",
                    residance: document.getElementById("residance").value,
                    hotel_mekkah: '',
                    hotel_madina: '',
                    enableSection: true,
                    password: '',
                    nb_mekkah: 0,
                    nb_madina: 0,
                    nb_days_madina: document.getElementById("nb_madina").value,


                    // This is the variable bound to the input
                },
                created() {

                    this.fetchDataMekkah();
                    this.fetchDataMadina();
                    this.fetchDataVisas();
                    this.fetchDataVillages();
                    this.fetchDataCars();
                    this.fetchDataMazarat();
                    this.fetchDataNusuk();
                    console.log('hi there ');
                },
                methods: {
                    checkTotalNumber(value) {

                        console.log(this.dateDifference);
                        var totalDays = parseInt(this.nb_madina) + parseInt(this.nb_mekkah)
                        if (totalDays > parseInt(this.dateDifference)) {
                            this.error_messages = [];
                            var nb_rest = parseInt(this.nb_madina + this.nb_mekkah) - parseInt(this.dateDifference);


                            this.error_messages.push('  الحد الاقصى للايام هو ' + this.dateDifference);

                            this.days_stay = false;

                        } else {
                            this.days_stay = true;
                            this.nb_rest = this.nb_rest - value;

                            console.log()

                        }


                    },
                    nextToRevision() {


                        this.showRevision = !this.showRevision;
                        this.showPlus = !this.showPlus;
                    },
                    nextToPlus() {

                        this.showHotel = !this.showHotel;
                        this.showPlus = !this.showPlus;



                    },
                    nextToHotel() {


                        if (this.checkPlusData() == true) {


                            this.showHotel = !this.showHotel;
                            this.showPersonalReservation = !this.showPersonalReservation;

                        }

                    },
                    checkPlusData() {
                        this.status = true;
                        this.error_messages = [];
                        if (this.passport_number.length == 0) {

                            this.error_messages.push('يرجى كتابة رقم جواز السفر ');
                            this.status = false;

                        }

                        if (this.passport_dateb.length == 0) {

                            this.error_messages.push('يرجى كتابة تاريخ جواز السفر ');
                            this.status = false;

                        }
                        if (this.passport_datee.length == 0) {

                            this.error_messages.push('يرجى كتابة  نهاية تاريخ جواز السفر ');
                            this.status = false;

                        }

                        return this.status;
                    },
                    nextToReservation() {
                        console.log('hi tehre ');
                        this.error_messages = [];
                        const start = new Date(this.date_b);
                        const end = new Date(this.date_e);

                        // Calculate the difference in milliseconds
                        const differenceInMilliseconds = end.getTime() - start.getTime();

                        // Convert milliseconds to days
                        const differenceInDays = Math.floor(differenceInMilliseconds / (1000 * 60 * 60 * 24));

                        this.dateDifference = differenceInDays;
                        console.log('nb days ' + this.dateDifference);
                        this.nb_rest = this.dateDifference;
                        if (this.checkPersonalInfos() == true) {


                            console.log('dsdsd');

                            this.showPersonalData = !this.showPersonalData;
                            this.showPersonalReservation = !this.showPersonalReservation;



                        }
                        console.log('dsd' + this.error_messages);

                    },
                    checkPersonalInfos() {
                        console.log('length ' + this.last_name.length);
                        this.status = true;
                        if (this.first_name.length == 0) {

                            this.error_messages.push('يرجى كتابة الاسم ');
                            this.status = false;

                        }

                        if (this.phone.length == 0) {

                            this.error_messages.push('يرجى كتابة رقم الهاتف ');
                            this.status = false;
                        }
                        if (this.last_name.length == 0) {

                            this.error_messages.push('يرجى كتابة اللقب ');
                            this.status = false;
                        }
                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


                        if (this.email.length == 0 && emailRegex.test(this.email) == 0) {
                            this.error_messages.push('يرجى كتابة ايميل ');

                            this.status = false;

                        }

                        return this.status;

                    },
                    postData() {


                        const postData = {
                            last_name: document.getElementById("last_name").value,
                            first_name: document.getElementById("first_name").value,
                            phone: document.getElementById("phone").value,
                            email: document.getElementById("email").value,

                            nationality: document.getElementById("mySelectVillages").value,
                            nb_person: document.getElementById("nb_person").value,
                            car: document.getElementById("mycar").value,

                            hotel_madina: document.getElementById("mySelectMadina").value,
                            hotel_mekkah: document.getElementById("mySelectMekkah").value,
                            residance: document.getElementById("residance").value,


                            nb_madina: document.getElementById("nb_madina").value,
                            nb_mekkah: document.getElementById("nbmekkahdays").value
                        }
                        //var sectionReservationData = document.getElementById("personal-success");
                        //var sectionPersonalUmrah = document.getElementById("personal-revision");
                        //sectionPersonalUmrah.style.display = "none";
                        //sectionReservationData.style.display = "block";
                        fetch('/api/bookingomrah', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                    // Add any other headers if needed
                                },
                                body: JSON.stringify(postData)
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Success:', data);
                                // Handle the response data
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                // Handle errors
                            });

                        console.log('dsdsdsd');

                    },
                    fetchDataMekkah() {
                        fetch('/api/getmekkahhotels') // Replace with your API endpoint
                            .then(response => response.json())

                            .then(data => this.list_mekkah = data)
                            .catch(error => console.error('Error fetching data:', error));
                    },
                    fetchDataMadina() {
                        fetch('/api/getmadinahotels') // Replace with your API endpoint
                            .then(response => response.json())
                            .then(data => this.list_madina = data)

                            .catch(error => console.error('Error fetching data:', error));
                    },
                    fetchDataMazarat() {
                        fetch('/api/getmazarat') // Replace with your API endpoint
                            .then(response => response.json())
                            .then(data => this.list_mazart = data)

                            .catch(error => console.error('Error fetching data:', error));
                    },
                    fetchDataNusuk() {
                        fetch('/api/getnusuk') // Replace with your API endpoint
                            .then(response => response.json())
                            .then(data => this.list_nusuk = data)
                            .catch(error => console.error('Error fetching data:', error));
                    },
                    enableSection() {

                        var sectionCars = document.getElementById("selectDisplay");

                        sectionCars.style.display = "block";



                    },
                    fetchDataVisas() {
                        fetch('/api/getvisastypes') // Replace with your API endpoint
                            .then(response => response.json())
                            .then(data => this.list_visas = data)
                            .catch(error => console.error('Error fetching data:', error));
                    },
                    fetchDataCars() {
                        fetch('/api/getcars') // Replace with your API endpoint
                            .then(response => response.json())
                            .then(data => this.list_cars = data)
                            .catch(error => console.error('Error fetching data:', error));
                    },
                    fetchDataVillages() {
                        fetch('/api/getvillages') // Replace with your API endpoint
                            .then(response => response.json())
                            .then(data => this.nationalies = data)
                            .catch(error => console.error('Error fetching data:', error));
                    },
                    // Function to populate the select element with data
                    populateSelect(data) {
                        const selectElementMekkah = document.getElementById('mySelectMekkah');

                        // Clear existing options
                        selectElementMekkah.innerHTML = '';

                        // Add a default option
                        const defaultOption = document.createElement('option');
                        defaultOption.text = 'فندق مدينة مكة ';
                        selectElementMekkah.add(defaultOption);

                        // Add options from the fetched data
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id; // Use a unique identifier from your data
                            option.text = item.title; // Use a property from your data
                            option.setAttribute('data-image', baseUrl + '/uploads/' + item
                                .file_path); // Assuming there is an imagePath property

                            selectElementMekkah.add(option);
                        });
                    },
                    populateSelectCars(data) {
                        const selectElementCars = document.getElementById('mySelectCars');

                        // Clear existing options
                        selectElementCars.innerHTML = '';

                        // Add a default option
                        const defaultOption = document.createElement('option');
                        defaultOption.text = 'اختر سيارة';
                        selectElementCars.add(defaultOption);

                        // Add options from the fetched data
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id; // Use a unique identifier from your data
                            option.text = item.title; // Use a carproperty from your data
                            option.setAttribute('data-image', baseUrl + '/uploads/' + item
                                .file_path); // Assuming there is an imagePath property

                            selectElementCars.add(option);
                        });
                    }

                    ,
                    populateSelectMadina(data) {
                        const mySelectMadina = document.getElementById('mySelectMadina');

                        // Clear existing options
                        mySelectMadina.innerHTML = '';

                        // Add a default option
                        const defaultOption = document.createElement('option');
                        defaultOption.text = 'فندق مدينة المنورة ';
                        mySelectMadina.add(defaultOption);

                        // Add options from the fetched data
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id; // Use a unique identifier from your data
                            option.text = item.title; // Use a property from your data
                            option.setAttribute('data-image', baseUrl + '/uploads/' + item
                                .file_path); // Assuming there is an imagePath property

                            mySelectMadina.add(option);
                        });
                    }

                    ,
                    populateSelectVisas(data) {
                        const selectElementTicket = document.getElementById('mySelectVisas');

                        // Clear existing options
                        selectElementTicket.innerHTML = '';

                        // Add a default option
                        const defaultOption = document.createElement('option');
                        defaultOption.text = '  اختر التأشيرة ';
                        selectElementTicket.add(defaultOption);

                        // Add options from the fetched data
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id; // Use a unique identifier from your data
                            option.text = item.title; // Use a property from your data

                            selectElementTicket.add(option);
                        });
                    },
                    showCarsSection() {


                        var sectionCarsReservation = document.getElementById("selectDisplay");

                        sectionCarsReservation.style.display = "block";
                    }

                    ,

                    getValueofCar() {
                        var sectionCarsReservation = document.getElementById("selectDisplay");



                    },
                    updateImageDataImage(id) {



                        const baseUrl = window.location.origin;
                        const selectElement = document.getElementById('mySelectMekkah');
                        const imageElement = document.getElementById('imageDisplay');
                        const selectedOption = selectElement.options[selectElement.selectedIndex];

                        var theImage = this.list_madina.find(item => item.id === this.hotel_id);
                        console.log('d' + theImage);
                        const imagePath = baseUrl + '/uploads/' + path;

                        console.log(imagePath);
                        // Update the image source
                        imageElement.src = imagePath;
                    },
                    populateSelectVillages(data) {
                        const selectElementTowns = document.getElementById('mySelectVillages');

                        // Clear existing options
                        selectElementTowns.innerHTML = '';

                        // Add a default option
                        const defaultOption = document.createElement('option');
                        defaultOption.text = '  اختر الجنسية ';
                        selectElementTowns.add(defaultOption);

                        // Add options from the fetched data
                        data.forEach(items => {
                            const option = document.createElement('option');
                            option.value = items.id; // Use a unique identifier from your data
                            option.text = items.name; // Use a property from your data


                            selectElementTowns.add(option);
                        });
                    }


                }

            });



            function hideCarsSection() {
                var sectionCarsReservation = document.getElementById("selectDisplay");

                sectionCarsReservation.style.display = "none";


            }


            function returnToPersonal() {

                var sectionPersonalData = document.getElementById("personal-data");
                var sectionReservationData = document.getElementById("personal-reservation");

                sectionPersonalData.style.display = "block";
                sectionReservationData.style.display = "none";

            }

            function showSection() {

                var valueOfvisit = document.getElementById("visit").value;
                var sectionCarsReservation = document.getElementById("selectList");
                console.log('dsd' + valueOfvisit);
                if (valueOfvisit) {

                    sectionCarsReservation.style.display = "block";

                } else {

                    sectionCarsReservation.style.display = "none";

                }




            }



            function nextToUmrah() {


                var sectionReservationData = document.getElementById("personal-reservation");
                var sectionPersonalUmrah = document.getElementById("personal-umrah");
                sectionPersonalUmrah.style.display = "block";
                sectionReservationData.style.display = "none";


            }

            function returnToReservation() {


                var sectionReservationData = document.getElementById("personal-reservation");
                var sectionHotel = document.getElementById("personal-hotel");
                sectionHotel.style.display = "none";
                sectionReservationData.style.display = "block";


            }



            function returnToUmrah() {


                var sectionPlusData = document.getElementById("personal-plus");
                var sectionPersonalHotel = document.getElementById("personal-hotel");
                sectionPersonalHotel.style.display = "block";
                sectionPlusData.style.display = "none";

            }



            function returnToPlus() {


                var sectionPlusData = document.getElementById("personal-plus");
                var sectionRevision = document.getElementById("personal-revision");
                sectionRevision.style.display = "none";
                sectionPlusData.style.display = "block";


            }

            function updateImageDataMekkah(path) {

                const baseUrl = window.location.origin;
                const selectElement = document.getElementById('mySelectMekkah');
                const imageElement = document.getElementById('imageDisplay');
                const selectedOption = selectElement.options[selectElement.selectedIndex];

                const imagePath = baseUrl + '/uploads/' + path;

                console.log(imagePath);
                // Update the image source
                imageElement.src = imagePath;
            }

            function updateImageDataMadina() {
                const selectElement = document.getElementById('mySelectMadina');
                const imageElement = document.getElementById('imageDisplay');
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                const imagePath = selectedOption.getAttribute('data-image');

                console.log(imagePath);
                // Update the image source
                imageElement.src = imagePath;
            }
        </script>


    </div>
    </div>
@endsection
