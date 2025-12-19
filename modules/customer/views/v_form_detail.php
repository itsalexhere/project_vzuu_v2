<?php
defined('BASEPATH') or exit('No direct script access allowed');

$details = json_decode($details, true);
?>

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form id="form" data-url="<?= $url_form ?>" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <!-- LEFT -->
                            <div class="d-flex align-items-center gap-4">

                                <div class="symbol symbol-60px symbol-fixed position-relative">
                                    <img src="<?= base_url('assets/metronic/media/avatars/300-27.jpg') ?>"
                                        alt="image"
                                        class="rounded-circle"
                                        style="object-fit: cover;">
                                </div>

                                <div>
                                    <div class="text-gray-900 fs-2 fw-bold">
                                        <?= $details['name'] ?? '' ?>
                                    </div>

                                    <div class="fw-semibold fs-8 text-gray-400">
                                        Customer ID <?= $details['id'] ?? '' ?>
                                    </div>
                                </div>

                            </div>

                            <!-- RIGHT -->
                            <div class="text-end">
                                <a href="#" class="fw-semibold fs-8 text-gray-400 text-hover-primary">
                                    Created 20/15/20026
                                </a>
                            </div>

                        </div>

                    </div>
                </div>

                <ul class="nav nav-pills mb-5 fs-5 fw-bold mt-6" id="pillTab" role="tablist">
                    <li class="nav-item me-3" role="presentation">
                        <button class="nav-link active"
                            data-bs-toggle="pill"
                            data-bs-target="#pill_detail"
                            type="button"
                            role="tab">
                            Detail
                        </button>
                    </li>

                    <li class="nav-item me-3" role="presentation">
                        <button class="nav-link"
                            data-bs-toggle="pill"
                            data-bs-target="#pill_permissions"
                            type="button"
                            role="tab">
                            Activity
                        </button>
                    </li>

                    <li class="nav-item me-3" role="presentation">
                        <button class="nav-link"
                            data-bs-toggle="pill"
                            data-bs-target="#pill_permissions"
                            type="button"
                            role="tab">
                            Follow Up
                        </button>
                    </li>

                </ul>

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="pill_detail" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                                <h1 class="text-gray-400 fs-4 mb-6">
                                    CUSTOMER DETAIL
                                </h1>

                                <form id="form" data-url="<?= $url_form ?>" enctype="multipart/form-data">

                                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                        <input type="hidden" id="id" name="id" value="<?= $details['id'] ?? '' ?>" />
                                        <input type="hidden" id="name" name="name" value="<?= $details['name'] ?? '' ?>" />

                                        <div class="row">
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Gender',
                                                    'name'  => 'gender',
                                                    'type'  => 'text',
                                                    'value' => $details['gender'] == 'F' ? 'Female' : 'Men' ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Email',
                                                    'name'  => 'email',
                                                    'type'  => 'text',
                                                    'value' => $details['email'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Blood Type',
                                                    'name'  => 'blood_type',
                                                    'type'  => 'text',
                                                    'value' => $details['blood_type'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Category',
                                                    'name'  => 'category',
                                                    'type'  => 'text',
                                                    'value' => $details['category'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Address',
                                                    'name'  => 'address',
                                                    'type'  => 'text',
                                                    'value' => $details['address'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Emergency Contanct',
                                                    'name'  => 'emergency_contact',
                                                    'type'  => 'text',
                                                    'value' => $details['emergency_contact'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Date of Birth',
                                                    'name'  => 'date_of_birth',
                                                    'type'  => 'date',
                                                    'value' => $details['date_of_birth'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Skin Type',
                                                    'name'  => 'skin_type',
                                                    'type'  => 'text',
                                                    'value' => $details['skin_type'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Favorite Treatment',
                                                    'name'  => 'favorite_treatments',
                                                    'type'  => 'text',
                                                    'value' => $details['favorite_treatments'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Phone Number',
                                                    'name'  => 'phone',
                                                    'type'  => 'text',
                                                    'value' => $details['phone'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Allergies',
                                                    'name'  => 'allergies',
                                                    'type'  => 'text',
                                                    'value' => $details['allergies'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= input_borderless([
                                                    'label' => 'Notes',
                                                    'name'  => 'note',
                                                    'type'  => 'text',
                                                    'value' => $details['note'] ?? '-',
                                                ]);
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 flex-start mb-4">
                                        <button class="btn btn-danger btn-sm fw-bold" type="button" id="delete_cust">
                                            <i class=" fa-solid fa-trash fs-4 me-2"></i> Delete Customer
                                        </button>

                                        <button class="btn btn-fluent btn-sm fw-semibold d-inline-flex align-items-center gap-2" type="button" id="edit_cust">
                                            <i class="fa-solid fa-pen-to-square fs-6 text-white"></i>
                                            Edit Detail
                                        </button>

                                        <button class="btn btn-warning btn-sm fw-bold" type="button" id="export_cust">
                                            <i class=" fa-solid fa-save fs-4 me-2"></i> Export Customer Detail
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="card mt-6">
                            <div class="card-body">

                                <h1 class="text-gray-400 fs-4 mb-6">
                                    DOCUMENT
                                </h1>

                                <div class="d-flex gap-2 flex-start mb-4">
                                    <button class="btn btn-danger btn-sm fw-bold" type="button" id="save_form">
                                        <i class="bi bi-cloud-upload fs-4 me-2"></i> Upload Document
                                    </button>
                                </div>

                                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                    <?= $table_doc ?>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<style>
    .btn-fluent {
        background-color: #2563EB;
        color: #FFFFFF;
        border: none;
        border-radius: 5px;
        padding: 0.45rem 0.9rem;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
        transition: all 0.2s ease;
    }

    .btn-fluent:hover {
        background-color: #1D4ED8;
        box-shadow: 0 6px 14px rgba(37, 99, 235, 0.35);
        transform: translateY(-1px);
        color: #FFFFFF;
    }

    .btn-fluent:active {
        background-color: #1E40AF;
        transform: translateY(0);
        box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);
    }

    .btn-fluent:focus {
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.35);
    }
</style>