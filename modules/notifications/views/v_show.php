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

                            <div class="d-flex align-items-center mb-6" style="border:1px solid #E4E6EF;border-radius: 10px;">

                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-60px mh-100 me-4 bg-success"></span>

                                <div class="d-flex align-items-center flex-grow-1 me-5">

                                    <!-- ICON -->
                                    <div class="me-4 d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                        </svg>
                                    </div>

                                    <!-- CONTENT -->
                                    <div class="d-flex justify-content-between align-items-start flex-grow-1">

                                        <!-- LEFT -->
                                        <div>
                                            <div class="text-gray-900 fw-semibold fs-5">
                                                Customer Birthday!
                                            </div>
                                            <div class="text-gray-500 fw-semibold fs-7">
                                                Today is Novia's birthday! Send a birthday message.
                                            </div>
                                        </div>

                                        <!-- RIGHT -->
                                        <div class="text-end">
                                            <div class="text-gray-600 fw-semibold fs-6">
                                                12/11/2025
                                            </div>
                                            <div class="text-gray-500 fw-semibold fs-7">
                                                Mark as Read
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="d-flex align-items-center mb-6" style="border:1px solid #E4E6EF;border-radius: 10px;">

                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-60px mh-100 me-4 bg-success"></span>

                                <div class="d-flex align-items-center flex-grow-1 me-5">

                                    <div class="me-4 d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <div class="text-gray-900 fw-semibold fs-5">
                                            Upcoming Appoinment
                                        </div>
                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Novia has scheduled Appointment #1958925825236 on 12/11/2025 11:00
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-6" style="border:1px solid #E4E6EF;border-radius: 10px;">

                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-60px mh-100 me-4 bg-success"></span>

                                <div class="d-flex align-items-center flex-grow-1 me-5">

                                    <div class="me-4 d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <div class="text-gray-900 fw-semibold fs-5">
                                            Late Treatment...
                                        </div>
                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Novia is late treatment for 3 days.Remind or schedule appointment now.
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-6" style="border:1px solid #E4E6EF;border-radius: 10px;">

                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-60px mh-100 me-4 bg-success"></span>

                                <div class="d-flex align-items-center flex-grow-1 me-5">

                                    <div class="me-4 d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <div class="text-gray-900 fw-semibold fs-5">
                                            No Scheduled Treatment
                                        </div>
                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Novia has not scheduled Appoitment #5328725745 on 12/11/2025 13:00
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-6" style="border:1px solid #E4E6EF;border-radius: 10px;">

                                <span data-kt-element="bullet" class="d-flex align-items-center min-h-60px mh-100 me-4 bg-success"></span>

                                <div class="d-flex align-items-center flex-grow-1 me-5">

                                    <div class="me-4 d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <div class="text-gray-900 fw-semibold fs-5">
                                            Upcoming Appoinment
                                        </div>
                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Dinda's has scheduled Appoitment #5328725745 on 12/11/2025 13:00
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-6" style="border:1px solid #E4E6EF;border-radius: 10px;">

                                <span data-kt-element="bullet" class="d-flex align-items-center min-h-60px mh-100 me-4 bg-success"></span>

                                <div class="d-flex align-items-center flex-grow-1 me-5">

                                    <div class="me-4 d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <div class="text-gray-900 fw-semibold fs-5">
                                            Customer Birthday!
                                        </div>
                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Today is Novia's birthday! Send a birthday message.
                                        </div>
                                    </div>

                                </div>
                            </div>

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