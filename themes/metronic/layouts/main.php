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

	<div class="modal fade" id="modalLarge4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<!--begin::Modal content-->
			<div class="modal-content modal-rounded" style=" border: 2px solid #888;">

			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>

	<div class="modal fade" id="modalLarge5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered mw-650px modal-dialog-scrollable ">
			<!--begin::Modal content-->
			<div class="modal-content modal-rounded" style=" border: 3px solid #888;">

			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>

	<div class="modal fade" id="modalLarge6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<!--begin::Modal content-->
			<div class="modal-content modal-rounded">

			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>

	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
				<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<!--end::Scrolltop-->

	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="<?= PLUGINS ?>/global/plugins.bundle.js"></script>
	<script src="<?= JS ?>/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->

	<!--begin::Vendors Javascript(used for this page only)-->
	<?php
	//generate external js
	if (isset($pageJS) && count($pageJS) > 0) {
		for ($i = 0; $i < count($pageJS); $i++) {
			$url = strtolower(substr($pageJS[$i], 0, 4)) == 'http' ? $pageJS[$i] : base_url() . '' . $pageJS[$i];
			echo "<script src=\"" . $url . "\" ></script>" . "\r\n\x20\x20\x20\x20";
		}
	}
	?>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used for this page only)-->
	<?= "<script src=\"" . JS_GENERAL . "\" ></script>" . "\r\n\x20\x20\x20\x20"; ?>
	<!-- <?= "<script src=\"" . $jsType . "\" ></script>" . "\r\n\x20\x20\x20\x20"; ?> -->
	<?= (isset($js) ? '<script src="' . $js . '"></script>' : '') . "\r\n\x20\x20\x20\x20" ?>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>