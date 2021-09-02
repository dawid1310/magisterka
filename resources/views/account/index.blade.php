    @extends('layout')
    @section('content')
        @auth
            <section class="container overflow-hidden py-5">
                <div class="row gx-5 gx-sm-3 gx-lg-5 gy-lg-5 gy-3 pb-3 projects">
                    @if ($role == 'User')

                        <!-- Start Recent Work -->
                        <div class="col-xl-3 col-md-4 col-sm-6 project ui graphic">
                            <a href="account/{{ Auth::user()->id }}"
                                class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                                <img class="card-img" src="./assets/img/services-02.jpg" alt="Card image">
                                <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                                    <div class="service-work-content text-left text-light">
                                        <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Dane
                                            pacjenta</span>
                                        <p class="card-text">Aktualizacja i modyfikacja danych pacjenta</p>
                                    </div>
                                </div>
                            </a>
                        </div><!-- End Recent Work -->

                        <!-- Start Recent Work -->
                        <div class="col-xl-3 col-md-4 col-sm-6 project branding">
                            <a href="/treatment/{{ Auth::user()->id }}"
                                class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                                <img class="card-img" src="./assets/img/services-03.jpg" alt="Card image">
                                <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                                    <div class="service-work-content text-left text-light">
                                        <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Moje
                                            terapie</span>
                                        <p class="card-text">Historia wizyt oraz dokonanych transakcji</p>
                                    </div>
                                </div>
                            </a>
                        </div><!-- End Recent Work -->

                        <!-- Start Recent Work -->
                        <div class="col-xl-3 col-md-4 col-sm-6 project branding">
                            <a href="setSchedule"
                                class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                                <img class="card-img" src="./assets/img/services-03.jpg" alt="Card image">
                                <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                                    <div class="service-work-content text-left text-light">
                                        <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Historia
                                            użytkowania</span>
                                        <p class="card-text">Historia wizyt oraz dokonanych transakcji</p>
                                    </div>
                                </div>
                            </a>
                        </div><!-- End Recent Work -->

                        <!-- Start Recent Work -->
                        <div class="col-xl-3 col-md-4 col-sm-6 project ui graphic">
                            <a href="/visits/show?operator=>="
                                class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                                <img class="card-img" src="./assets/img/services-04.jpg" alt="Card image">
                                <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                                    <div class="service-work-content text-left text-light">
                                        <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Planowane
                                            wizyty</span>
                                        <p class="card-text">Kalendarz umożliwiający sprawdzenie nadchodzących wizyt</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @elseif($role=="Doctor")
                        <!-- Start Recent Work -->
                        <div class="col-xl-3 col-md-4 col-sm-6 project ui graphic">
                            <a href="/visits/menu"
                                class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                                <img class="card-img" src="./assets/img/services-02.jpg" alt="Card image">
                                <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                                    <div class="service-work-content text-left text-light">
                                        <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Recepty i zwolnienia</span>
                                        <p class="card-text">Wystawianie recept oraz zwolnień dla odbytych wizyt</p>
                                    </div>
                                </div>
                            </a>
                        </div><!-- End Recent Work -->

                        <!-- Start Recent Work -->
                        <div class="col-xl-3 col-md-4 col-sm-6 project ui graphic">
                            <a href="/treatment"
                                class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                                <img class="card-img" src="./assets/img/services-02.jpg" alt="Card image">
                                <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                                    <div class="service-work-content text-left text-light">
                                        <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Prowadzone
                                            przypadki</span>
                                        <p class="card-text">Dodawanie nowych przypadków, modyfikacja prowadzonych oraz
                                            przeglądanie wszystkich przypadków</p>
                                    </div>
                                </div>
                            </a>
                        </div><!-- End Recent Work -->

                        <!-- Start Recent Work -->
                        <div class="col-xl-3 col-md-4 col-sm-6 project branding">
                            <a href="doctors/history" class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                                <img class="card-img" src="./assets/img/services-03.jpg" alt="Card image">
                                <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                                    <div class="service-work-content text-left text-light">
                                        <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Historia
                                            użytkowania</span>
                                        <p class="card-text">Historia wizyt oraz wystawionych recept i zwolnień</p>
                                    </div>
                                </div>
                            </a>
                        </div><!-- End Recent Work -->

                        <!-- Start Recent Work -->
                        <div class="col-xl-3 col-md-4 col-sm-6 project ui graphic">
                            <a href="visits/{{ Cookie::get('docid') }}/show?operator=>="
                                class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                                <img class="card-img" src="./assets/img/services-04.jpg" alt="Card image">
                                <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                                    <div class="service-work-content text-left text-light">
                                        <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Planowane
                                            wizyty</span>
                                        <p class="card-text">Kalendarz umożliwiający sprawdzenie nadchodzących wizyt</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-4 col-sm-6 project ui graphic">
                            <a href="/schedule/create"
                                class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                                <img class="card-img" src="./assets/img/services-04.jpg" alt="Card image">
                                <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                                    <div class="service-work-content text-left text-light">
                                        <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Ustal
                                            grafik</span>
                                        <p class="card-text">What's up doc</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endif
                </div>
            </section>
        @endauth
    @endsection
