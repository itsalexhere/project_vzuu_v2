<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-5">

            <div class="card rounded-5" style="max-width: 450px;width: 100%;height: auto;">
                <div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
                    <form id="login" class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" action="#">
                        <div class="card-body shadow-lg rounded-3">

                            <div class="fv-row mb-5" id="alert-messages">
                            </div>

                            <div class="d-flex align-items-center mb-10">
                                <img alt="Logo" draggable="false" src="<?= base_url() . $setting_profile['image'] ?? "" ?>" class="me-4" 
                                style="height: 40px; object-fit: contain;">

                                <h1 class="text-gray-900 fs-1 m-0" data-kt-translate="sign-in-title">
                                    <?= $setting_profile['name'] ?? "" ?>
                                </h1>
                            </div>

                            <label for="username_email" class="form-label">Username Or Email</label>
                            <div class="input-group mb-5">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Username Or Email" id="username_email" name="username_email" autocomplete="off" data-kt-translate="sign-in-input-email">
                            </div>

                            <label for="password" class="form-label">Password</label>
                            <div class="input-group mb-5">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password" autocomplete="off" data-kt-translate="sign-in-input-password">
                            </div>

                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary mt-6" id="btnSubmit">
                                    <span class="indicator-label text-white">Masuk</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>