<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="modal-header py-2">
    <ul class="nav nav-scroll">
        <li class="nav-item">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 active profileInfo" data-bs-toggle="tab" href="#profile">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 tabPayment" data-bs-toggle="tab" href="#tab_payment">History SPP</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_7">Log Absensi</a>
        </li>
    </ul>
</div>

<div class="modal-body scroll-y">
    <form id="<?= $id_form ?>" data-url="<?= $url_form ?>" enctype="multipart/form-data">
        <?= $form ?>
    </form>
</div>

<div class="modal-footer py-2">
    <?= isset($buttonSave) && !$buttonSave ? "" : "<button class=\"btn btn-outline-success btn-sm fw-bold text-white me-2 ml-2\" style='background-color: #2BC217;' type=\"button\" id=\"" . (isset($buttonID) ? $buttonID : "btnProcessModal") . "\" " . (isset($buttonTypeSave) ? "data-type=\"{$buttonTypeSave}\"" : "") . ">" . (isset($buttonName) ? $buttonName : 'Simpan Data') . "</button>" ?>
    <button class="btn btn-outline-danger btn-sm fw-bold text-white me-2" style='background-color: #DC4114;' type="button" <?= (isset($buttonCloseID) ? "id=\"" . $buttonCloseID . "\"" : "id=\"btnCloseModal\"") ?>>Batal</button>
</div>