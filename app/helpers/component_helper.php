<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generateActionButtons')) {
    function generateActionButtons($id, $module_name, $options = [], $checkAccess = [])
    {
        $default_options = [
            'edit_confirm_text' => 'Data Akan Diubah ?',
            'delete_confirm_text' => 'Data Akan Dihapus ?',
            'edit_title' => 'Edit Data',
            'delete_title' => 'Hapus Data',
            'edit_fullscreen' => 0,
            'edit_bg_color' => '#A9D6E5',
            'delete_bg_color' => '#FADADD',
            'edit_font_size' => 'xx-small',
            'delete_font_size' => 'xx-small',
            'buttons' => ['edit', 'delete'],
        ];

        $opts = array_merge($default_options, $options);

        $canEdit   = $checkAccess['update'] ?? 0;
        $canDelete = $checkAccess['delete'] ?? 0;

        $button = '';

        // Edit Button
        if (in_array('edit', $opts['buttons']) && $canEdit == 1) {
            $button .= '
                        <button 
                            class="btn p-0 border-0 bg-transparent btnEdit" 
                            data-type="modal"
                            data-title="' . $opts['edit_title'] . '"
                            data-fullscreenmodal="' . $opts['edit_fullscreen'] . '"
                            data-url="' . base_url("{$module_name}/update/{$id}") . '" 
                            data-id="' . $id . '"
                            title="Edit">
                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" aria-label="Edit" data-bs-original-title="Edit" data-kt-initialized="1">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#217346" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                    </svg>
                                </span>
                            </span>
                        </button>';
        }

        // Delete Button
        if (in_array('delete', $opts['buttons']) && $canDelete == 1) {
            $button .= '
                        <button 
                            class="btn p-0 border-0 bg-transparent"
                            data-type="confirm"
                            data-title="' . $opts['delete_confirm_text'] . '"
                            data-url="' . base_url("{$module_name}/delete/{$id}") . '" 
                            data-id="' . $id . '"
                            data-title="Hapus">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#a4373a" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </span>
                        </button>';
        }

        return $button;
    }
}

if (!function_exists('searchActionButtons')) {
    function searchActionButtons()
    {
        $button = ' <div class="position-relative" style="max-width: 200px; width: 100%;">
                        <span class="position-absolute top-50 translate-middle-y ms-3">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text" id="search_table-data" name="search_table-data"
                            class="form-control" style="padding: 3px 30px !important;"
                            placeholder="Search" autocomplete="off" />
                    </div>';

        return $button;
    }
}

if (!function_exists('addButtonForm')) {
    function addButtonForm($insert_url, $titlePage = 'Data', $fullscreen = 0, $accessButton = 0)
    {
        if ((int)$accessButton === 0) {
            return '';
        }

        $button = '
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <button class="btn btn-success btn-sm fw-bold" type="button" id="btnAdd"
                data-type="modal"
                data-url="' . base_url($insert_url) . '"
                data-fullscreenmodal="' . $fullscreen . '">
                <i class="fa-solid fa-plus fs-4 me-2"></i>
                Tambah ' . $titlePage . '
            </button>
        </div>';

        return $button;
    }
}
