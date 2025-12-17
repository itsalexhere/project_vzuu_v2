<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<button class="btn btn-success btn-sm fw-bold"
        type="button"
        id="<?= $idLabel ?? "btnAdd" ?>"
        data-type="modal"
        data-url="<?= $url ?? "" ?>"
        data-fullscreenmodal="0">

    <i class="bi bi-plus-circle fs-4 me-2"></i>

    <?= $label ?? "Add" ?>
</button>