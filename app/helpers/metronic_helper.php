<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('clearInput')) {
	function clearInput($data)
	{
		$filter = trim(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
		return $filter;
	}
}

if (!function_exists('generateCode')) {
	function generateCode($length = 150)
	{
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	}
}

if (!function_exists('getInputCsrf')) {
	function getInputCsrf()
	{
		$ci = &get_instance();
		return "<input type=\"hidden\" name=\"{$ci->security->get_csrf_token_name()}\" value=\"{$ci->security->get_csrf_hash()}\" class=\"token_csrf\" data-name=\"{$ci->security->get_csrf_token_name()}\" style=\"display: none\">";
	}
}

if (!function_exists('pageError')) {
	function pageError()
	{
		redirect(BASE_URL . 'page/error', 'location');
	}
}

if (!function_exists('generateCsrf')) {
	function generateCsrf()
	{
		$ci = &get_instance();
		return $ci->security->get_csrf_hash();
	}
}

if (!function_exists('isAjaxRequestWithPost')) {
	function isAjaxRequestWithPost()
	{
		$ci = &get_instance();
		if (!$ci->input->is_ajax_request() && empty($ci->input->post())) {
			pageError();
			exit();
		}

		return $ci->output->set_content_type('application/json');
	}
}

if (!function_exists('isAjaxRequest')) {
	function isAjaxRequest()
	{
		$ci = &get_instance();
		if (!$ci->input->is_ajax_request()) {
			pageError();
			exit();
		}

		return $ci->output->set_content_type('application/json');
	}
}

if (!function_exists('controllerExist')) {
	function isControllerExist()
	{
		$ci = &get_instance();
		return $ci->router->class;
	}
}

if (!function_exists('pre')) {
	function pre($value)
	{
		echo "<pre>";
		print_r($value);
		echo "</pre>";
		exit();
	}
}

if (!function_exists('get_max_code')) {
	function get_max_code($table, $field)
	{
		$ci = &get_instance();

		$ci->db->select_max($field, 'code');
		$ci->db->from("$table");
		$ci->db->limit(1);

		$data = $ci->db->get()->row();

		return $data;
	}
}

function mkautononew($table, $field, $prefix)
{
	$code = get_max_code($table, $field);
	$_trans = date("Ymd");

	// Menghitung panjang prefix agar substr dapat secara dinamis
	$prefixLength = strlen($prefix . '/' . $_trans . '/');

	// Mengambil bagian urutan dari kode yang ada, atau 0 jika tidak ada
	$noUrut = (int) substr(!empty($code->code) ? $code->code : 0, $prefixLength, 5);

	// Jika tidak ada kode sebelumnya, mulai dari 1
	if ($noUrut == 0) {
		$noUrut = 1;
	} else {
		// Jika ada, tambahkan 1 pada nomor urut
		$noUrut++;
	}

	// Membuat kode baru
	$generateCode = $prefix . '/' . $_trans . '/' . sprintf("%05s", $noUrut);

	return $generateCode;
}



if (!function_exists('mkautono')) {
	function mkautono($table, $field, $prefix)
	{
		$code = get_max_code($table, $field);
		$_trans = date("Ymd");

		if (!empty($code->code)) {
			$noUrut = (int) substr($code->code, -5);
		} else {
			$noUrut = 0;
		}

		$noUrut++;
		$generateCode = $prefix . '/' . $_trans . '/' . sprintf("%05s", $noUrut);

		return $generateCode;
	}
}

if (!function_exists('generatenisauto')) {
	function generatenisauto($table, $field, $prefix)
	{
		$code = get_max_code($table, $field);

		$noUrut = (int) substr(!empty($code->code) ? $code->code : 0, 4, 4);

		$noUrut++;
		$generateCode = $prefix . sprintf("%04s", $noUrut);

		return $generateCode;
	}
}

function generateTableHtml($array = [], $tbody = [], $id = 'table-data')
{
	if (!is_array($array) || count($array) == 0) {
		return '';
	}

	$idTable = "id=\"{$id}\"";

	$html = "<table class=\"fluent-table\" {$idTable}>";

	$html .= "<thead>";
	$html .= '<tr>';

	for ($i = 0; $i < count($array); $i++) {
		$colName = strtolower($array[$i]);
		$headerText = $array[$i] != '' ? ucwords($array[$i]) : "";
		$html .= "<th>{$headerText}</th>";
	}

	$html .= '</tr>';
	$html .= '</thead>';

	$html .= '<tbody>';
	foreach ($tbody as $row) {
		$html .= '<tr>';
		for ($i = 0; $i < count($array); $i++) {
			$key = $array[$i];
			$value = isset($row[$key]) ? $row[$key] : '';
			$colName = strtolower($key);
			$tdClass = 'align-middle';
			if ($colName === 'actions') {
				$tdClass .= ' text-end';
			}
			$html .= "<td>{$value}</td>";
		}
		$html .= '</tr>';
	}
	$html .= '</tbody>';

	$html .= '</table>';
	$html .= '<ul id="custom-pagination" class="pagination pagination-outline mt-3" style="justify-content:end;"></ul></div>';

	return $html;
}


if (!function_exists('formValidationSelf')) {
	function formValidationSelf($title, $field, $param = "")
	{
		$lang['form_validation_required'] = "The {$field} field is required.";
		$lang["form_validation_isset"] = "The {$field} field must have a value.";
		$lang["form_validation_valid_email"] = "The {$field} field must contain a valid email address.";
		$lang["form_validation_valid_emails"] = "The {$field} field must contain all valid email addresses.";
		$lang["form_validation_valid_url"] = "The {$field} field must contain a valid URL.";
		$lang["form_validation_valid_ip"] = "The {$field} field must contain a valid IP.";
		$lang["form_validation_valid_base64"] = "The {$field} field must contain a valid Base64 string.";
		$lang["form_validation_min_length"] = "The {$field} field must be at least {$param} characters in length.";
		$lang["form_validation_max_length"] = "The {$field} field cannot exceed {$param} characters in length.";
		$lang["form_validation_exact_length"] = "The {$field} field must be exactly {$param} characters in length.";
		$lang["form_validation_alpha"] = "The {$field} field may only contain alphabetical characters.";
		$lang["form_validation_alpha_numeric"] = "The {$field} field may only contain alpha-numeric characters.";
		$lang["form_validation_alpha_numeric_spaces"] = "The {$field} field may only contain alpha-numeric characters and spaces.";
		$lang["form_validation_alpha_dash"] = "The {$field} field may only contain alpha-numeric characters, underscores, and dashes.";
		$lang["form_validation_numeric"] = "The {$field} field must contain only numbers.";
		$lang["form_validation_is_numeric"] = "The {$field} field must contain only numeric characters.";
		$lang["form_validation_integer"] = "The {$field} field must contain an integer.";
		$lang["form_validation_regex_match"] = "The {$field} field is not in the correct format.";
		$lang["form_validation_matches"] = "The {$field} field does not match the {$param} field.";
		$lang["form_validation_differs"] = "The {$field} field must differ from the {$param} field.";
		$lang["form_validation_is_unique"] = "The {$field} field must contain a unique value.";
		$lang["form_validation_is_natural"] = "The {$field} field must only contain digits.";
		$lang["form_validation_is_natural_no_zero"] = "The {$field} field must only contain digits and must be greater than zero.";
		$lang["form_validation_decimal"] = "The {$field} field must contain a decimal number.";
		$lang["form_validation_less_than"] = "The {$field} field must contain a number less than {$param}.";
		$lang["form_validation_less_than_equal_to"] = "The {$field} field must contain a number less than or equal to {$param}.";
		$lang["form_validation_greater_than"] = "The {$field} field must contain a number greater than {$param}.";
		$lang["form_validation_greater_than_equal_to"] = "The {$field} field must contain a number greater than or equal to {$param}.";
		$lang["form_validation_error_message_not_set"] = "Unable to access an error message corresponding to your field name {$field}.";
		$lang["form_validation_in_list"] = "The {$field} field must be one of: {$param}.";
		$lang['form_validation_found'] = "The {$field} field is not found.";
		$lang['form_validation_existexcel'] = "The {$field} field is already exist on table with different sequence.";
		$lang["form_validation_matchesexcel"] = "The {$field} field does not match the previous {$field} field in the same {$param}.";
		$lang['form_validation_foundparam'] = "The {$field} field is not found in {$param}.";
		$lang['form_validation_existdata'] = "The {$field} field is already exist.";
		$lang['form_validation_existdataexcel'] = "The {$field} field is already exist on the same sequence.";
		$lang['form_validation_existdatabase'] = "The {$field} field is already exist on data.";
		$lang['form_validation_existexceltable'] = "The {$field} field is already exist on table.";


		return showMessageErrorForm($lang[$title]);
	}
}

if (!function_exists('showMessageErrorForm')) {
	function showMessageErrorForm($text)
	{
		return "<div class=\"fv-plugins-message-container invalid-feedback\">{$text}</div>";
	}
}

if (!function_exists('uuid')) {
	function uuid()
	{
		if (function_exists('com_create_guid') === true)
			return trim(com_create_guid(), '{}');

		$data = openssl_random_pseudo_bytes(16);
		$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
		$data[8] = chr(ord($data[8]) & 0x3f | 0x80);
		return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}
}

if (!function_exists('upload_file')) {
	function upload_file($field_name, $upload_dir = 'assets/uploads')
	{
		if (!isset($_FILES[$field_name]) || $_FILES[$field_name]['error'] !== UPLOAD_ERR_OK) {
			return null;
		}

		$upload_path = rtrim(FCPATH . $upload_dir, '/');
		if (!is_dir($upload_path)) {
			if (!mkdir($upload_path, 0775, true)) {
				return null;
			}
		}

		$original_file_name = basename($_FILES[$field_name]['name']);
		$tmp_file = $_FILES[$field_name]['tmp_name'];

		$safe_file_name = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $original_file_name);

		$unique_file_name = '_' . $safe_file_name;
		$full_path = $upload_path . '/' . $unique_file_name;
		$path_url = $upload_dir . '/' . $unique_file_name;

		if (move_uploaded_file($tmp_file, $full_path)) {
			return $path_url;
		}

		return null;
	}
}

if (!function_exists('image_to_base64')) {
	function image_to_base64($image_path)
	{
		if (file_exists($image_path)) {
			$image_data = file_get_contents($image_path);
			if ($image_data !== false) {
				$base64_image = base64_encode($image_data);
				return 'data:image/jpeg;base64,' . $base64_image;
			}
		}
		return null;
	}
}
