<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<button class="btn btn-success btn-sm fw-bold"
    type="button"
    id="<?= $idLabel ?? "btnImport" ?>"
    data-url="<?= $url ?? "" ?>">

    <i class="bi bi-cloud-upload fs-4 me-2"></i>

    <?= $labelImport ?? "Import" ?>
</button>