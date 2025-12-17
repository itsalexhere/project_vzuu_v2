<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="kt_app_footer" class="app-footer">
	<div class="app-container container-fluid  d-flex flex-column flex-md-row flex-center flex-md-stack py-3">

		<div class="text-dark order-2 order-md-1">
			<strong>
				<a href="javascript:void(0)" class="text-gray-800 text-hover-primary"><?= $setting_profile['name'] ?? "" ?></a>
				<span class="text-muted me-1">&copy;<?= date('Y') ?></span>
			</strong>
		</div>

	</div>
</div>