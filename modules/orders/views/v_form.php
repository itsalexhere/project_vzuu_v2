<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column scroll-y me-n7 pe-7">
    <input type="hidden" id="id" name="id" value="<?= $detail->id ?? '' ?>" />

    <div class="row">
        <div class="col-md-6">
            <div class="fv-row mb-7">
                <label class="required fw-semibold fs-6 mb-4">Controller</label>
                <input type="text" id="controller" name="controller" class="form-control mb-3 mb-lg-0" placeholder="Nama Controller" value="<?= $detail->controller ?? '' ?>" data-type="input" autocomplete="off" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="fv-row mb-7">
                <label class="required fw-semibold fs-6 mb-4">Menu</label>
                <input type="text" class="form-control mb-3 mb-lg-0" placeholder="Nama Menu" id="menu" name="menu" value="<?= $detail->name ?? '' ?>" data-type="input" autocomplete="off" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-4">Parent</label>
                <select class="form-select" data-control="select2" data-placeholder="Select an option" id="parent" name="parent">
                    <option value="0" <?= (isset($detail) && $detail->parent == 0) ? 'selected' : '' ?>></option>
                    <?php foreach ($list_menu as $value) { ?>
                        <option value="<?= $value->id ?>" <?= (isset($detail) && $detail->parent == $value->id) ? 'selected' : '' ?>>
                            <?= $value->name ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="fv-row mb-7">
                <label class="fw-semibold fs-6 mb-4">Icon</label>
                <input type="text" class="form-control mb-3 mb-lg-0" placeholder="" id="icon" name="icon" value="<?= $detail->icon ?? '' ?>" data-type="input" autocomplete="off" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="fv-row mb-7">
                <label class="fw-semibold fs-6 mb-4">Status</label>
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="enabled"
                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'checked="checked"' : '' ?>
                        name="status" id="status">
                    <span id="status-text" class="ms-2">
                        <?= (!isset($detail) || (isset($detail) && $detail->status == 1)) ? 'Aktif' : 'Tidak Aktif' ?>
                    </span>
                </label>
            </div>

        </div>
    </div>
</div>