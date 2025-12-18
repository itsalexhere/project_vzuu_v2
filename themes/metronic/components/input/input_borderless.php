<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="fv-row mb-3">
    <?php if (!empty($label)): ?>
        <label class="<?= !empty($required) ? 'required' : '' ?> fw-semibold fs-6">
            <?= $label ?>
        </label>
    <?php endif; ?>

    <input
        type="text"
        id="<?= $id ?? $name ?>"
        name="<?= $name ?>"
        class="form-control form-control-plaintext editable-input"
        value="<?= htmlspecialchars($value ?? '', ENT_QUOTES) ?>"
        autocomplete="off" />
</div>

<style>
    .editable-input {
        border: none !important;
        background: transparent;
        padding-left: 0;
        padding-right: 0;
        box-shadow: none !important;
        font-weight: 500;
        color: #181c32;
    }

    .editable-input:focus {
        outline: none;
        border-bottom: 1px solid #0078d4;
        background: transparent;
    }
</style>