<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="kt_app_sidebar" class="app-sidebar" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
	<div class="app-sidebar-secondary">
		<div id="kt_app_sidebar_secondary_wrapper" class="hover-scroll-y" data-kt-scroll="true" data-kt-scroll-activate="{default: true, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_app_sidebar_secondary_menu, #kt_app_sidebar_secondary_tags" style="background-color: #ffff;" data-kt-scroll-offset="5px">
			<div class="app-sidebar-menu menu menu-sub-indention menu-rounded menu-column mt-6" id="kt_app_sidebar_secondary_menu" data-kt-menu="true">

				<?php 
					renderMenuByCategory($menu);

					foreach (getMenuCategories($menu) as $category) {
						$title = $categoryTitles[$category]
							?? ucwords(str_replace('_', ' ', $category));

						renderMenuSection($title);
						renderMenuByCategory($menu, $category);
					}
				?>
			</div>
		</div>
	</div>
</div>