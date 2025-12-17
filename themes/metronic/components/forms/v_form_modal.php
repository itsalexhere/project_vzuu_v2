<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="modal-header p-2">
    <h2 class="fw-bold px-3"><?= $title_modal ?></h2>

    <button class="btn p-0 border-0 bg-transparent" type="button" <?= (isset($buttonCloseID) ? "id=\"" . $buttonCloseID . "\"" : "id=\"btnCloseModal\"") ?>>
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#a4373a" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
        </svg>
    </button>
</div>

<div class="modal-body scroll-y">
    <form id="form" data-url="<?= $url_form ?>" enctype="multipart/form-data">
        <?= $form ?>
    </form>
</div>
<div class="modal-footer p-1">
    <?= isset($buttonSave) && !$buttonSave ? "" :
        "<button class=\"btn btn-success btn-sm fw-bold text-white me-2 ml-2 \" type=\"button\" id=\"" .
        (isset($buttonID) ? $buttonID : "btnProcessModal") . "\" " .
        (isset($buttonTypeSave) ? "data-type=\"{$buttonTypeSave}\"" : "") . ">" .
        '<span class="me-2"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                <path d="M11 2H9v3h2z"/>
                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
            </svg> 
        </span>' . (isset($buttonName) ? $buttonName : 'Save') .
        "</button>"
    ?>
</div>