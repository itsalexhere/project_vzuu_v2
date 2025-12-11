<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column flex-column-fluid">

	<div id="kt_app_content" class="app-content flex-column-fluid">

		<div id="kt_app_content_container" class="app-container container-fluid">

			<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">

				<div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
					<h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
						<?= $titlePage ?>
					</h1>

					<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
						<li class="breadcrumb-item text-muted">
							<?= $parentMenu ?>
						</li>

						<li class="breadcrumb-item">
							<span class="bullet bg-gray-500 w-5px h-2px"></span>
						</li>

						<li class="breadcrumb-item text-muted"><?= $titlePage ?></li>
					</ul>
				</div>

				<div class="d-flex align-items-center gap-2 gap-lg-3">
					<button class="btn btn-success btn-sm fw-bold" type="button" id="btn_add" data-type="modal" data-url="<?= base_url('orders/applications') ?>" data-fullscreenmodal="0">
						<i class="fa-solid fa-plus fs-4 me-2"></i>
						Tambah <?= $titlePage ?>
					</button>
				</div>
			</div>

			<div class="row mt-6">
				<div class="card shadow-sm">
					<div class="card-body">
						<!-- Tabs -->
						<ul class="nav nav-tabs nav-line-tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link fw-bold fs-4 justify-content-center text-active-gray-800 active"
									data-bs-toggle="tab" href="#all_menu" aria-selected="true" role="tab">All</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link fw-bold fs-4 justify-content-center text-active-gray-800"
									data-bs-toggle="tab" href="#group_menu" aria-selected="false" role="tab">Group</a>
							</li>
						</ul>

						<!-- Tab Content -->
						<div class="tab-content mt-6">
							<div class="tab-pane fade show active" id="all_menu" role="tabpanel">
								<?= $tables ?>
							</div>

							<div class="tab-pane fade" id="group_menu" role="tabpanel">
								<div class="row g-10">
									<?php for ($i = 0; $i < 6; $i++) {
									?>
										<div class="col-xl-4">
											<div class="d-flex h-100 align-items-center">
												<!--begin::Option-->
												<div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
													<!--begin::Heading-->
													<div class="mb-7 text-center">
														<!--begin::Title-->
														<h1 class="text-dark mb-5 fw-bolder">Startup</h1>
														<!--end::Title-->
														<!--begin::Description-->
														<div class="text-gray-400 fw-semibold mb-5">Optimal for 10+ team size
															<br />and new startup
														</div>

													</div>

													<div class="w-100 mb-10">
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 10 Active Users</span>
															<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
															<span class="svg-icon svg-icon-1 svg-icon-success">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
																	<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 30 Project Integrations</span>
															<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
															<span class="svg-icon svg-icon-1 svg-icon-success">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
																	<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Analytics Module</span>
															<!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
															<span class="svg-icon svg-icon-1 svg-icon-success">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
																	<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<span class="fw-semibold fs-6 text-gray-400 flex-grow-1">Finance Module</span>
															<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
															<span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
																	<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor" />
																	<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<span class="fw-semibold fs-6 text-gray-400 flex-grow-1">Accounting Module</span>
															<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
															<span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
																	<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor" />
																	<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<span class="fw-semibold fs-6 text-gray-400 flex-grow-1">Network Platform</span>
															<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
															<span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
																	<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor" />
																	<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center">
															<span class="fw-semibold fs-6 text-gray-400 flex-grow-1">Unlimited Cloud Space</span>
															<!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
															<span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
																	<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor" />
																	<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</div>
														<!--end::Item-->
													</div>
													<!--end::Features-->
													<!--begin::Select-->
													<a href="#" class="btn btn-sm btn-primary">Select</a>
													<!--end::Select-->
												</div>
												<!--end::Option-->
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>