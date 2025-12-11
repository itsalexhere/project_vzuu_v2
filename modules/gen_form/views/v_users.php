<?php
defined('BASEPATH') or exit('No direct script access allowed');

$list_users = json_decode($list_users, true) ?? [];
?>

<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_content" class="app-content flex-column-fluid">

        <table class="table table-row-dashed border-gray-300 align-middle gy-6">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th>Username</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody class="fs-6 fw-semibold">
                <?php foreach ($list_users['data'] as $res): ?>
                    <tr>
                        <td>
                            <input class="form-check-input" type="checkbox" id="perm_view_alex">
                        </td>
                        <td><?= $res['username'] ?></td>
                        <td><?= $res['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>

</div>