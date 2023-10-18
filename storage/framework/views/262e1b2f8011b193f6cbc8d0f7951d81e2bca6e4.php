<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("محتوى السيارة")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label><?php echo e(__("العنوان")); ?></label>
            <input type="text" value="<?php echo clean($translation->title); ?>" placeholder="<?php echo e(__("اسم السيارة")); ?>" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("المحتوى")); ?></label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($translation->content); ?></textarea>
            </div>
        </div>
        <?php if(is_default_lang()): ?>
            <div class="form-group">
                <label class="control-label"><?php echo e(__("فيديو يوتيوب")); ?></label>
                <input type="text" name="video" class="form-control" value="<?php echo e($row->video); ?>" placeholder="<?php echo e(__("رابط الفيديو على يوتيوب")); ?>">
            </div>
        <?php endif; ?>
        <div class="form-group-item">
            <label class="control-label"><?php echo e(__('الأسئلة الشائعة')); ?></label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5"><?php echo e(__("العنوان")); ?></div>
                    <div class="col-md-5"><?php echo e(__('المحتوى')); ?></div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                <?php if(!empty($translation->faqs)): ?>
                    <?php if(!is_array($translation->faqs)) $translation->faqs = json_decode($translation->faqs); ?>
                    <?php $__currentLoopData = $translation->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item" data-number="<?php echo e($key); ?>">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="faqs[<?php echo e($key); ?>][title]" class="form-control" value="<?php echo e($faq['title']); ?>" placeholder="<?php echo e(__('مثال: متى وأين ينتهي الجولة؟')); ?>">
                                </div>
                                <div class="col-md-6">
                                    <textarea name="faqs[<?php echo e($key); ?>][content]" class="form-control" placeholder="..."><?php echo e($faq['content']); ?></textarea>
                                </div>
                                <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('إضافة عنصر')); ?></span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="<?php echo e(__('مثال: هل يمكنني إحضار حيواني الأليف؟')); ?>">
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
        <?php if(is_default_lang()): ?>
            <div class="form-group">
                <label class="control-label"><?php echo e(__("صورة البانر")); ?></label>
                <div class="form-group-image">
                    <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id); ?>

                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo e(__("المعرض")); ?></label>
                <?php echo \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<?php if(is_default_lang()): ?>
    <div class="panel">
        <div class="panel-title"><strong><?php echo e(__("معلومات إضافية")); ?></strong></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo e(__("الركاب")); ?></label>
                        <input type="number" value="<?php echo e($row->passenger); ?>" placeholder="<?php echo e(__("مثال: 3")); ?>" name="passenger" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo e(__("نوع التحول")); ?></label>
                        <input type="text" value="<?php echo e($row->gear); ?>" placeholder="<?php echo e(__("مثال: أوتوماتيك")); ?>" name="gear" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo e(__("الأمتعة")); ?></label>
                        <input type="number" value="<?php echo e($row->baggage); ?>" placeholder="<?php echo e(__("مثال: 5")); ?>" name="baggage" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo e(__("عدد الأبواب")); ?></label>
                        <input type="number" value="<?php echo e($row->door); ?>" placeholder="<?php echo e(__("مثال: 4")); ?>" name="door" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/umrah/modules/Car/Views/admin/car/content.blade.php ENDPATH**/ ?>