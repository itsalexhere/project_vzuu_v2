<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <ul class="nav nav-pills mb-5 fs-5 fw-bold" role="tablist">

                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link active"
                        data-bs-toggle="pill"
                        data-bs-target="#all_detail"
                        type="button"
                        role="tab">
                        All
                    </button>
                </li>

                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link"
                        data-bs-toggle="pill"
                        data-bs-target="#customer_detail"
                        type="button"
                        role="tab">
                        Customer
                    </button>
                </li>

                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link"
                        data-bs-toggle="pill"
                        data-bs-target="#treatment_detail"
                        type="button"
                        role="tab">
                        Treatment
                    </button>
                </li>

                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link"
                        data-bs-toggle="pill"
                        data-bs-target="#appointment_detail"
                        type="button"
                        role="tab">
                        Appointment
                    </button>
                </li>

                <li class="nav-item me-3" role="presentation">
                    <button class="nav-link"
                        data-bs-toggle="pill"
                        data-bs-target="#reminder_detail"
                        type="button"
                        role="tab">
                        Reminder
                    </button>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="all_detail" role="tabpanel">
                    <div class="card mt-6">
                        <div class="card-body">
                            <?php if (!empty($notifications)): ?>
                                <?php foreach ($notifications as $notif): ?>
                                    <?= $this->load->view(
                                        PATH_COMPONENTS . 'notifications/notification_card',
                                        $notif,
                                        true
                                    ); ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center text-gray-500">
                                    No notifications
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="customer_detail" role="tabpanel">
                    <div class="card mt-6">
                        <div class="card-body">
                            No Data
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade " id="treatment_detail" role="tabpanel">
                    <div class="card mt-6">
                        <div class="card-body">
                            No Data
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade " id="appointment_detail" role="tabpanel">
                    <div class="card mt-6">
                        <div class="card-body">
                            No Data
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade " id="reminder_detail" role="tabpanel">
                    <div class="card mt-6">
                        <div class="card-body">
                            No Data
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>