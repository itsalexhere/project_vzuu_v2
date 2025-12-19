<?php
defined('BASEPATH') or exit('No direct script access allowed');

$label    = isset($label) ? $label : null;
$name     = isset($name) ? $name : null;
$type     = isset($type) ? $type : 'text';
$value    = isset($value) ? $value : '';
$id       = isset($id) ? $id : $name;
$required = isset($required) ? (bool) $required : false;
?>

<div class="fv-row mb-3">
    <?php if (!empty($label)): ?>
        <label class="<?= !empty($required) ? 'required' : '' ?> fw-semibold fs-7 d-flex align-items-center gap-2 text-muted">
            <i class="bi <?= $icon ?? 'bi-info-circle' ?> fs-7" style="color: #2563EB;"></i>
            <?= htmlspecialchars($label, ENT_QUOTES) ?>
        </label>
    <?php endif; ?>

    <input
        type="<?= $type ?>"
        id="<?= $id ?>"
        name="<?= $name ?>"
        class="form-control form-control-plaintext editable-input"
        value="<?= htmlspecialchars($value, ENT_QUOTES) ?>"
        autocomplete="off" />
</div>