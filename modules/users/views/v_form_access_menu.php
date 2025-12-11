<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="fv-row">
    <div class="table-responsive">
        <input type="hidden" value="<?= $user_id ?>" name="user_id" id="user_id">

        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <div class="row align-items-end">
                <div class="col-md-8 mb-3">
                    <label class="fw-semibold fs-6 mb-2">Cari</label>
                    <div class="position-relative">
                        <input type="text" id="nama_menu" class="form-control pe-5" placeholder="Nama Menu"
                            style="height: 35px; font-size: 0.875rem;">
                        <span id="clearNamaMenu"
                            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 16px; color: #aaa;">
                            &times;
                        </span>
                    </div>
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
</div>