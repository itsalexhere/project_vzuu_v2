<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="modal-header">
    <h2 class="fw-bold"><?= $title_modal ?></h2>
</div>

<div class="modal-body scroll-y">
    <form id="<?= $id_form ?>" data-url="<?= $url_form ?>" enctype="multipart/form-data">
        <?= $form ?>
    </form>
</div>
<div class="modal-footer">
    <?= isset($buttonSave) && !$buttonSave ? "" : "<button class=\"btn btn-outline-success btn-sm fw-bold text-white me-2 ml-2\" style='background-color: #2BC217;' type=\"button\" id=\"" . (isset($buttonID) ? $buttonID : "btnProcessModal") . "\" " . (isset($buttonTypeSave) ? "data-type=\"{$buttonTypeSave}\"" : "") . ">" . (isset($buttonName) ? $buttonName : 'Simpan Data') . "</button>" ?>
    <button class="btn btn-outline-danger btn-sm fw-bold text-white me-2" style='background-color: #DC4114;' type="button" <?= (isset($buttonCloseID) ? "id=\"" . $buttonCloseID . "\"" : "id=\"btnCloseModal\"") ?>>Batal</button>
</div>
