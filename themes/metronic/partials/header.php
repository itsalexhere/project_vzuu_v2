<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="kt_app_header" class="app-header">
	<div class="app-header-brand">
		<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
			<div class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
				<i class="bi bi-list fs-4 me-2"></i>
			</div>
		</div>

		<div class="app-sidebar-secondary-collapse-d-none text-dark d-flex align-items-center">
			<img alt="Logo" src="<?= base_url($setting_profile['image'] ?? "") ?>" class="h-25px me-2" />
			<strong class="fs-3"><?= $setting_profile['name'] ?? "" ?></strong>
		</div>
	</div>

	<div class="app-header-wrapper">

		<button id="kt_app_sidebar_secondary_toggle" class="btn btn-sm btn-icon btn-color-gray-400 btn-active-color-primary d-none d-lg-flex ms-2 rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-secondary-collapse">
			<i class="bi bi-list fs-4 me-2" style="color:#004578"></i>
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
									<?= ucfirst($this->session->userdata('username')) ?? "Admin" ?>
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
								<i class="bi bi-person fs-4 me-2"></i>
								Account Settings
							</a>
						</div>

						<div class="menu-item">
							<a href="<?= $logout_url ?>" class="menu-link d-flex align-items-center gap-3">
								<i class="bi bi-box-arrow-in-left fs-4 me-2"></i>
								Sign Out
							</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>