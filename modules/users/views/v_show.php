<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column flex-column-fluid">

	<div id="kt_app_content" class="app-content flex-column-fluid">

		<div id="kt_app_content_container" class="app-container container-fluid">

			<div class="card">
				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center mb-3">
						<?= searchActionButtons(). addButtonForm('users/insert', 'Add User' , 0, 1,true) ?>
					</div>

					<?= $tables ?>
				</div>
			</div>
		</div>
	</div>

</div>