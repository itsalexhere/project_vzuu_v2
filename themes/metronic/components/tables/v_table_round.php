<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!is_array($columns) || count($columns) == 0):
    return;
endif;
?>

<table class="custom-table" id="<?= $id ?? 'table-data' ?>">
    <thead>
        <tr>
            <?php foreach ($columns as $col): ?>
                <th><?= $col !== '' ? ucwords($col) : '' ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($tbody)): ?>
            <?php foreach ($tbody as $row): ?>
                <tr>
                    <?php foreach ($columns as $key): ?>
                        <?php
                        $colName = strtolower($key);
                        $tdClass = 'align-middle';
                        if ($colName === 'actions') {
                            $tdClass .= ' text-end';
                        }
                        ?>
                        <td class="<?= $tdClass ?>">
                            <?= $row[$key] ?? '' ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
    <div class="d-flex align-items-center gap-2">
        <span class="text-muted fs-7">Items per page</span>

        <select id="dt-length" class="dt-length-select text-muted" style="border: 1px solid #E4E6EF;border-radius: 5px;">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
        </select>

        <span id="dt-info" class="text-muted fs-7"></span>
    </div>


    <ul id="custom-pagination"
        class="pagination pagination-outline mb-0"
        style="justify-content:end;">
    </ul>
</div>