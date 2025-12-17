<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<button class="btn btn-success btn-sm fw-bold"
    type="button"
    id="<?= $idLabel ?? "btnSide" ?>"
    data-type="modal"
    data-url="<?= $url ?? "" ?>">

    <i class="bi bi-funnel fs-4 me-2"></i>

    <?= $label ?? "Filter" ?>
</button>