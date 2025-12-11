<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

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