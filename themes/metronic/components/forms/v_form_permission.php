<?php
defined('BASEPATH') or exit('No direct script access allowed');

$view = "<label class=\"form-check form-check-custom\">
			<input class=\"form-check-input view\" type=\"checkbox\" name=\"rolepermissions[{{kode}}][view]\" value=\"{{view}}\" data-type=\"checkbox\" data-count=\"{{Count}}\" data-id=\"{{id}}\" {{viewChecked}} {{viewDisabled}}/>
			<span class=\"form-check-label\">
				View
			</span>
		</label>";

$insert = "<label class=\"form-check form-check-custom\">
			<input class=\"form-check-input insert\" type=\"checkbox\" name=\"rolepermissions[{{kode}}][insert]\" value=\"{{insert}}\" data-type=\"checkbox\" data-count=\"{{Count}}\" data-id=\"{{id}}\" {{insertChecked}} {{insertDisabled}} />
			<span class=\"form-check-label\">
				Insert
			</span>
		</label>";

$update = "<label class=\"form-check form-check-custom\">
			<input class=\"form-check-input update\" type=\"checkbox\" name=\"rolepermissions[{{kode}}][update]\" value=\"{{update}}\" data-type=\"checkbox\" data-count=\"{{Count}}\" data-id=\"{{id}}\" {{updateChecked}} {{updateDisabled}} />
			<span class=\"form-check-label\">
				Update
			</span>
		</label>";

$delete = "<label class=\"form-check form-check-custom\">
			<input class=\"form-check-input delete\" type=\"checkbox\" name=\"rolepermissions[{{kode}}][delete]\" value=\"{{delete}}\" data-type=\"checkbox\" data-count=\"{{Count}}\" data-id=\"{{id}}\" {{deleteChecked}} {{deleteDisabled}} />
			<span class=\"form-check-label\">
				Delete
			</span>
		</label>";

$import = "<label class=\"form-check form-check-custom\">
			<input class=\"form-check-input import\" type=\"checkbox\" name=\"rolepermissions[{{kode}}][import]\" value=\"{{import}}\" data-type=\"checkbox\" data-count=\"{{Count}}\" data-id=\"{{id}}\" {{importChecked}} {{importDisabled}} />
			<span class=\"form-check-label\">
				Import
			</span>
		</label>";

$export = "<label class=\"form-check form-check-custom\">
			<input class=\"form-check-input export\" type=\"checkbox\" name=\"rolepermissions[{{kode}}][export]\" value=\"{{export}}\" data-type=\"checkbox\" data-count=\"{{Count}}\" data-id=\"{{id}}\" {{exportChecked}} {{exportDisabled}} />
			<span class=\"form-check-label\">
				Export
			</span>
		</label>";

$header = "<label class=\"form-check form-check-custom\">
			<input class=\"form-check-input header\" type=\"checkbox\" name=\"rolepermissions[{{kode}}][header]\" value=\"{{Count}}\" data-type=\"checkbox\" data-count=\"{{Count}}\" />
			<span class=\"form-check-label\">
				Select All
			</span>
		</label>";

$rowHeader = "<tr class=\"fw-bold fs-5 text-gray-800\" id=\"{{Count}}\" style=\"background-color:#F5CA60\">
				<th colspan=\"7\" style=\"text-align: center;vertical-align: middle;color: #1948CF;\">{{description}}</th>
			</tr>";

$rowTemplate = "<tr>
		<td class=\"fs-5\">
			<input type=\"hidden\" name=\"rolepermissions[{{kode}}][menu_id]\" value=\"{{id}}\">
			{{description}}
		</td>
		<td class=\"fs-5\">
			{$view}
		</td>
		<td class=\"fs-5\">
			{$insert}
		</td>
		<td class=\"fs-5\">
			{$update}
		</td>
		<td class=\"fs-5\">
			{$delete}
		</td>
		<td class=\"fs-5\">
			{$import}
		</td>
		<td class=\"fs-5\">
			{$export}
		</td>
	</tr>";

?>

