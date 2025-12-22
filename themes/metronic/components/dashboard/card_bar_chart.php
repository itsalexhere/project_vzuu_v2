<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="card card-flush h-100 p-4" style="border-radius: 5px;">
    <div class="d-flex justify-content-between align-items-center">
        <span class="fs-6 fw-bold text-gray-600"><?= $label_card_line ?? "" ?></span>

        <select class="form-select form-select-sm w-auto" aria-label="Default select example">
            <option>Year</option>
            <option>Daily</option>
            <option>Monthly</option>
            <option>Yearly</option>
            <option>Range Date</option>
        </select>
    </div>

    <div class="d-flex align-items-center">
        <canvas id="<?= $id_chart ?? "" ?>"></canvas>
    </div>
</div>