<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
	<base href="" />
	<title><?= $template['title'] ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="canonical" href="" />
	<link rel="shortcut icon" href="<?= $setting_profile['image'] ?? "" ?>" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<?php
	if (isset($pageCSS) && count($pageCSS) > 0) {
		for ($i = 0; $i < count($pageCSS); $i++) {
			$url = strtolower(substr($pageCSS[$i], 0, 4)) == 'http' ? $pageCSS[$i] : base_url() . '' . $pageCSS[$i];
			echo "<link rel=\"stylesheet\" href=\"" . $url . "\" />" . "\r\n\x20\x20\x20\x20";
		}
	}
	?>
	<link href="<?= PLUGINS ?>/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= CSS ?>/style.bundle.css" rel="stylesheet" type="text/css" />
</head>


<body id="kt_app_body" style="background-color: #F1F5F9;" data-kt-app-page-loading-enabled="true" data-kt-app-page-loading="on" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-sidebar-stacked="true" data-kt-app-sidebar-secondary-enabled="true" class="app-default">

	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			<?= isset($template['partials'][HEADER]) ? $template['partials'][HEADER] : '' ?>
			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

				<?= isset($template['partials'][SIDEBAR]) ? $template['partials'][SIDEBAR] : '' ?>

				<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
					<?= $template['body'] ?>

					<?= isset($template['partials'][FOOTER]) ? $template['partials'][FOOTER] : '' ?>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalLarge" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered mw-650px modal-dialog-scrollable">
			<!--begin::Modal content-->
			<div class="modal-content modal-rounded">

			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>
	<!--end::Modal - Add task-->

	<!--begin::Modal - Add task-->
	<div class="modal fade" id="modalLarge2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<!--begin::Modal content-->
			<div class="modal-content modal-rounded">

			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>
	<!--end::Modal - Add task-->

	<div class="modal fade" id="modalLarge3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-100 w-75 h-50">
			<!--begin::Modal content-->
			<div class="modal-content modal-rounded" style=" border: 3px solid #888;">

			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>

	<div class="modal fade" id="modalRight" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-end modal-full-height modal-dialog-scrollable">
			<div class="modal-content h-100 rounded-0" style="border: 3px solid #888;">
			</div>
		</div>
	</div>

	<script src="<?= PLUGINS ?>/global/plugins.bundle.js"></script>
	<script src="<?= JS ?>/scripts.bundle.js"></script>
	
	<?php
	if (isset($pageJS) && count($pageJS) > 0) {
		for ($i = 0; $i < count($pageJS); $i++) {
			$url = strtolower(substr($pageJS[$i], 0, 4)) == 'http' ? $pageJS[$i] : base_url() . '' . $pageJS[$i];
			echo "<script src=\"" . $url . "\" ></script>" . "\r\n\x20\x20\x20\x20";
		}
	}
	?>
	
	<?= "<script src=\"" . JS_GENERAL . "\" ></script>" . "\r\n\x20\x20\x20\x20"; ?>
	<?= (isset($js) ? '<script src="' . $js . '"></script>' : '') . "\r\n\x20\x20\x20\x20" ?>
</body>

</html>