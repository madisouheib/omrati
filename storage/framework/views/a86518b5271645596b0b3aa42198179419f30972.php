<div class="bravo-form-search-all hero-block hero-v1 bg-img-hero-bottom gradient-overlay-half-black-gradient text-center z-index-2" style="background-image: url('<?php echo e($bg_image_url); ?>') !important;">
    <div class="container space-2 space-top-xl-4">
        <div class="row justify-content-center pb-xl-8">
            <div class="py-8 py-xl-10 pb-5">
                <h1 class="font-size-60 font-size-xs-30 text-white font-weight-bold"><?php echo e($title ?? ''); ?></h1>
                <p class="font-size-20 font-weight-normal text-white"><?php echo e($sub_title ?? ''); ?></p>
            </div>
        </div>

        <ul class="nav tab-nav-rounded flex-nowrap pb-2 pb-md-4 tab-nav">
            <!-- Display tour first -->
            <?php if(!empty($service_types) && in_array('tour', $service_types)): ?>
                <?php
                    $service_type = 'tour';
                    $allServices = get_bookable_services();
                    $module = new $allServices[$service_type];
                ?>
                <li class="nav-item" role="bravo_<?php echo e($service_type); ?>">
                    <a class="nav-link font-weight-medium active pl-md-5 pl-3" id="bravo_<?php echo e($service_type); ?>-tab" data-toggle="pill" href="#bravo_<?php echo e($service_type); ?>" role="tab" aria-controls="bravo_<?php echo e($service_type); ?>" aria-selected="true">
                        <div class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                            <figure class="ie-height-40 d-md-block mr-md-3">
                                <i class="icon <?php echo e($module->getServiceIconFeatured()); ?> font-size-3"></i>
                            </figure>
                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                <?php echo e(!empty($modelBlock["title_for_".$service_type]) ? $modelBlock["title_for_".$service_type] : $module->getModelName()); ?>

                            </span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Display hotel next -->
            <?php if(!empty($service_types) && in_array('hotel', $service_types)): ?>
                <?php
                    $service_type = 'hotel';
                    $allServices = get_bookable_services();
                    $module = new $allServices[$service_type];
                ?>
                <li class="nav-item" role="bravo_<?php echo e($service_type); ?>">
                    <a class="nav-link font-weight-medium pl-md-5 pl-3" id="bravo_<?php echo e($service_type); ?>-tab" data-toggle="pill" href="#bravo_<?php echo e($service_type); ?>" role="tab" aria-controls="bravo_<?php echo e($service_type); ?>" aria-selected="true">
                        <div class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                            <figure class="ie-height-40 d-md-block mr-md-3">
                                <i class="icon <?php echo e($module->getServiceIconFeatured()); ?> font-size-3"></i>
                            </figure>
                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                <?php echo e(!empty($modelBlock["title_for_".$service_type]) ? $modelBlock["title_for_".$service_type] : $module->getModelName()); ?>

                            </span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Display other services -->
            <?php if(!empty($service_types)): ?>
                <?php $__currentLoopData = $service_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $allServices = get_bookable_services();
                        if(empty($allServices[$service_type]) || $service_type == 'tour' || $service_type == 'hotel') continue;
                        $module = new $allServices[$service_type];
                    ?>
                    <?php if($service_type != 'tour' && $service_type != 'hotel'): ?>
                        <li class="nav-item" role="bravo_<?php echo e($service_type); ?>">
                            <a class="nav-link font-weight-medium pl-md-5 pl-3" id="bravo_<?php echo e($service_type); ?>-tab" data-toggle="pill" href="#bravo_<?php echo e($service_type); ?>" role="tab" aria-controls="bravo_<?php echo e($service_type); ?>" aria-selected="true">
                                <div class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                                    <figure class="ie-height-40 d-md-block mr-md-3">
                                        <i class="icon <?php echo e($module->getServiceIconFeatured()); ?> font-size-3"></i>
                                    </figure>
                                    <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                        <?php echo e(!empty($modelBlock["title_for_".$service_type]) ? $modelBlock["title_for_".$service_type] : $module->getModelName()); ?>

                                    </span>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>

        <div class="tab-content hero-tab-pane">
            <!-- Display tour content -->
            <?php if(!empty($service_types) && in_array('tour', $service_types)): ?>
                <?php
                    $service_type = 'tour';
                    $allServices = get_bookable_services();
                    $module = new $allServices[$service_type];
                ?>
                <div class="tab-pane fade <?php if($service_type == 'tour'): ?> active show <?php endif; ?>" id="bravo_<?php echo e($service_type); ?>" role="tabpanel" aria-labelledby="bravo_<?php echo e($service_type); ?>-tab">
                    <div class="card border-0 tab-shadow">
                        <div class="card-body">
                            <?php echo $__env->make(ucfirst($service_type).'::frontend.layouts.search.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Display hotel content -->
            <?php if(!empty($service_types) && in_array('hotel', $service_types)): ?>
                <?php
                    $service_type = 'hotel';
                    $allServices = get_bookable_services();
                    $module = new $allServices[$service_type];
                ?>
                <div class="tab-pane fade" id="bravo_<?php echo e($service_type); ?>" role="tabpanel" aria-labelledby="bravo_<?php echo e($service_type); ?>-tab">
                    <div class="card border-0 tab-shadow">
                        <div class="card-body">
                            <?php echo $__env->make(ucfirst($service_type).'::frontend.layouts.search.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Display other services content -->
            <?php if(!empty($service_types)): ?>
                <?php $__currentLoopData = $service_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $allServices = get_bookable_services();
                        if(empty($allServices[$service_type]) || $service_type == 'tour' || $service_type == 'hotel') continue;
                        $module = new $allServices[$service_type];
                    ?>
                    <?php if($service_type != 'tour' && $service_type != 'hotel'): ?>
                        <div class="tab-pane fade" id="bravo_<?php echo e($service_type); ?>" role="tabpanel" aria-labelledby="bravo_<?php echo e($service_type); ?>-tab">
                            <div class="card border-0 tab-shadow">
                                <div class="card-body">
                                    <?php echo $__env->make(ucfirst($service_type).'::frontend.layouts.search.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /Users/souheibmadi/Documents/umrahproject/umrah/themes/Mytravel/Template/Views/frontend/blocks/form-search-all-service/style_1.blade.php ENDPATH**/ ?>