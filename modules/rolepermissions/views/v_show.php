<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column flex-column-fluid">

	<div id="kt_app_content" class="app-content flex-column-fluid">
		<div id="kt_app_content_container" class="app-container container-fluid">

			<div class="row mt-6">
				<div class="card shadow-sm">

					<div class="row mt-5">

						<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6" style="margin-bottom: -30px;">
							<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
								<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
									<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
										<?= $titlePage ?>
									</h1>
								</div>
							</div>
						</div>
					</div>

					<div class="card-body">
						<?= $table ?>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>