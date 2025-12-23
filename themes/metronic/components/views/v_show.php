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
                        <div class="d-flex align-items-start gap-2 gap-lg-3" style="white-space: nowrap;">
                            <?php if (!empty($left_button)): ?>
                                <?php foreach ($left_button as $button): ?>
                                    <?= $button ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <?php if (!empty($right_button)): ?>
                                <?php foreach ($right_button as $button): ?>
                                    <?= $button ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (!empty($pills)): ?>
                        <ul class="nav nav-pills mb-5 fs-5 fw-bold mt-6" id="pillTab" role="tablist">
                            <?php foreach ($pills as $pills): ?>
                                <?= $pills ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?= $tables ?>
                </div>
            </div>

        </div>
    </div>
</div>