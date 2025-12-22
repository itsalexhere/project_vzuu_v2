<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <?= $c_views_header ?>

            <div class="card mt-6">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-start gap-2 gap-lg-3">
                            <?= $c_input_search ?? "" ?>
                            <?= $c_btn_filter ?? "" ?>
                        </div>

                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <?php if (!empty($right_button)): ?>
                                <?php foreach ($right_button as $button): ?>
                                    <?= $button ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                    </div>

                    <?= $tables ?>
                </div>
            </div>

        </div>
    </div>
</div>