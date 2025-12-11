<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_content" class="app-content flex-column-fluid">

        <form id="form_fields" data-url="gen_form/process" enctype="multipart/form-data">
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

                <div class="row mt-6">
                    <div class="card shadow-sm p-3" style="margin-right:10px;">

                        <div class="d-flex gap-2 flex-end mb-4">
                            <a href="#"
                                onclick="history.back();
                                            let formId = localStorage.getItem('form_uuid');
                                            let storageKey = 'form_fields_' + formId;
                                            localStorage.removeItem(storageKey);
                                            localStorage.removeItem('form_uuid');"
                                class="btn btn-danger btn-sm fw-bold text-white">
                                <i class="fas fa-arrow-left text-white me-1"></i> Back
                            </a>

                            <button class="btn btn-success btn-sm fw-bold" type="button" id="save_form">
                                <i class=" fa-solid fa-save fs-4 me-2"></i> Save
                            </button>
                        </div>

                        <div class="tab-content flex-grow-1" id="myTabContent">
                            <div class="tab-pane fade show active" id="kt_vtab_pane_1" role="tabpanel">

                                <div class="card-body border-top">
                                    <div class="row mb-2">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Form Name</label>

                                        <div class="col-lg-8">
                                            <div class="fv-row fv-plugins-icon-container">
                                                <input type="text" id="name" name="name" class="form-control mb-3 mb-lg-0" placeholder="Form Name" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Type Form</label>
                                        <div class="col-lg-8 fv-row">
                                            <div class="d-flex align-items-center mt-3">
                                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                                    <input class="form-check-input" name="form_type" type="radio" value="Form" checked />
                                                    <span class="fw-semibold ps-2 fs-6">Form</span>
                                                </label>
                                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                                    <input class="form-check-input" name="form_type" type="radio" value="Report" />
                                                    <span class="fw-semibold ps-2 fs-6">Report</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Status</label>

                                        <div class="col-lg-8">
                                            <div class="fv-row fv-plugins-icon-container">
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input"
                                                        type="checkbox"
                                                        name="status"
                                                        id="status"
                                                        value="enabled"
                                                        data-target="#status-text"
                                                        data-checked="Yes"
                                                        data-unchecked="No"

                                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'checked' : '' ?>>

                                                    <span id="status-text" class="ms-2">
                                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'Yes' : 'No' ?>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="field_create_table" class="row mb-1">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Create Table</label>

                                        <div class="col-lg-8">
                                            <div class="fv-row fv-plugins-icon-container">
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input"
                                                        type="checkbox"
                                                        name="status-table"
                                                        id="status-table"
                                                        value="enabled"
                                                        data-target="#status_table"
                                                        data-checked="Yes"
                                                        data-unchecked="No"

                                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'checked' : '' ?>>

                                                    <span id="status_table" class="ms-2">
                                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'Yes' : 'No' ?>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="field_create_menu" class="row mb-1">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Create Menu</label>

                                        <div class="col-lg-8">
                                            <div class="fv-row fv-plugins-icon-container">
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input"
                                                        type="checkbox"
                                                        name="status-menu"
                                                        id="status-menu"
                                                        value="enabled"
                                                        data-target="#status_menu"
                                                        data-checked="Yes"
                                                        data-unchecked="No"

                                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'checked' : '' ?>>

                                                    <span id="status_menu" class="ms-2">
                                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'Yes' : 'No' ?>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1" id="row_parent">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Parent</label>

                                        <div class="col-lg-8">
                                            <div class="fv-row fv-plugins-icon-container">
                                                <select name="parent" name="parent" aria-label="Select Type" data-control="select2" data-placeholder="Choose Table" class="form-select form-select-lg fw-semibold">
                                                    <option value="">Choose Parent</option>
                                                    <?php foreach ($list_menu as $value) { ?>
                                                        <option value="<?= $value->id ?>" <?= (isset($detail) && $detail->parent == $value->id) ? 'selected' : '' ?>>
                                                            <?= $value->name ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1" id="row_table_name">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Table Name</label>

                                        <div class="col-lg-8">
                                            <div class="fv-row fv-plugins-icon-container">
                                                <input type="text" id="table_name" name="table_name" class="form-control mb-3 mb-lg-0" placeholder="Table Name" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1" id="row_list_table" style="display: none;">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">List Table</label>

                                        <div class="col-lg-8">
                                            <div class="fv-row fv-plugins-icon-container">
                                                <select name="table_list_name" name="table_list_name" aria-label="Select Type" data-control="select2" data-placeholder="Choose Table" class="form-select form-select-lg fw-semibold">
                                                    <option value="">Choose Table</option>
                                                    <?php
                                                    foreach ($list_table as $table) { ?>
                                                        <option value="<?= $table ?>"><?= $table ?></option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Description</label>

                                        <div class="col-lg-8">
                                            <div class="fv-row fv-plugins-icon-container">
                                                <input type="text" id="description" name="description" class="form-control mb-3 mb-lg-0" placeholder="Description" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="fields_table" class="card shadow-sm p-6 mt-6" style="margin-right:10px;">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 mb-6"
                            style="border-bottom: 1px solid #ccc; padding-bottom: 6px;">
                            Form Fields
                        </h1>

                        <div class="row mb-6">
                            <div class="col-md-3">
                                <label class="required fw-semibold fs-6">Label</label>
                                <input type="text" id="field_label" name="field_label" class="form-control mb-3 mb-lg-0"
                                    placeholder="Label" data-type="input" autocomplete="off" />
                            </div>

                            <div class="col-md-2">
                                <label class="required fw-semibold fs-6">Type</label>

                                <select name="field_type" aria-label="Select Type" data-control="select2"
                                    data-placeholder="Choose Table" class="form-select form-select-lg fw-semibold">
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
                            </div>

                            <div class="col-md-2">
                                <label class="required fw-semibold fs-6">Size</label>

                                <select name="column_type" aria-label="Select Column" data-control="select2"
                                    data-placeholder="Choose Table" class="form-select form-select-lg fw-semibold">
                                    <option value="col-md-3">col-md-3</option>
                                    <option value="col-md-4">col-md-4</option>
                                    <option value="col-md-6">col-md-6</option>
                                    <option value="col-md-8">col-md-8</option>
                                    <option value="col-md-12">col-md-12</option>
                                </select>
                            </div>

                            <div class="col-md-1">
                                <label class="fw-semibold fs-6">Required</label>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="required"
                                        id="required"
                                        value="enabled"
                                        data-target="#status-required"
                                        data-checked="Yes"
                                        data-unchecked="No"

                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'checked' : '' ?>>

                                    <span id="status-required" class="ms-2">
                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'Yes' : 'No' ?>
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-1">
                                <label class="fw-semibold fs-6">Status</label>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="status-field"
                                        id="status-field"
                                        value="enabled"
                                        data-target="#status-text-field"
                                        data-checked="Yes"
                                        data-unchecked="No"

                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'checked' : '' ?>>

                                    <span id="status-text-field" class="ms-2">
                                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'Yes' : 'No' ?>
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="fw-semibold fs-6"></label><br>
                                <button class="btn p-0 border-0 bg-transparent" type="button" id="add_field">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#b7472a" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                </button>
                            </div>

                        </div>

                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 mb-6"
                            style="border-bottom: 1px solid #ccc; padding-bottom: 6px;">
                            List Form Fields
                        </h1>

                        <div class="d-flex flex-column scroll-y me-n7 pe-7">

                            <table id="fields_table" class="table align-middle table-row-dashed table-striped table-hover table-row-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Label</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Placeholder</th>
                                        <th>Column</th>
                                        <th>Required</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                    </div>

                    <div id="fields_raw_sql" class="card shadow-sm p-6 mt-6" style="margin-right:10px;">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 mb-6"
                            style="border-bottom: 1px solid #ccc; padding-bottom: 6px;">
                            Raw SQL
                        </h1>

                        <div class="d-flex flex-column scroll-y me-n7 pe-7">
                            <textarea type="text" id="raw_sql" name="raw_sql" class="form-control mb-3 mb-lg-0" data-type="input" autocomplete="off" style="height: 300px;"></textarea>
                        </div>
                    </div>

                </div>

            </div>
        </form>

    </div>

</div>