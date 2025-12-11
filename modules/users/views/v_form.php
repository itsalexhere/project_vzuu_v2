<?php
defined('BASEPATH') or exit('No direct script access allowed');
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

            <form id="form" data-url="users/process" enctype="multipart/form-data" class="form">
                <div class="card mt-6">
                    <div class="card-body">

                        <div class="mb-6">
                            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                Account Details
                            </h1>

                            <hr>

                            <div class="row">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Username</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="username" name="username" class="form-control " placeholder="Username" />
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Role</span>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <select id="role_id" name="role_id" aria-label="Select Role" data-control="select2" data-placeholder="Select Role" class="form-select form-select-lg fw-semibold">
                                        <option value="">Select Role</option>
                                        <?php
                                        $roles =  json_decode($roles_list, true)['data'] ?? [];
                                        foreach ($roles as $role) {
                                        ?>
                                            <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label class="required col-lg-4 col-form-label fw-semibold fs-6">Email</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="email" name="email" class="form-control " placeholder="Email" autocomplete="off" />
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Password</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Confirm Password</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">Status</label>
                                <div class="col-lg-8 fv-row">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="enabled"
                                            <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'checked="checked"' : '' ?>
                                            name="status" id="status">
                                        <span id="status-text" class="ms-2">
                                            <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-6">
                    <div class="card-body">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                            User Information
                            <span class="text-warning fs-9 mt-1">All fields user information are optional.</span>
                        </h1>

                        <hr>

                        <div class="row">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Fullname</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="fullname" name="fullname" class="form-control " placeholder="Fullname" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Place & Date of Birth</label>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 fv-row">
                                        <input type="text" id="place" name="place" class="form-control  mb-3 mb-lg-0" placeholder="Place" />
                                    </div>

                                    <div class="col-lg-6 fv-row">
                                        <input type="date" id="date" name="date" class="form-control " />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Phone Number</label>

                            <div class="col-lg-8 fv-row">
                                <input type="number" id="phone_number" name="phone_number" class="form-control " placeholder="Phone Number" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Gender</label>
                            <div class="col-lg-8 fv-row">
                                <div class="d-flex align-items-center mt-3">
                                    <label class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                        <input class="form-check-input" name="gender" type="radio" value="male" checked />
                                        <span class="fw-semibold ps-2 fs-6">Male</span>
                                    </label>
                                    <label class="form-check form-check-custom form-check-inline form-check-solid">
                                        <input class="form-check-input" name="gender" type="radio" value="female" />
                                        <span class="fw-semibold ps-2 fs-6">Female</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Address</label>
                            <div class="col-lg-8 fv-row">
                                <textarea type="text" id="address" name="address" class="form-control" /></textarea>
                            </div>
                        </div>

                        <div class="row mt-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Image</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-1.jpg)"></div>

                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
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

                    </div>

                    <div class="card-footer d-flex justify-content-end p-4">
                        <button class="btn btn-danger btn-sm fw-bold text-white me-2" type="button" id="btnClose" data-url="<?= base_url('users') ?>">
                            <i class="fas fa-times text-white me-1"></i>
                            Close
                        </button>

                        <button class="btn btn-success btn-sm fw-bold text-white me-2 ml-2" type="button" id="btnProcessModal"><i class="fas fa-save text-white me-1"></i> Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>