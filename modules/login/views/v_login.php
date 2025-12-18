<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-5">

            <div class="card rounded-5" style="max-width: 450px;width: 100%;height: auto;">
                <div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
                    <form id="login" class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" action="#">
                        <div class="card-body shadow-lg rounded-3 p-10">

                            <div class="fv-row mb-5" id="alert-messages">
                            </div>

                            <div class="d-flex justify-content-center mb-12">
                                <img alt="Logo" draggable="false" src="<?= base_url() . $setting_profile['image'] ?? "" ?>" class="me-4" style="height: 40px; object-fit: contain;">

                                <h1 class="text-gray-900 fs-1 m-0" data-kt-translate="sign-in-title">
                                    <?= $setting_profile['name'] ?? "" ?>
                                </h1>
                            </div>

                            <div class="mb-5">
                                <label for="username_email" class="form-label">
                                    Email
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="username_email"
                                    name="username_email"
                                    placeholder="Username or Email"
                                    autocomplete="off"
                                    data-kt-translate="sign-in-input-email">
                            </div>


                            <div class="mb-5">
                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Password"
                                    autocomplete="off">
                            </div>


                            <div class="d-grid mt-10">
                                <button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">
                                    <span class="indicator-label text-white">Sign In</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>