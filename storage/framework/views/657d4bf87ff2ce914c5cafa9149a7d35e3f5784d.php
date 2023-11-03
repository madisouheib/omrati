<div class="item">
    <a href="<?php echo e(route("tour.search",['_layout'=>'map'])); ?>"><?php echo e(__("عرض على الخريطة")); ?></a>
</div>
<div class="item">
    <?php
        $param = request()->input();
        $orderby =  request()->input("orderby");
    ?>
    <div class="item-title">
        <?php echo e(__("الترتيب حسب:")); ?>

    </div>
    <div class="dropdown">
        <span class=" dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php switch($orderby):
                case ("price_low_high"): ?>
                <?php echo e(__("السعر (من الأدنى إلى الأعلى)")); ?>

                <?php break; ?>
                <?php case ("price_high_low"): ?>
                <?php echo e(__("السعر (من الأعلى إلى الأدنى)")); ?>

                <?php break; ?>
                <?php case ("rate_high_low"): ?>
                <?php echo e(__("التقييم (من الأعلى إلى الأدنى)")); ?>

                <?php break; ?>
                <?php default: ?>
                <?php echo e(__("موصى به")); ?>

            <?php endswitch; ?>
        </span>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <?php $param['orderby'] = "" ?>
            <a class="dropdown-item" href="<?php echo e(route("tour.search",$param)); ?>"><?php echo e(__("موصى به")); ?></a>
            <?php $param['orderby'] = "price_low_high" ?>
            <a class="dropdown-item" href="<?php echo e(route("tour.search",$param)); ?>"><?php echo e(__("السعر (من الأدنى إلى الأعلى)")); ?></a>
            <?php $param['orderby'] = "price_high_low" ?>
            <a class="dropdown-item" href="<?php echo e(route("tour.search",$param)); ?>"><?php echo e(__("السعر (من الأعلى إلى الأدنى)")); ?></a>
            <?php $param['orderby'] = "rate_high_low" ?>
            <a class="dropdown-item" href="<?php echo e(route("tour.search",$param)); ?>"><?php echo e(__("التقييم (من الأعلى إلى الأدنى)")); ?></a>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/umrah/themes/Mytravel/Tour/Views/frontend/layouts/search/orderby.blade.php ENDPATH**/ ?>