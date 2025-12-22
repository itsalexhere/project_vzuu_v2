<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="card card-flush h-100 p-4" style="border-radius: 5px;">
    <div class="d-flex justify-content-between align-items-center">
        <span class="fs-6 fw-bold text-gray-600"><?= $label_card_line ?? "" ?></span>

        <select class="form-select form-select-sm w-auto" aria-label="Default select example">
            <option>Year</option>
            <option>2026</option>
            <option>2025</option>
            <option>2024</option>
        </select>
    </div>

    <div class="d-flex align-items-center mb-2">
        <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2"><?= $value_card_line ?? 0 ?></span>

        <span class="badge badge-light-<?= $type_card_line ?? "success" ?> fs-base" style="border-radius: 20px;gap:5px">
            <i class="bi bi-<?= $type_card_line === "success" ? "arrow-up" : "arrow-down" ?> fs-8 text-<?= $type_card_line ?? "success" ?> ms-n1"></i>
            <?= $value_percentage_card_line ?? 0 ?> %
        </span>
    </div>

    <!-- BODY -->
    <div class="d-flex align-items-center mt-6">
        <canvas id="<?= $id_chart ?? "" ?>" class="mh-400px mt-6"></canvas>
    </div>
</div>