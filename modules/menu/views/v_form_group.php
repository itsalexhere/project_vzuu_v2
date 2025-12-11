<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column scroll-y me-n7 pe-7">
    <input type="hidden" id="id" name="id" value="<?= $detail->id ?? '' ?>" />

    <div class="row">
        <div class="col-md-12">
            <div class="fv-row mb-7">
                <label class="required fw-semibold fs-6 mb-4">Nama Group</label>
                <input type="text" class="form-control mb-3 mb-lg-0" placeholder="Nama Menu" id="menu" name="menu" value="<?= $detail->name ?? '' ?>" data-type="input" autocomplete="off" />
            </div>
        </div>
    </div>

    <table class="table align-middle table-row-dashed fs-6 gy-5">
        <div class="row align-items-end">
            <div class="col-md-8 mb-3">
                <label class="fw-semibold fs-6 mb-2">Semua Menu</label>
            </div>

            <div class="col-md-4 mb-3 d-flex align-items-end justify-content-end ms-auto">
                <label class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                    <span class="form-check-label" for="kt_roles_select_all">Pilih Semua</span>
                </label>
            </div>
        </div>

        <hr style="border: none; border-top: 3px dashed #F5273C;">

        <tbody class="text-gray-600 fw-semibold" id="menuTableBody">
        </tbody>
    </table>
</div>