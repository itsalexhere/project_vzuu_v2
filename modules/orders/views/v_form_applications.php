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
                </div>

            </div>

            <div class="row mt-6">
                <div class="card mb-xl-10">

                    <div class="card-header border-0 cursor-pointer px-5" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                        <div class="card-title d-flex align-items-center gap-2">
                            <i class="bi bi-person-fill fs-3"></i>
                            <h3 class="fw-bold fs-3">Pelanggan</h3>
                        </div>
                    </div>

                    <!-- Garis pemisah dengan margin kecil -->
                    <hr class="my-2 mx-5" />

                    <!-- Content -->
                    <div id="kt_account_settings_signin_method" class="collapse show px-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">No KTP</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">No KK</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">Nama</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">Tgl Lahir</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">No Handphone</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <label class="fw-semibold fs-6 mb-4">Detail Alamat</label>

                            <div class="col-md-12">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">Alamat</label>
                                    <textarea type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" data-type="input" autocomplete="off" />
                                    </textarea>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">RT</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">RW</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">Provinsi</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">Kota</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">Kecamatan</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">Kelurahan</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-4">Kode Pos</label>
                                    <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>




                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Pelanggan</h3>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Email Address-->
                            <div class="d-flex flex-wrap align-items-center">
                                <!--begin::Label-->
                                <div id="kt_signin_email">
                                    <div class="fs-6 fw-bold mb-1">Email Address</div>
                                    <div class="fw-semibold text-gray-600">support@keenthemes.com</div>
                                </div>
                                <!--end::Label-->

                                <!--begin::Edit-->
                                <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form id="kt_signin_change_email" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                        <div class="row mb-6">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0 fv-plugins-icon-container">
                                                    <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Enter New Email Address</label>
                                                    <input type="email" class="form-control form-control-lg form-control-solid" id="emailaddress" placeholder="Email Address" name="emailaddress" value="support@keenthemes.com">
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="fv-row mb-0 fv-plugins-icon-container">
                                                    <label for="confirmemailpassword" class="form-label fs-6 fw-bold mb-3">Confirm Password</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="confirmemailpassword" id="confirmemailpassword">
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button id="kt_signin_submit" type="button" class="btn btn-primary  me-2 px-6">Update Email</button>
                                            <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-500 btn-active-light-primary px-6">Cancel</button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->

                                <!--begin::Action-->
                                <div id="kt_signin_email_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">Change Email</button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Email Address-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-6"></div>
                            <!--end::Separator-->

                            <!--begin::Password-->
                            <div class="d-flex flex-wrap align-items-center mb-10">
                                <!--begin::Label-->
                                <div id="kt_signin_password">
                                    <div class="fs-6 fw-bold mb-1">Password</div>
                                    <div class="fw-semibold text-gray-600">************</div>
                                </div>
                                <!--end::Label-->

                                <!--begin::Edit-->
                                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form id="kt_signin_change_password" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                        <div class="row mb-1">
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0 fv-plugins-icon-container">
                                                    <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Current Password</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid " name="currentpassword" id="currentpassword">
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0 fv-plugins-icon-container">
                                                    <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New Password</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid " name="newpassword" id="newpassword">
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0 fv-plugins-icon-container">
                                                    <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Confirm New Password</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid " name="confirmpassword" id="confirmpassword">
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>

                                        <div class="d-flex">
                                            <button id="kt_password_submit" type="button" class="btn btn-primary me-2 px-6">Update Password</button>
                                            <button id="kt_password_cancel" type="button" class="btn btn-color-gray-500 btn-active-light-primary px-6">Cancel</button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->

                                <!--begin::Action-->
                                <div id="kt_signin_password_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Password-->


                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed  p-6">
                                <!--begin::Icon-->
                                <i class="ki-outline ki-shield-tick fs-2tx text-primary me-4"></i> <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                    <!--begin::Content-->
                                    <div class="mb-3 mb-md-0 fw-semibold">
                                        <h4 class="text-gray-900 fw-bold">Secure Your Account</h4>

                                        <div class="fs-6 text-gray-700 pe-7">Two-factor authentication adds an extra layer of security to your account. To log in, in addition you'll need to provide a 6 digit code</div>
                                    </div>


                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap" data-bs-toggle="modal" data-bs-target="#kt_modal_two_factor_authentication">
                                        Enable </a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Content-->
                </div>
            </div>

        </div>
    </div>

</div>