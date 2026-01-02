<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="card card-flush h-100 p-4" style="border-radius: 8px;">

    <div class="d-flex justify-content-between align-items-center">
        <span class="fs-6 fw-bold text-gray-600"><?= $label_card ?? "" ?></span>

        <select class="form-select form-select-sm w-auto" aria-label="Default select example">
            <option>1 Dec - 14 Dec</option>
            <option>This Month</option>
            <option>Last Month</option>
        </select>
    </div>

    <!-- BODY -->
    <div class="d-flex align-items-center mt-6">
        <span class="fs-1 fw-bolder text-gray-900"><?= $value_card ?? 0 ?></span>
    </div>
</div>