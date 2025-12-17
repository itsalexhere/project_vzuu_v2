<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="modal-header p-2">
    <h5 class="modal-title">Form</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body scroll-y">
    <form id="form" data-url="<?= $url_form ?>" enctype="multipart/form-data">
        <?= $form ?>
    </form>
</div>

<div class="modal-footer p-1 d-flex justify-content-between">
    <div>
        <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                </svg>
            </span>
            Reset
        </button>
    </div>

    <div>
        <button type="button" class="btn btn-success btn-sm fw-bold" data-bs-dismiss="modal">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                </svg>
            </span>
            Apply
        </button>
    </div>
</div>