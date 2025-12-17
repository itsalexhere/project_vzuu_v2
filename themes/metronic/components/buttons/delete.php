<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<button
    class="btn p-0 border-0 bg-transparent"
    data-type="confirm"
    data-title="<?= $message ?? "Deleted Data" ?>"
    data-url="<?= $url ?? "" ?>"
    data-id="<?= $id ?>"
    data-title="Hapus">
    <span class="svg-icon svg-icon-3">
        <i class="bi bi-trash fs-4 me-2"></i>
    </span>
</button>