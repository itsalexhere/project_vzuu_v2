<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- LEFT -->
                        <div class="d-flex align-items-center gap-4">

                            <div class="symbol symbol-60px symbol-fixed position-relative">
                                <img src="<?= base_url('assets/metronic/media/avatars/300-27.jpg') ?>"
                                    alt="image"
                                    class="rounded-circle"
                                    style="object-fit: cover;">
                            </div>

                            <div>
                                <div class="text-gray-900 fs-2 fw-bold">
                                    Mia Nadinn
                                </div>

                                <div class="fw-semibold fs-8 text-gray-400">
                                    User ID 123456
                                </div>
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="text-end">
                            <a href="#" class="fw-semibold fs-8 text-gray-400 text-hover-primary">
                                Joined 20/15/2026
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <ul class="nav nav-pills mb-5 fs-5 fw-bold mt-6" id="pillTab" role="tablist">
                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link active"
                        data-bs-toggle="pill"
                        data-bs-target="#pill_detail"
                        type="button"
                        role="tab">
                        Detail
                    </button>
                </li>

                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link"
                        data-bs-toggle="pill"
                        data-bs-target="#pill_permissions"
                        type="button"
                        role="tab">
                        Permissions
                    </button>
                </li>

            </ul>

            <div class="tab-content">

                <div class="tab-pane fade" id="pill_detail" role="tabpanel">
                    <div class="card">
                        <div class="card-body">

                            <h1 class="text-gray-400 fs-4 mb-6">
                                USER DETAIL
                            </h1>

                            <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                <input type="hidden" id="id" name="id" value="<?= $user_detail['id'] ?? '' ?>" />

                                <?= input_borderless([
                                    'label' => 'Name',
                                    'name'  => 'name',
                                    'type'  => 'text',
                                    'value' => $user_detail['username'] ?? '-',
                                ]);
                                ?>

                                <?= input_borderless([
                                    'label' => 'Email',
                                    'name'  => 'email',
                                    'type'  => 'text',
                                    'value' => $user_detail['email'] ?? '-',
                                ]);
                                ?>

                                <?= input_borderless([
                                    'label' => 'Password',
                                    'name'  => 'pass',
                                    'type'  => 'password',
                                    'value' => $user_detail['username'] ?? '-',
                                ]);
                                ?>

                                <?= input_borderless([
                                    'label' => 'Notes',
                                    'name'  => 'notes',
                                    'type'  => 'text',
                                    'value' => $user_detail['notes'] ?? '-',
                                ]);
                                ?>
                            </div>

                            <div class="d-flex gap-2 flex-start mb-4">
                                <button class="btn btn-danger btn-sm fw-bold" type="button" id="save_form">
                                    <i class=" fa-solid fa-trash fs-4 me-2"></i> Delete User
                                </button>

                                <button class="btn btn-success btn-sm fw-bold" type="button" id="save_form">
                                    <i class=" fa-solid fa-save fs-4 me-2"></i> Edit Detail
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show active" id="pill_permissions" role="tabpanel">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-6">

                                <h1 class="text-gray-400 fs-4 m-0">
                                    USER PERMISSIONS
                                </h1>

                                <button class="btn btn-success btn-sm fw-bold" type="button" id="save_form_access">
                                    <i class="fa-solid fa-save fs-4 me-2"></i> Save Changes
                                </button>

                            </div>

                            <table id="table-access-view" class="custom-table table-row-bordered mb-6">
                                <thead class="border-bottom border-gray-200 fs-6 fw-bold bg-light bg-opacity-100">
                                    <tr>
                                        <td class="min-w-30px">Menu Name</td>
                                        <td>Detail</td>
                                        <td class="min-w-50px">
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="enabled" checked disabled>
                                            </label>
                                        </td>
                                        <td class="min-w-50px">Role</td>
                                    </tr>
                                </thead>

                                <tbody class="fw-semibold text-gray-600">
                                    <?php
                                    $access = json_decode($list_access, true)['data'] ?? [];

                                    foreach ($access as $menu) {
                                        $fields = !empty($menu['access_view']) ? explode(',', $menu['access_view']) : [];

                                        $permissions = [];
                                        
                                        if (!empty($menu['view']) && $menu['view'] == 1) $permissions[] = 'View';
                                        if (!empty($menu['insert']) && $menu['insert'] == 1) $permissions[] = 'Create';
                                        if (!empty($menu['update']) && $menu['update'] == 1) $permissions[] = 'Edit';
                                        if (!empty($menu['delete']) && $menu['delete'] == 1) $permissions[] = 'Delete';
                                        if (!empty($menu['export']) && $menu['export'] == 1) $permissions[] = 'Export';
                                        if (!empty($menu['import']) && $menu['import'] == 1) $permissions[] = 'Import';

                                        $buttonLabel = !empty($permissions) ? implode(', ', $permissions) : 'Select option';
                                    ?>
                                        <tr>
                                            <input type="hidden" class="control-id" value="<?= $menu['id_access_control'] ?>" />
                                            <input type="hidden" class="view-id" value="<?= $menu['id_access_view'] ?>" />

                                            <td><?= $menu['name'] ?></td>
                                            <td>
                                                <div class="dropdown permission-dropdown">
                                                    <button
                                                        class="form-select text-start d-flex align-items-center justify-content-between permission-label"
                                                        type="button"
                                                        data-bs-toggle="dropdown"
                                                        data-bs-display="static"
                                                        aria-expanded="false" style="width: 550px;">
                                                        <?= empty($fields) ? 'No Fields' : 'Select Option' ?>
                                                    </button>

                                                    <ul class="dropdown-menu p-3" style="width: 550px;">
                                                        <?php foreach ($fields as $field): ?>
                                                            <li>
                                                                <div class="form-check">
                                                                    <input class="form-check-input"
                                                                        type="checkbox"
                                                                        value="<?= $field ?>"
                                                                        id="flexCheckDefault<?= $menu['id_access_control'] . '-' . $field ?>" />
                                                                    <label class="form-check-label fs-6" for="flexCheckDefault<?= $menu['id_access_control'] . '-' . $field ?>">
                                                                        <?= $field ?>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="enabled" <?= !empty($menu['status']) && $menu['status'] == 1 ? 'checked' : '' ?>>
                                                </label>
                                            </td>
                                            <td>
                                                <?php $menuId = $menu['id_access_control']; ?>

                                                <div class="dropdown permission-dropdown">
                                                    <button
                                                        class="form-select text-start d-flex align-items-center justify-content-between permission-label"
                                                        type="button"
                                                        data-bs-toggle="dropdown"
                                                        data-bs-display="static"
                                                        aria-expanded="false" style="width: 320px;">
                                                        <?= $buttonLabel ?>
                                                    </button>
                                                    <ul class="dropdown-menu p-3">
                                                        <?php
                                                        $permissions = ['View' => 'view', 'Edit' => 'update', 'Delete' => 'delete', 'Create' => 'insert', 'Export' => 'export', 'Import' => 'import'];
                                                        foreach ($permissions as $label => $field): ?>
                                                            <li>
                                                                <div class="form-check">
                                                                    <input class="form-check-input"
                                                                        type="checkbox"
                                                                        value="<?= $label ?>"
                                                                        id="<?= $field . $menuId ?>"
                                                                        <?= !empty($menu[$field]) && $menu[$field] == 1 ? 'checked' : '' ?> />
                                                                    <label class="form-check-label fs-6" for="<?= $field . $menuId ?>"><?= $label ?></label>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>