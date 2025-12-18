<?php
defined('BASEPATH') or exit('No direct script access allowed');

$colorMap = [
    'success' => 'bg-success',
    'info'    => 'bg-info',
    'warning' => 'bg-warning',
    'danger'  => 'bg-danger',
];

$hasType = !empty($type) && array_key_exists($type, $colorMap);
$bulletColor = $hasType ? $colorMap[$type] : '';
?>

<a href="<?= $url ?? 'javascript:void(0)' ?>" class="notification-card text-decoration-none" data-id="<?= $id ?? '' ?>">

    <div class="d-flex align-items-center mb-6 notification-item overflow-hidden" style="border:1px solid #E4E6EF;border-radius:10px;">

        <span class="<?= $hasType ? 'bullet bullet-vertical':'' ?> d-flex align-items-center min-h-60px mh-100 me-4 <?= $bulletColor ?>"></span>

        <div class="d-flex align-items-center flex-grow-1 me-5">

            <div class="me-4 d-flex align-items-center">
                <i class="bi <?= $icon ?> fs-4"></i>
            </div>

            <div class="d-flex justify-content-between align-items-start flex-grow-1">

                <div>
                    <div class="text-gray-900 fw-semibold fs-5">
                        <?= $title ?? "" ?>
                    </div>
                    <div class="text-gray-500 fw-semibold fs-7">
                        <?= $message ?? "" ?>
                    </div>
                </div>

                <div class="text-end">
                    <div class="text-gray-600 fw-semibold fs-8">
                        <?= $date ?? "" ?>
                    </div>
                    <div class="text-gray-500 fw-semibold fs-7">
                        <?= $action_text ?? "" ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</a>