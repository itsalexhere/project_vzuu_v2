<?php
defined('BASEPATH') or exit('No direct script access allowed');

$detail = json_decode($details, true);
?>

<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-fluid">

            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">

                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        <?= $titlePage ?>
                    </h1>

                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <?= $parentMenu ?>
                        </li>

                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>

                        <li class="breadcrumb-item text-muted"><?= $titlePage ?></li>
                    </ul>
                </div>
            </div>

            <div class="card mt-6">

                <form id="form" data-url="company_profile/process" enctype="multipart/form-data">
                    <div class="card-body border-top p-6">

                        <input type="hidden" id="id" name="id" value="<?= $detail['id'] ?>" />

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Logo</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?=base_url(). $detail['image_path'] ?>')">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= image_to_base64($detail['image_path']) ?>')"></div>

                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" id="file_upload" name="file_upload" accept=".png, .jpg, .jpeg" />
                                    </label>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>

                                </div>
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Name</label>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12 fv-row">
                                        <input type="text" id="name" name="name" class="form-control mb-3 mb-lg-0" placeholder="Name" value="<?= $detail['name'] ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end p-2">
                            <button class="btn btn-success btn-sm fw-bold text-white" type="button" id="btnProcessModal"><i class="fas fa-save text-white me-1"></i> Save</button>
                        </div>
                </form>

            </div>

        </div>
    </div>

</div>