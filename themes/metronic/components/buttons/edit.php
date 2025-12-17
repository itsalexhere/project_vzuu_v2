<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<button
    class="btn p-0 border-0 bg-transparent <?= $idLabel ?? "btnEdit" ?>"
    data-type="modal"
    data-title="<?= $title ?? "Edit Data" ?>"
    data-fullscreenmodal="0"
    data-url="<?= $url ?? "" ?>"
    data-id="<?= $id ?? "" ?>"
    title="Edit">
    <span class="svg-icon svg-icon-3">
        <i class="bi bi-pencil fs-4 me-2"></i>
    </span>
</button>