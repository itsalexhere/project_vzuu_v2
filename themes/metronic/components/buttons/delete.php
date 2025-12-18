<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<button
    class="btn p-0 border-0 bg-transparent"
    data-type="confirm"
    data-title="<?= $message ?? "Deleted Data" ?>"
    data-url="<?= $url ?? "" ?>"
    data-id="<?= $id ?>"
    data-title="Delete" 
    title="Delete">
    <i class="bi bi-trash fs-4 me-2" style="color:#a4373a;"></i>
</button>