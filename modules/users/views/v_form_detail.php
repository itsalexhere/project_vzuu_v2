<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <div class="card">
                <div class="card-body">

                    <div class="d-flex flex-wrap flex-sm-nowrap align-items-center gap-4 h-100">

                        <!-- Avatar -->
                        <div class="symbol symbol-100px symbol-sm-10px symbol-fixed position-relative">
                            <img src="<?= base_url('assets/metronic/media/avatars/300-27.jpg') ?>"
                                alt="image"
                                class="rounded-circle"
                                style="object-fit: cover;">
                        </div>

                        <!-- Text -->
                        <div class="flex-grow-1 d-flex align-items-center h-100">
                            <div class="d-flex flex-column justify-content-center">

                                <div class="d-flex align-items-center">
                                    <span class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">Max Smith</span>
                                </div>

                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-0 pe-2">
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5">User ID 2821781</a>
                                    <a href="#" class="d-flex align-items-right text-gray-400 text-hover-primary me-5">User ID 2821781</a>
                                </div>

                            </div>
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
                        Permissions
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
                                <input type="hidden" id="id" name="id" value="<?= $detail->id ?? '' ?>" />

                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 ">Name</label>
                                    <input type="text" id="name" name="name" class="form-control mb-3 mb-lg-0" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 ">Email</label>
                                    <input type="text" id="email" name="email" class="form-control mb-3 mb-lg-0" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                </div>

                                <div class="fv-row mb-7 position-relative">
                                    <label class="required fw-semibold fs-6">Password</label>

                                    <input type="password"
                                        id="pass"
                                        name="pass"
                                        class="form-control pe-10"
                                        autocomplete="new-password" />

                                    <i class="fa fa-eye-slash icon-eye-custom" id="togglePass"></i>
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 ">Notes</label>
                                    <textarea type="text" id="notes" name="notes" class="form-control mb-3 mb-lg-0" data-type="input" autocomplete="off" /></textarea>
                                </div>
                            </div>

                            <div class="d-flex gap-2 flex-start mb-4">
                                <button class="btn btn-danger btn-sm fw-bold" type="button" id="save_form">
                                    <i class=" fa-solid fa-trash fs-4 me-2"></i> Delete User
                                </button>

                                <button class="btn btn-success btn-sm fw-bold" type="button" id="save_form">
                                    <i class=" fa-solid fa-save fs-4 me-2"></i> Edit Detail
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pill_permissions" role="tabpanel">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-6">

                                <h1 class="text-gray-400 fs-4 m-0">
                                    USER PERMISSIONS
                                </h1>

                                <button class="btn btn-success btn-sm fw-bold" type="button" id="save_form">
                                    <i class="fa-solid fa-save fs-4 me-2"></i> Save Changes
                                </button>

                            </div>

                            <table class="table table-row-bordered align-middle gy-4 gs-9" style=" border: 1px solid #E4E6EF; ">
                                <thead class="border-bottom border-gray-200 fs-6 fw-bold bg-light bg-opacity-100">
                                    <tr>
                                        <td class="min-w-150px">Date</td>
                                        <td class="min-w-250px">Description</td>
                                        <td class="min-w-150px">Amount</td>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">

                                    <tr>
                                        <td>Nov 01, 2020</td>
                                        <td>
                                            ksjksj
                                        </td>
                                        <td>$123.79</td>
                                    </tr>

                                    <tr>
                                        <td>Oct 08, 2020</td>
                                        <td>
                                            <select name="field_type[]" aria-label="Select Type" data-control="select2"
                                                data-placeholder="Choose Table" class="form-select form-select-lg fw-semibold"
                                                multiple>
                                                <option value="text">Text</option>
                                                <option value="textarea">Textarea</option>
                                                <option value="number">Number</option>
                                                <option value="date">Date</option>
                                                <option value="select2">Select2</option>
                                                <option value="checkbox">CheckBox</option>
                                                <option value="radio">Radio</option>
                                                <option value="file">File</option>
                                                <option value="email">Email</option>
                                                <option value="password">Password</option>
                                            </select>

                                        </td>
                                        <td>
                                            <select id="roleSelect" name="field_type[]" multiple data-control="select2" class="form-select form-select-lg fw-semibold">
                                                <option value="view">View</option>
                                                <option value="edit">Edit</option>
                                                <option value="delete">Delete</option>
                                                <option value="create">Create</option>
                                                <option value="export">Export</option>
                                                <option value="import">Import</option>
                                            </select>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Aug 24, 2020</td>
                                        <td>Paypal</td>
                                        <td>$35.07</td>
                                    </tr>

                                    <tr>
                                        <td>Jun 01, 2020</td>
                                        <td>
                                            <a href="#">Invoice for May 2023</a>
                                        </td>
                                        <td>$123.79</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-row-bordered align-middle gy-4 gs-9" style=" border: 1px solid #E4E6EF; ">
                                <thead class="border-bottom border-gray-200 fs-6 fw-bold bg-light bg-opacity-100">
                                    <tr>
                                        <td class="min-w-150px">Date</td>
                                        <td class="min-w-250px">Description</td>
                                        <td class="min-w-150px">Amount</td>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">

                                    <tr>
                                        <td>Nov 01, 2020</td>
                                        <td>
                                            ksjksj
                                        </td>
                                        <td>$123.79</td>
                                    </tr>

                                    <tr>
                                        <td>Oct 08, 2020</td>
                                        <td>
                                            <select name="field_type[]" aria-label="Select Type" data-control="select2"
                                                data-placeholder="Choose Field" class="form-select form-select-lg fw-semibold"
                                                multiple>
                                                <option value="text">Text</option>
                                                <option value="textarea">Textarea</option>
                                                <option value="number">Number</option>
                                                <option value="date">Date</option>
                                                <option value="select2">Select2</option>
                                                <option value="checkbox">CheckBox</option>
                                                <option value="radio">Radio</option>
                                                <option value="file">File</option>
                                                <option value="email">Email</option>
                                                <option value="password">Password</option>
                                            </select>

                                        </td>
                                        <td>
                                            <select id="roleSelects" name="field_type[]" multiple data-control="select2" class="form-select form-select-lg fw-semibold">
                                                <option value="view">View</option>
                                                <option value="edit">Edit</option>
                                                <option value="delete">Delete</option>
                                                <option value="create">Create</option>
                                                <option value="export">Export</option>
                                                <option value="import">Import</option>
                                            </select>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Aug 24, 2020</td>
                                        <td>Paypal</td>
                                        <td>$35.07</td>
                                    </tr>

                                    <tr>
                                        <td>Jun 01, 2020</td>
                                        <td>
                                            <a href="#">Invoice for May 2023</a>
                                        </td>
                                        <td>$123.79</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>