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
			</div>

			<div class="card mt-6">
				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center mb-3">

						<?= searchActionButtons() ?>

						<div class="d-flex align-items-center gap-2 gap-lg-3">
							<button class="btn btn-success btn-sm fw-bold" type="button" id="btnAdd" data-url="<?= base_url('users/insert') ?>">
								<i class="fa-solid fa-plus fs-4 me-2"></i>
								Tambah <?= $titlePage ?>
							</button>
						</div>
					</div>

					<?= $tables ?>
				</div>
			</div>
		</div>
	</div>

</div>