<div class="py-5">
	<form id="form" data-url="<?= $url_form ?>">
		<div class="row mb-5 justify-content-end">
			<div class="col-6">
				<label for="exampleFormControlInput1" class="required form-label">Role Name</label>
				<input class="form-control" id="id" name="id" type="hidden" value="<?= isset($id) ? $id : "" ?>" />
				<input type="text" class="form-control" placeholder="example : Administrator" id="role_name" name="role_name" value="<?= isset($role_name) ? $role_name : "" ?>" data-type="input" />
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-row-dashed table-row-gray-300 gy-7">
				<thead>
					<h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-2 m-0 mb-6">
						List Menu Access
					</h1>
				</thead>
				<tbody>
					<?php
					$count = 1;
					$kode = 1;
					foreach ($data as $ky => $val) {
						$row = $rowHeader;
						$row = str_replace("{{description}}", strtoupper($val['menu_name']), $row);
						$row = str_replace("{{Count}}", $count, $row);
						$row = str_replace("{{kode}}", $kode, $row);
						echo $row;

						$rowDetail = '';
						if (empty($val['child'])) {
							$rowDetail = $rowTemplate;
							$rowDetail = str_replace("{{description}}", ucwords($val['menu_name']), $rowDetail);
							$rowDetail = str_replace("{{Count}}", $count, $rowDetail);
							$rowDetail = str_replace("{{kode}}", $kode, $rowDetail);
							$rowDetail = str_replace("{{id}}", $val['id'], $rowDetail);
							$rowDetail = str_replace("{{view}}", $val['view'], $rowDetail);
							$rowDetail = str_replace("{{viewChecked}}", (!empty($val['viewValue']) && $val['viewValue'] == 1 ? 'checked' : ''), $rowDetail);
							$rowDetail = str_replace("{{viewDisabled}}", ($val['view'] == 1 ? "" : "disabled"), $rowDetail);

							$rowDetail = str_replace("{{insert}}", $val['insert'], $rowDetail);
							$rowDetail = str_replace("{{insertChecked}}", (!empty($val['insertValue']) && $val['insertValue'] == 1 ? 'checked' : ""), $rowDetail);
							$rowDetail = str_replace("{{insertDisabled}}", ($val['insert'] == 1 ? "" : "disabled"), $rowDetail);

							$rowDetail = str_replace("{{update}}", $val['update'], $rowDetail);
							$rowDetail = str_replace("{{updateChecked}}", (!empty($val['updateValue']) && $val['updateValue'] == 1 ? 'checked' : ""), $rowDetail);
							$rowDetail = str_replace("{{updateDisabled}}", ($val['update'] == 1 ? "" : "disabled"), $rowDetail);

							$rowDetail = str_replace("{{delete}}", $val['delete'], $rowDetail);
							$rowDetail = str_replace("{{deleteChecked}}", (!empty($val['deleteValue']) && $val['deleteValue'] == 1 ? 'checked' : ""), $rowDetail);
							$rowDetail = str_replace("{{deleteDisabled}}", ($val['delete'] == 1 ? "" : "disabled"), $rowDetail);

							$rowDetail = str_replace("{{import}}", $val['import'], $rowDetail);
							$rowDetail = str_replace("{{importChecked}}", (!empty($val['importValue']) && $val['importValue'] == 1 ? 'checked' : ""), $rowDetail);
							$rowDetail = str_replace("{{importDisabled}}", ($val['import'] == 1 ? "" : "disabled"), $rowDetail);

							$rowDetail = str_replace("{{export}}", $val['export'], $rowDetail);
							$rowDetail = str_replace("{{exportChecked}}", (!empty($val['exportValue']) && $val['exportValue'] == 1 ? 'checked' : ""), $rowDetail);
							$rowDetail = str_replace("{{exportDisabled}}", ($val['export'] == 1 ? "" : "disabled"), $rowDetail);
							$kode++;
							echo $rowDetail;
						} else {
							foreach ($val['child'] as $kyChild => $valChild) {
								$rowDetail = $rowTemplate;
								$rowDetail = str_replace("{{description}}", ucwords($valChild['menu_name']), $rowDetail);
								$rowDetail = str_replace("{{Count}}", $count, $rowDetail);
								$rowDetail = str_replace("{{kode}}", $kode, $rowDetail);
								$rowDetail = str_replace("{{id}}", $valChild['id'], $rowDetail);
								$rowDetail = str_replace("{{view}}", $valChild['view'], $rowDetail);
								$rowDetail = str_replace("{{viewChecked}}", (!empty($valChild['viewValue']) && $valChild['viewValue'] == 1 ? 'checked' : ''), $rowDetail);
								$rowDetail = str_replace("{{viewDisabled}}", ($valChild['view'] == 1 ? "" : "disabled"), $rowDetail);

								$rowDetail = str_replace("{{insert}}", $valChild['insert'], $rowDetail);
								$rowDetail = str_replace("{{insertChecked}}", (!empty($valChild['insertValue']) && $valChild['insertValue'] == 1 ? 'checked' : ""), $rowDetail);
								$rowDetail = str_replace("{{insertDisabled}}", ($valChild['insert'] == 1 ? "" : "disabled"), $rowDetail);

								$rowDetail = str_replace("{{update}}", $valChild['update'], $rowDetail);
								$rowDetail = str_replace("{{updateChecked}}", (!empty($valChild['updateValue']) && $valChild['updateValue'] == 1 ? 'checked' : ""), $rowDetail);
								$rowDetail = str_replace("{{updateDisabled}}", ($valChild['update'] == 1 ? "" : "disabled"), $rowDetail);

								$rowDetail = str_replace("{{delete}}", $valChild['delete'], $rowDetail);
								$rowDetail = str_replace("{{deleteChecked}}", (!empty($valChild['deleteValue']) && $valChild['deleteValue'] == 1 ? 'checked' : ""), $rowDetail);
								$rowDetail = str_replace("{{deleteDisabled}}", ($valChild['delete'] == 1 ? "" : "disabled"), $rowDetail);

								$rowDetail = str_replace("{{import}}", $valChild['import'], $rowDetail);
								$rowDetail = str_replace("{{importChecked}}", (!empty($valChild['importValue']) && $valChild['importValue'] == 1 ? 'checked' : ""), $rowDetail);
								$rowDetail = str_replace("{{importDisabled}}", ($valChild['import'] == 1 ? "" : "disabled"), $rowDetail);

								$rowDetail = str_replace("{{export}}", $valChild['export'], $rowDetail);
								$rowDetail = str_replace("{{exportChecked}}", (!empty($valChild['exportValue']) && $valChild['exportValue'] == 1 ? 'checked' : ""), $rowDetail);
								$rowDetail = str_replace("{{exportDisabled}}", ($valChild['export'] == 1 ? "" : "disabled"), $rowDetail);
								$kode++;
								echo $rowDetail;
							}
						}

						$count++;
					}
					?>
				</tbody>
			</table>
		</div>
	</form>
</div>