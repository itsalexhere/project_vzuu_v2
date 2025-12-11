<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('textInput')) {
    function textInput($name, $label, $placeholder = '', $value = '', $col = 6, $type = 'text', $isRequired = 1)
    {
        $requiredClass  = $isRequired == 1 ? 'required' : '';

        return "
            <div class=\"col-md-{$col}\">
                <div class=\"fv-row mb-6\">
                    <label class=\"{$requiredClass} fw-semibold fs-6\">{$label}</label>
                    <input 
                        type=\"{$type}\"
                        id=\"{$name}\"
                        name=\"{$name}\"
                        class=\"form-control mb-3 mb-lg-0\"
                        placeholder=\"{$placeholder}\"
                        value=\"{$value}\"
                        autocomplete=\"off\"
                    />
                </div>
            </div>";
    }
}

if (!function_exists('textareaInput')) {
    function textareaInput($name, $label, $placeholder = '', $value = '', $col = 6)
    {
        return "
        <div class=\"col-md-{$col}\">
            <div class=\"fv-row mb-6\">
                <label class=\"fw-semibold fs-6\">{$label}</label>
                <textarea 
                    name=\"{$name}\" 
                    class=\"form-control form-control-lg\" 
                    placeholder=\"{$placeholder}\"
                >{$value}</textarea>
            </div>
        </div>";
    }
}

if (!function_exists('selectInput')) {
    function selectInput($name, $label, $placeholder = '', $options = [], $value = '', $col = 6)
    {
        $htmlOptions = "<option value=\"\">{$placeholder}</option>";

        if (!empty($options)) {
            foreach ($options as $key => $text) {
                $selected = ($value == $key ? "selected" : "");
                $htmlOptions .= "<option value=\"{$key}\" {$selected}>{$text}</option>";
            }
        }

        return "
        <div class=\"col-md-{$col}\">
            <div class=\"fv-row mb-6\">
                <label class=\"fw-semibold fs-6\">{$label}</label>
                <select 
                    name=\"{$name}\"
                    data-control=\"select2\"
                    data-placeholder=\"{$placeholder}\"
                    class=\"form-select form-select-lg fw-semibold\"
                >
                    {$htmlOptions}
                </select>
            </div>
        </div>";
    }
}

if (!function_exists('generateFormFields')) {
    function generateFormFields($fields, $detail = null)
    {
        if (!is_object($detail)) {
            $detail = (object) $detail;
        }

        $html = "";
        $currentCol = 0;
        $rowOpen = false;

        foreach ($fields as $f) {

            $name        = strtolower($f['field_name']);
            $label       = ucfirst($f['field_name']);
            $type        = $f['field_type'];
            $isRequired  = $f['is_required'] ?? false;
            $placeholder = $f['placeholder'] ?? '';

            // Lebih robust: terima "3", "col-md-3" atau "md-3" dsb.
            $col = 12; // default
            if (!empty($f['column_type'])) {
                // ambil angka pertama yang muncul
                if (preg_match('/\d+/', $f['column_type'], $m)) {
                    $col = (int) $m[0];
                } else {
                    // jika memang numeric string
                    $col = (int) $f['column_type'];
                    if ($col <= 0) $col = 12;
                }
            }

            // Hindari nilai di luar range bootstrap grid
            if ($col < 1) $col = 12;
            if ($col > 12) $col = 12;

            // Ambil value dari detail kalau ada
            $value = property_exists($detail, $name) ? $detail->{$name} : '';

            // Jika full width: close/open row as needed then put single full row
            if ($col == 12) {
                if ($rowOpen) {
                    $html .= "</div>\n";
                    $rowOpen = false;
                    $currentCol = 0;
                }
                $html .= "<div class=\"row\">\n";
                $html .= generateSingleField($type, $name, $label, $placeholder, $value, 12, $f, $isRequired);
                $html .= "</div>\n";
                continue;
            }

            if (!$rowOpen) {
                $html .= "<div class=\"row\">\n";
                $rowOpen = true;
                $currentCol = 0;
            }

            if ($currentCol + $col > 12) {
                $html .= "</div>\n<div class=\"row\">\n";
                $currentCol = 0;
            }

            $html .= generateSingleField($type, $name, $label, $placeholder, $value, $col, $f, $isRequired);
            $currentCol += $col;

            if ($currentCol == 12) {
                $html .= "</div>\n";
                $rowOpen = false;
            }
        }

        if ($rowOpen) {
            $html .= "</div>\n";
        }

        return $html;
    }
}


if (!function_exists('generateSingleField')) {
    function generateSingleField($type, $name, $label, $placeholder, $value, $col, $f, $isRequired)
    {
        switch ($type) {
            case 'textarea':
                return textareaInput($name, $label, $placeholder, $value, $col);

            case 'select':
                $options = json_decode($f['options'] ?? '[]', true);
                return selectInput($name, $label, $placeholder, $options, $value, $col);

            default:
                return textInput($name, $label, $placeholder, $value, $col, $type, $isRequired);
        }
    }
}
