

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div id="media-management" class="cdn-browser management-page" v-cloak :class="{is_loading:isLoading}">
            <div class="d-flex flex-column">
                <div class="files-nav flex-shrink-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-left d-flex align-items-center">
                            <div class="filter-item">
                                <input type="text" placeholder="<?php echo e(__("Search file name....")); ?>" class="form-control" v-model="filter.s" @keyup.enter="filter.page = 1;reloadLists()">
                            </div>
                            <div class="filter-item">
                                <button class="btn btn-default" @click="reloadAll()">
                                    <i class="fa fa-search"></i> <?php echo e(__("Search")); ?></button>
                            </div>
                            <div class="filter-item">
                                <small><i><?php echo e(__("Total")); ?>: {{total}} <?php echo e(__("files")); ?></i></small>
                            </div>
                        </div>
                        <div class="div">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" @click="setViewType('grid')" class="btn" :class="viewType == 'grid' ? 'btn-secondary' : 'btn-outline-secondary'"><i class="fa fa-th"></i></button>
                                <button type="button" @click="setViewType('list')" class="btn" :class="viewType != 'grid' ? 'btn-secondary' : 'btn-outline-secondary'"><i class="fa fa-bars"></i></button>
                            </div>
                        </div>
                        <div class="col-right">
                            <i class="fa-spin fa fa-spinner icon-loading active" v-show="isLoading"></i>
                            <button class="btn btn-primary mr-2" @click="addFolder">
                                <span><i class="fa fa-folder"></i> <?php echo e(__("Add Folder")); ?></span>
                            </button>
                            <button class="btn btn-success btn-pick-files">
                                <span><i class="fa fa-upload"></i> <?php echo e(__("Upload")); ?></span>
                                <input multiple :accept="accept_type" type="file" name="files[]" ref="files">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="upload-new" v-show="showUploader" display="none">
                    <input type="file" name="filepond[]" class="my-pond">
                </div>
                <div class="files-list">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a @click="toFolderRoot" href="#"><?php echo e(__("Home")); ?></a></li>
                            <li v-for="(item,index) in breadcrumbs"  class="breadcrumb-item active" aria-current="page"><a @click.prevent="showFolder(item,index)" href="#">{{ item.name }}</a></li>
                        </ol>
                    </nav>

                    <div class="border-top border-left mb-3 px-3" v-if="viewType == 'list'">
                        <div class="row font-weight-bold " style="font-size: 16px">
                            <div class="col-sm-6 py-2 border-bottom border-right"><?php echo e(__("Name")); ?></div>
                            <div class="col-sm-2 py-2 border-bottom border-right"><?php echo e(__("Type")); ?></div>
                            <div class="col-sm-2 py-2 border-bottom border-right"><?php echo e(__("Created At")); ?></div>
                            <div class="col-sm-2 py-2 border-bottom border-right"><?php echo e(__("Size")); ?></div>
                        </div>
                        <folder-item @deleted="deletedFolder" @toggle-edit="toggleEditFolder" @dblclick="showFolder(folder)" @update="updateFolder" :view-type="viewType" v-for="(folder,index) in folders" :index="index" :key="'folder-'+index" :folder="folder"></folder-item>
                        <file-item v-for="(file,index) in files" :key="index" :view-type="viewType" :selected="selected" :file="file" v-on:select-file="selectFile"></file-item>
                    </div>
                    <div class="files-wraps " v-if="viewType == 'grid'" :class="'view-'+viewType">
                        <folder-item @deleted="deletedFolder" @toggle-edit="toggleEditFolder" @dblclick="showFolder(folder)" @update="updateFolder" v-for="(folder,index) in folders" :index="index" :key="'folder-'+index" :folder="folder"></folder-item>
                        <file-item v-for="(file,index) in files" :key="index" :view-type="viewType" :selected="selected" :file="file" v-on:select-file="selectFile"></file-item>
                    </div>
                    <p class="no-files-text text-center" v-show="!total && apiFinished" style="display: none"><?php echo e(__("No file found")); ?></p>
                    <div class="text-center" v-if="totalPage > 1">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" :class="{disabled:filter.page <= 1}">
                                    <a class="page-link" v-if="filter.page <=1"><?php echo e(__("Previous")); ?></a>
                                    <a class="page-link" href="#" v-if="filter.page > 1" v-on:click="changePage(filter.page-1,$event)"><?php echo e(__("Previous")); ?></a>
                                </li>
                                <li class="page-item" v-if="p >= (filter.page-3) && p <= (filter.page+3)" :class="{active: p == filter.page}" v-for="p in totalPage" @click="changePage(p,$event)">
                                    <a class="page-link" href="#">{{p}}</a></li>
                                <li class="page-item" :class="{disabled:filter.page >= totalPage}">
                                    <a v-if="filter.page >= totalPage" class="page-link"><?php echo e(__("Next")); ?></a>
                                    <a href="#" class="page-link" v-if="filter.page < totalPage" v-on:click="changePage(filter.page+1,$event)"><?php echo e(__("Next")); ?></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="browser-actions d-flex justify-content-between flex-shrink-0" v-if="selected.length">
                    <div class="col-left" v-show="selected.length">
                        <div class="control-remove" v-if="selected && selected.length">
                            <button class="btn btn-danger" @click="removeFiles"><?php echo e(__("Delete file")); ?></button>
                        </div>
                        <div class="control-info" v-if="selected && selected.length">
                            <div class="count-selected">{{selected.length}} <?php echo e(__("file selected")); ?></div>
                            <div class="clear-selected" @click="selected=[]"><i><?php echo e(__("unselect")); ?></i></div>
                        </div>
                    </div>
                    <div class="col-right d-none" v-show="selected.length">
                        <button class="btn btn-primary" :class="{disabled:!selected.length}" @click="sendFiles"><?php echo e(__("Use file")); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout::admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/umrah/modules/Media/Views/admin/index.blade.php ENDPATH**/ ?>