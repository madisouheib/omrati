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
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <div class="container mt-4" id="app">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body ">

                        <h3 class="text-center mt-4 mb-4"> أحجز تأشيرتك الان</h3>
                        <p>
                            بعد تعبئة النموذج وتقديمه، يتم معالجة الطلب من قبل الجهة المسؤولة ويتم إبلاغ المتقدم بالمواعيد
                            المحتملة وأية معلومات إضافية. يهدف هذا النموذج إلى جعل عملية تسجيل العمرة مبسطة وفعالة
                            للمستخدمين.






                        </p>
                        <div class="container mt-2">

                            <img src="{{ url('/images/billet-de-cinema.png') }}" style="display:block; margin:auto;" />
                            <div class="card p-4" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">



                                <hr class="mt-2">
                                <section id="personal-data">
                                    <h3> المعلومات الشخصية</h3>
                                    <form>
                                        <div class="row p4">

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> الاسم</label>
                                                    <input type="text" name="last_name" v-model="first_name"
                                                        class="form-control ps-5" placeholder="محمد" />
                                                    <i class="fas fa-user ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> كلمة المرور</label>
                                                    <input type="password" name="password" v-model="password"
                                                        class="form-control ps-5" placeholder="كلمة المرور" />
                                                    <i class="fas fa-lock ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> اللقب</label>
                                                    <input type="text" name="last_name" v-model="last_name"
                                                        class="form-control ps-5" placeholder="اندلسي" />
                                                    <i class="fas fa-user ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> البريد الالكتروني</label>
                                                    <input type="email" name="email" v-model="email"
                                                        class="form-control ps-5" placeholder="البريد الالكتروني " />
                                                    <i class="fas fa-envelope ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> رقم الهاتف</label>
                                                    <input type="number" name="phone" v-model="phone"
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
                                                    <input type="number" name="nb_person" class="form-control ps-5"
                                                        placeholder="محمد" />
                                                    <i class="fas fa-plus ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;" v-model="nationality"> الجنسية</label>
                                                    <select class="form-control" id="mySelectVillages">

                                                    </select>


                                                    <i class="fas fa-flag ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">

                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> نوع التأشيرة</label>
                                                    <select name="country" v-model="ticket" id="mySelectVisas"
                                                        class="form-control">

                                                    </select>
                                                    <i class="fas fa-plane ms-3"></i>
                                                </div>


                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> مكان الاقامة</label>
                                                    <input v-model="residance" type="text"
                                                        class="form-control ps-5" />
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

                                            <div class="col-md-12 col-xs-12 col-lg-12 mt-4">

                                                <img class="mt-2" src="{{ url('images/check-out.png') }}"
                                                    style="display: block;height:100px;width:100px;margin:auto;" />
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> الاسم</label>
                                                    <input type="text" readonly class="form-control ps-5"
                                                        v-model="first_name" readonly placeholder="محمد" />
                                                    <i class="fas fa-user ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> اللقب</label>
                                                    <input type="text" readonly class="form-control ps-5"
                                                        placeholder="اندلسي" />
                                                    <i class="fas fa-user ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> البريد الالكتروني</label>
                                                    <input type="email" v-model="email" readonly
                                                        class="form-control ps-5" placeholder="البريد الالكتروني " />
                                                    <i class="fas fa-envelope ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> رقم الهاتف</label>
                                                    <input type="number" v-model="phone" readonly
                                                        class="form-control ps-5" />
                                                    <i class="fas fa-phone ms-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> عدد الأشخاص</label>
                                                    <input type="number" readonly class="form-control ps-5" />
                                                    <i class="fas fa-plus ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> جنسية </label>
                                                    <input type="text" v-model="nationality" readonly
                                                        class="form-control ps-5" />
                                                    <i class="fas fa-flag ms-3"></i>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> تأشيرة </label>
                                                    <input type="text" v-model="ticket" readonly
                                                        class="form-control ps-5" />
                                                    <i class="fas fa-plane ms-3"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-6 col-lg-6 mt-4">
                                                <div class="form-outline">
                                                    <label style="font-weight: bold;"> مكان الاقامة</label>
                                                    <input type="text" v-model="residance" readonly
                                                        class="form-control ps-5" placeholder=" مكان الاقامة" />
                                                    <i class="fas fa-map ms-3"></i>
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

                                                    <button @click="postData()" type="button"
                                                        class="btn btn-success shadow-1" style="float: left;"> تأكيد الحجز
                                                    </button>

                                                </div>


                                            </div>
                                        </section>
                                </section>
                                <section id="personal-success" style="display: none">
                                    <h3 class="text-center"> تم تأكيد التسجيل بنجاح </h3>


                                    <img src="{{ url('images/succes.png') }}"
                                        style="display: block;margin:auto;margin-top:4%;" />
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
                    first_name: '',
                    last_name: '',
                    phone: '',
                    email: '',
                    ticket: '',
                    nb_person: '',
                    nationality: '',
                    residance: '',
                    password: ''


                    // This is the variable bound to the input
                },
                created() {

                    this.fetchDataMekkah();
                },
                methods: {
                    postData() {


                        const postData = {
                            last_name: this.last_name,
                            first_name: this.first_name,
                            nationality: this.nationality,
                            nb_person: this.nb_person,
                            ticket_type: this.ticket,
                            phone: this.phone,
                            email: this.email,
                            residance: this.residance,
                            password: this.password
                        };
                        var sectionReservationData = document.getElementById("personal-success");
                        var sectionPersonalUmrah = document.getElementById("personal-revision");
                        sectionPersonalUmrah.style.display = "none";
                        sectionReservationData.style.display = "block";
                        fetch('/api/bookingtachira', {
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
                        fetch('/api/getmadinahotels') // Replace with your API endpoint
                            .then(response => response.json())
                            .then(data => populateSelect(data))
                            .catch(error => console.error('Error fetching data:', error));
                    }
                },
            });
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


                var sectionReservationData = document.getElementById("personal-revision");
                var sectionPersonalUmrah = document.getElementById("personal-reservation");
                sectionPersonalUmrah.style.display = "block";
                sectionReservationData.style.display = "none";


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

                //add stock 




                var sectionPlusData = document.getElementById("personal-reservation");
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Function to fetch data from the API
                const baseUrl = window.location.origin;

                console.log('hi there ');

                function fetchDataMekkah() {
                    fetch('/api/getmadinahotels') // Replace with your API endpoint
                        .then(response => response.json())
                        .then(data => populateSelect(data))
                        .catch(error => console.error('Error fetching data:', error));
                }

                function fetchDataMadina() {
                    fetch('/api/getmadinahotels') // Replace with your API endpoint
                        .then(response => response.json())
                        .then(data => populateSelectMadina(data))
                        .catch(error => console.error('Error fetching data:', error));
                }

                function fetchDataVisas() {
                    fetch('/api/getvisastypes') // Replace with your API endpoint
                        .then(response => response.json())
                        .then(data => populateSelectVisas(data))
                        .catch(error => console.error('Error fetching data:', error));
                }



                function fetchDataVillages() {
                    fetch('/api/getvillages') // Replace with your API endpoint
                        .then(response => response.json())
                        .then(data => populateSelectVillages(data))
                        .catch(error => console.error('Error fetching data:', error));
                }



                // Function to populate the select element with data
                function populateSelect(data) {
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
                }

                function populateSelectMadina(data) {
                    const selectElement = document.getElementById('mySelectMadina');

                    // Clear existing options
                    selectElement.innerHTML = '';

                    // Add a default option
                    const defaultOption = document.createElement('option');
                    defaultOption.text = 'فندق مدينة المنورة ';
                    selectElement.add(defaultOption);

                    // Add options from the fetched data
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id; // Use a unique identifier from your data
                        option.text = item.title; // Use a property from your data
                        option.setAttribute('data-image', baseUrl + '/uploads/' + item
                            .file_path); // Assuming there is an imagePath property

                        selectElement.add(option);
                    });
                }

                function populateSelectVisas(data) {
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
                }

                function populateSelectVillages(data) {
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



                // Fetch data and populate the select element
                fetchDataMekkah();
                fetchDataMadina();
                fetchDataVillages();
                fetchDataVisas();


            });

            function updateImageDataMekkah() {
                const selectElement = document.getElementById('mySelectMekkah');
                const imageElement = document.getElementById('imageDisplay');
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                const imagePath = selectedOption.getAttribute('data-image');

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
