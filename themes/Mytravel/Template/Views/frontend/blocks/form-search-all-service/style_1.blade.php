<div class="bravo-form-search-all hero-block hero-v1 bg-img-hero-bottom gradient-overlay-half-black-gradient text-center z-index-2"
    style="background-image: url('{{ $bg_image_url }}') !important;">
    <div class="container space-2 space-top-xl-4">
        <div class="row justify-content-center pb-xl-8">
            <div class="py-8 py-xl-10 pb-5">
                <h1 class="font-size-60 font-size-xs-30 text-white font-weight-bold">{{ $title ?? '' }}</h1>
                <p class="font-size-20 font-weight-normal text-white">{{ $sub_title ?? '' }}</p>
            </div>
        </div>

        <ul class="nav tab-nav-rounded flex-nowrap pb-2 pb-md-4 tab-nav">
            <!-- Display tour first -->
            @if (!empty($service_types) && in_array('tour', $service_types))
                @php
                    $service_type = 'tour';
                    $allServices = get_bookable_services();
                    $module = new ($allServices[$service_type])();
                @endphp
                <li class="nav-item" role="bravo_{{ $service_type }}">
                    <a class="nav-link font-weight-medium active pl-md-5 pl-3" id="bravo_{{ $service_type }}-tab"
                        data-toggle="pill" href="#bravo_{{ $service_type }}" role="tab"
                        aria-controls="bravo_{{ $service_type }}" aria-selected="true">
                        <div class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                            <figure class="ie-height-40 d-md-block mr-md-3">
                                <i class="icon {{ $module->getServiceIconFeatured() }} font-size-3"></i>
                            </figure>
                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                {{ !empty($modelBlock['title_for_' . $service_type]) ? $modelBlock['title_for_' . $service_type] : $module->getModelName() }}
                            </span>
                        </div>
                    </a>
                </li>
            @endif

            <!-- Display hotel next -->
            @if (!empty($service_types) && in_array('hotel', $service_types))
                @php
                    $service_type = 'hotel';
                    $allServices = get_bookable_services();
                    $module = new ($allServices[$service_type])();
                @endphp
                <li class="nav-item" role="bravo_{{ $service_type }}">
                    <a class="nav-link font-weight-medium pl-md-5 pl-3" id="bravo_{{ $service_type }}-tab"
                        data-toggle="pill" href="#bravo_{{ $service_type }}" role="tab"
                        aria-controls="bravo_{{ $service_type }}" aria-selected="true">
                        <div class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                            <figure class="ie-height-40 d-md-block mr-md-3">
                                <i class="icon {{ $module->getServiceIconFeatured() }} font-size-3"></i>
                            </figure>
                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                {{ !empty($modelBlock['title_for_' . $service_type]) ? $modelBlock['title_for_' . $service_type] : $module->getModelName() }}
                            </span>
                        </div>
                    </a>
                </li>
            @endif

            <!-- Display other services -->
            @if (!empty($service_types))
                @foreach ($service_types as $service_type)
                    @php
                        $allServices = get_bookable_services();
                        if (empty($allServices[$service_type]) || $service_type == 'tour' || $service_type == 'hotel') {
                            continue;
                        }
                        $module = new ($allServices[$service_type])();
                    @endphp
                    @if ($service_type != 'tour' && $service_type != 'hotel')
                        <li class="nav-item" role="bravo_{{ $service_type }}">
                            <a class="nav-link font-weight-medium pl-md-5 pl-3" id="bravo_{{ $service_type }}-tab"
                                data-toggle="pill" href="#bravo_{{ $service_type }}" role="tab"
                                aria-controls="bravo_{{ $service_type }}" aria-selected="true">
                                <div
                                    class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                                    <figure class="ie-height-40 d-md-block mr-md-3">
                                        <i class="icon {{ $module->getServiceIconFeatured() }} font-size-3"></i>
                                    </figure>
                                    <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                        {{ !empty($modelBlock['title_for_' . $service_type]) ? $modelBlock['title_for_' . $service_type] : $module->getModelName() }}
                                    </span>
                                </div>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item" role="bravo_bravo_morchid">
                        <a class="nav-link font-weight-medium  @if ($number == 6) active @endif pl-md-5 pl-3 "
                            id="bravo_bravo_morchid-tab" data-toggle="pill" href="#bravo_bravo_morchid" role="tab"
                            aria-controls="bravo_morchid" aria-selected="true">
                            <div
                                class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                                <figure class="ie-height-40 d-md-block mr-md-3">
                                    <i class="icon icofont-users-alt-1 font-size-3"></i>
                                </figure>
                                <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                    مرشد
                                </span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="bravo_bravo_ticket">
                        <a class="nav-link font-weight-medium  @if ($number == 7) active @endif pl-md-5 pl-3 "
                            id="bravo_bravo_ticket-tab" data-toggle="pill" href="#bravo_bravo_ticket" role="tab"
                            aria-controls="bravo_morchid" aria-selected="true">
                            <div
                                class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                                <figure class="ie-height-40 d-md-block mr-md-3">
                                    <i class="icon icofont-air-ticket font-size-3"></i>
                                </figure>
                                <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                    تأشيرة
                                </span>
                            </div>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>

        <div class="tab-content hero-tab-pane">
            <!-- Display tour content -->
            @if (!empty($service_types) && in_array('tour', $service_types))
                @php
                    $service_type = 'tour';
                    $allServices = get_bookable_services();
                    $module = new ($allServices[$service_type])();
                @endphp
                <div class="tab-pane fade @if ($service_type == 'tour') active show @endif"
                    id="bravo_{{ $service_type }}" role="tabpanel" aria-labelledby="bravo_{{ $service_type }}-tab">
                    <div class="card border-0 tab-shadow">
                        <div class="card-body">
                            @include(ucfirst($service_type) . '::frontend.layouts.search.form-search')
                        </div>
                    </div>
                </div>
            @endif

            <!-- Display hotel content -->
            @if (!empty($service_types) && in_array('hotel', $service_types))
                @php
                    $service_type = 'hotel';
                    $allServices = get_bookable_services();
                    $module = new ($allServices[$service_type])();
                @endphp
                <div class="tab-pane fade" id="bravo_{{ $service_type }}" role="tabpanel"
                    aria-labelledby="bravo_{{ $service_type }}-tab">
                    <div class="card border-0 tab-shadow">
                        <div class="card-body">
                            @include(ucfirst($service_type) . '::frontend.layouts.search.form-search')
                        </div>
                    </div>
                </div>
            @endif

            <!-- Display other services content -->
            @if (!empty($service_types))
                @foreach ($service_types as $service_type)
                    @php
                        $allServices = get_bookable_services();
                        if (empty($allServices[$service_type]) || $service_type == 'tour' || $service_type == 'hotel') {
                            continue;
                        }
                        $module = new ($allServices[$service_type])();
                    @endphp
                    @if ($service_type != 'tour' && $service_type != 'hotel')
                        <div class="tab-pane fade" id="bravo_{{ $service_type }}" role="tabpanel"
                            aria-labelledby="bravo_{{ $service_type }}-tab">
                            <div class="card border-0 tab-shadow">
                                <div class="card-body">
                                    @include(ucfirst($service_type) . '::frontend.layouts.search.form-search')
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
