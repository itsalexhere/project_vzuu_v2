<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<button class="btn btn-success btn-sm fw-bold"
    type="button"
    id="<?= $idLabel ?? "btnExport" ?>"
    data-url="<?= $url ?? "" ?>">

    <i class="bi bi-cloud-download fs-4 me-2"></i>

    <?= $label ?? "Export" ?>
</button>