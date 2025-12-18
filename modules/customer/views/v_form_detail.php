<?php
defined('BASEPATH') or exit('No direct script access allowed');

$details = json_decode($details, true);
?>

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

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
                                USER DETAIL
                            </h1>

                            <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                <input type="hidden" id="id" name="id" value="<?= $details['id'] ?? '' ?>" />

                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Gender',
                                            'name'  => 'gender',
                                            'value' => $details['gender'] == 'F' ? 'Female' : 'Men' ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Email',
                                            'name'  => 'email',
                                            'value' => $details['email'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Blood Type',
                                            'name'  => 'blood_type',
                                            'value' => $details['blood_type'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Category',
                                            'name'  => 'category',
                                            'value' => $details['category'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Address',
                                            'name'  => 'address',
                                            'value' => $details['address'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Emergency Contanct',
                                            'name'  => 'emergency_contact',
                                            'value' => $details['emergency_contact'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Date of Birth',
                                            'name'  => 'date_of_birth',
                                            'value' => $details['date_of_birth'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Skin Type',
                                            'name'  => 'skin_type',
                                            'value' => $details['skin_type'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Favorite Treatment',
                                            'name'  => 'favorite_treatments',
                                            'value' => $details['favorite_treatments'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Phone Number',
                                            'name'  => 'phone',
                                            'value' => $details['phone'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Allergies',
                                            'name'  => 'allergies',
                                            'value' => $details['allergies'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->load->view(PATH_COMPONENTS . 'input/input_borderless', [
                                            'label' => 'Notes',
                                            'name'  => 'note',
                                            'value' => $details['note'] ?? '-',
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 flex-start mb-4">
                                <button class="btn btn-danger btn-sm fw-bold" type="button" id="save_form">
                                    <i class=" fa-solid fa-trash fs-4 me-2"></i> Delete Customer
                                </button>

                                <button class="btn btn-success btn-sm fw-bold" type="button" id="save_form">
                                    <i class=" fa-solid fa-save fs-4 me-2"></i> Edit Detail
                                </button>


                                <button class="btn btn-warning btn-sm fw-bold" type="button" id="save_form">
                                    <i class=" fa-solid fa-save fs-4 me-2"></i> Export Customer Detail
                                </button>
                            </div>

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

        </div>
    </div>
</div>