<div class="col-xl-4">
    <div class="card">
        <div class="card-body">
            <div class="search-box position-relative">
                <h5 class="mb-3"><?=lang('Files.Search')?></h5>
                <span class="callout"><span class="blink-text">Gunakan fungsi  search</span></span>
                <div class="position-relative px-2">
                    <?=form_open('article/search',['method'=>'get']);?>
                    <input type="text" class="form-control rounded bg-light border-light search-article" name="s" placeholder="Search..." onclick="mouseIn(this)" onmouseout="mouseOut(this)">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <?=form_close()?>
                </div>
            </div>
            <div class="mt-5">
                <h5 class="mb-3"><?=lang('Files.Categories')?></h5>
                <ul class="list-unstyled fw-medium px-2">
                    <?php foreach($data['category'] as $category):?>
                    <li><a href="javascript:;" class="text-dark py-3 d-block border-bottom" id="category" data-value="<?=$category->jum?>" data-name="<?=strtolower($category->categoryname)?>" data-page="<?=$page?>"><?=$category->categoryname?><span class="badge badge-soft-primary badge-pill float-end ms-1 font-size-12"><?=$category->jum?></span></a></li>
                    <?php endforeach;?>
                    <!-- <div style="min-height: 110px;" class="top-0 end-0"> -->
                        <div class="toast fade hide" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true" id="toastcategory">
                            <div class="toast-header">
                                <img src="<?=base_url()?>/public/assets/images/logo-baru.png" alt="Logo WP" class="me-2" height="18">
                                <strong class="me-auto">Notifikasi</strong>
                                <!-- <small class="text-muted">11 mins ago</small> -->
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body"></div>
                        </div>
                        <!--end toast-->
                    <!-- </div> -->
                </ul>
            </div>
            <?php if(count($data['upcoming'])>0):?>
            <div class="mt-5">
                <h5 class="mb-3">Upcoming Post</h5>
                <div class="list-group list-group-flush">
                    <?php foreach($data['upcoming'] as $upcoming):?>
                    <a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <img src="<?=base_url()?>/public/assets/images/gallery/article/<?=$upcoming->image?>" alt="Image's <?=$upcoming->title?>" class="avatar-lg h-auto d-block rounded">
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-13 text-truncate"><?=$upcoming->title?></h5>
                                <p class="mb-0 text-truncate"><?=$upcoming->created_at?><span class="">/ 05:00 AM</span></p>
                            </div>
                            <div class="fs-1">
                                <i class="mdi mdi-calendar"></i>
                            </div>
                        </div>
                    </a>
                    <?php endforeach;?>
                </div>
            </div>
            <?php endif;?>
            <?php if(count($data['popular'])>0):?>
            <div class="mt-5">
                <h5 class="mb-3"><?=lang('Files.Popular_Post')?></h5>
                <div class="list-group list-group-flush">
                    <?php foreach($data['popular'] as $popular):?>
                    <a href="<?=base_url()?>/article/read/<?=$popular->articleid?>" class="list-group-item text-muted pb-3 pt-0 px-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <?=$popular->image!='' ?
                                '<img src="'.base_url().'/public/assets/images/gallery/article/'.$popular->image.'" alt="Image\'s '.$popular->title.'" class="avatar-xl h-auto d-block rounded">' : '<i class="fs-1 mdi mdi-file-document-multiple-outline" style="color: var(--bs-yellow)"></i>'?>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-13 text-truncate"><?=$popular->title?></h5>
                                <p class="mb-0 text-truncate"><?=$popular->created_at?></p>
                            </div>
                        </div>
                    </a>
                    <?php endforeach;?>
                </div>
            </div>
            <?php endif;?>
            <!-- <div class="mt-5">
                <h5 class="mb-3">Tag Clouds</h5>
                <div class="px-2">
                    <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Design</span></a>
                    <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Development</span></a>
                    <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Wordpress</span></a>
                    <a href="#" class="font-size-17"><span class="badge badge-soft-primary">HTML</span></a>
                    <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Project</span></a>
                    <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Business</span></a>
                    <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Travel</span></a>
                    <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Photography</span></a>
                </div>
            </div> -->

            <!-- <div class="mt-5">
                <h5 class="mb-3">Instagram Post</h5>
                <div class="gap-2 hstack flex-wrap px-2">
                    <img src="assets/images/small/img-3.jpg" alt="" class="avatar-xl rounded">
                    <img src="assets/images/small/img-1.jpg" alt="" class="avatar-xl rounded">
                    <img src="assets/images/small/img-2.jpg" alt="" class="avatar-xl rounded">
                    <img src="assets/images/small/img-4.jpg" alt="" class="avatar-xl rounded">
                    <img src="assets/images/small/img-5.jpg" alt="" class="avatar-xl rounded">
                    <img src="assets/images/small/img-6.jpg" alt="" class="avatar-xl rounded">
                </div>
            </div> -->

            <div class="mt-5">
                <h5 class="mb-3"><?=lang('Files.Email_Newsletter')?></h5>
                <div class="">
                    <div class="input-group mb-0 px-2">
                        <input type="text" class="form-control" placeholder="masukkan alamat e-mail anda" value="<?=user()->email?>">
                        <div class="input-group-append">
                            <button class="input-group-text"><i class="mdi mdi-send-outline emailsubs"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card -->
</div>