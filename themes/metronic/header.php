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
								<strong class="fs-6">Alex</strong>
							</div>
						</div>

					</div>

					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<div class="menu-content d-flex align-items-center px-3">
								<!--begin::Avatar-->
								<div class="symbol symbol-50px me-5">
									<img alt="Logo" src="<?= MEDIA ?>/avatars/300-27.jpg" />
								</div>
								<!--end::Avatar-->
								<!--begin::Username-->
								<div class="d-flex flex-column">
									<div class="fw-bold d-flex align-items-center fs-5 fullname">
										<div class="d-flex flex-column">
											<div class="d-flex align-items-center">
												<a href="javascript:void()" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Alex</a>
												<a href="javascript:void()">
													<span class="svg-icon svg-icon-1 svg-icon-info">
														<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
															<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="currentColor"></path>
															<path d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
														</svg>
													</span>
												</a>
											</div>
										</div>
									</div>
									<a class="fw-semibold text-muted text-hover-primary fs-7 email_account">Jakarta</a>
								</div>
								<!--end::Username-->
							</div>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu separator-->
						<div class="separator my-2"></div>
						<!--end::Menu separator-->

						<!--begin::Menu item-->
						<div class="menu-item px-5 my-1">
							<a data-type="modal" id="btnAccount" data-fullscreenmodal="0" data-url="<?= $account_setting ?>" class="menu-link px-5">Account Settings</a>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu item-->
						<div class="menu-item px-5">
							<a href="<?= $logout_url ?>" class="menu-link px-5">Sign Out</a>
						</div>
						<!--end::Menu item-->
					</div>
				</div>
				<!--end::User menu-->
			</div>
			<!--end::Navbar-->
		</div>
	</div>
</div>