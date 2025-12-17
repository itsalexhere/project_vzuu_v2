<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="kt_app_header" class="app-header">
	<div class="app-header-brand">
		<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
			<div class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
				<span class="svg-icon svg-icon-2">
					<span class="svg-icon svg-icon-2 rotate-180">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#004578" class="bi bi-list" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
						</svg>
					</span>
				</span>
			</div>
		</div>

		<div class="app-sidebar-secondary-collapse-d-none text-dark d-flex align-items-center">
			<img alt="Logo" src="<?= base_url($setting_profile['image'] ?? "") ?>" class="h-30px me-2" />
			<strong class="fs-3"><?= $setting_profile['name'] ?? "" ?></strong>
		</div>
	</div>

	<div class="app-header-wrapper">

		<button id="kt_app_sidebar_secondary_toggle" class="btn btn-sm btn-icon btn-color-gray-400 btn-active-color-primary d-none d-lg-flex ms-2 rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-secondary-collapse">
			<span class="svg-icon svg-icon-2 rotate-180">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#004578" class="bi bi-list" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
				</svg>
			</span>
		</button>

		<div class="app-container container-fluid">
			<div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
				<h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
					<?= $titlePage ?? "" ?>
				</h1>
			</div>
			<!--begin::Navbar-->
			<div class="app-navbar flex-shrink-0">
				<!--begin::User menu-->
				<div class="app-navbar-item m-4">
					<div class="d-flex align-items-center">
						<div class="d-flex justify-content-start flex-column">
							<div class="d-flex">
								<span class="card-label fw-bold text-gray-800">

								</span>
							</div>
							<span class="text-gray-400 fw-semibold fs-7"></span>
						</div>
					</div>
				</div>
				<div class="app-navbar-item ms-1 ms-md-3">

					<div class="cursor-pointer symbol-30px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
						<div class="app-sidebar-secondary-collapse-d-none text-dark d-flex align-items-center">
							<img alt="logo" src="<?= MEDIA ?>/avatars/300-27.jpg" class="h-35px me-2 symbol symbol-circle" />

							<div class="company-text d-flex flex-column justify-content-center">
								<strong class="fs-6 d-flex align-items-center gap-3">
									Alex
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
										</svg>
									</span>
								</strong>
							</div>
						</div>

					</div>

					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-1 fs-6 w-275px" data-kt-menu="true">

						<div class="menu-item my-1">
							<a data-type="modal" id="btnAccount" data-fullscreenmodal="0" data-url="<?= $account_setting ?>" class="menu-link d-flex align-items-center gap-3">
								<span>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
										<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
									</svg>
								</span>
								Account Settings
							</a>
						</div>

						<div class="menu-item">
							<a href="<?= $logout_url ?>" class="menu-link d-flex align-items-center gap-3">
								<span>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
										<path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
									</svg>
								</span>
								Sign Out
							</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>