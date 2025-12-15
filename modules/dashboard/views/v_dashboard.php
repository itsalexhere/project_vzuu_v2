<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="d-flex flex-column flex-column-fluid">
    <div class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            <button class="btn btn-success btn-sm fw-bold mb-6" type="button" id="btnSide"
                data-type="modal"
                data-url="<?= base_url("customer/side") ?>"
                data-fullscreenmodal="' . $fullscreen . '">
                <i class="fa-solid fa-filter fs-4 me-2"></i>
                Filter
            </button>

            <div class="row gx-5 gx-xl-10">
                <div class="row">
                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card card-flush h-100">

                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-gray-900 lh-1">357</span>
                                    <span class="text-gray-500 pt-1 fw-semibold fs-6">Professionals</span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column justify-content-end">
                                <span class="fs-6 fw-bolder text-gray-800 mb-2">Today’s Heroes</span>

                                <div class="symbol-group symbol-hover flex-nowrap">
                                    <!-- avatars tetap sama -->
                                    <!-- ... -->
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card card-flush h-100">

                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-gray-900 lh-1">357</span>
                                    <span class="text-gray-500 pt-1 fw-semibold fs-6">Professionals</span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column justify-content-end">
                                <span class="fs-6 fw-bolder text-gray-800 mb-2">Today’s Heroes</span>

                                <div class="symbol-group symbol-hover flex-nowrap">
                                    <!-- avatars tetap sama -->
                                    <!-- ... -->
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card card-flush h-100">

                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-gray-900 lh-1">357</span>
                                    <span class="text-gray-500 pt-1 fw-semibold fs-6">Professionals</span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column justify-content-end">
                                <span class="fs-6 fw-bolder text-gray-800 mb-2">Today’s Heroes</span>

                                <div class="symbol-group symbol-hover flex-nowrap">
                                    <!-- avatars tetap sama -->
                                    <!-- ... -->
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row gx-5 gx-xl-10">
                <div class="row">
                    <div class="col-md-6 col-xl-6 mb-5">
                        <div class="card card-flush h-md-100">

                            <div class="card-header pt-5 mb-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label" style="color: grey;">Total Sales</span>
                                </h3>
                            </div>

                            <div class="card-body">

                                <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                                    <div class="d-flex mb-2">
                                        <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">Rp 30,000,000,00</span>
                                    </div>
                                    <span class="fs-6 fw-semibold text-gray-400">Another $48,346 to Goal</span>

                                    <canvas id="kt_chartjs_2" class="mh-400px mt-6"></canvas>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-6 mb-5">
                        <div class="card card-flush h-md-100">

                            <div class="card-header pt-5 mb-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label" style="color: grey;">Total Sales</span>
                                </h3>
                            </div>

                            <div class="card-body">

                                <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                                    <div class="d-flex mb-2">
                                        <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">Rp 30,000,000,00</span>
                                    </div>
                                    <span class="fs-6 fw-semibold text-gray-400">Another $48,346 to Goal</span>

                                    <canvas id="kt_chartjs_3" class="mh-400px mt-6"></canvas>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gx-5 gx-xl-10">
                <div class="row">
                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card card-flush h-md-100">

                            <div class="card-header pt-5 mb-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label" style="color: grey;">Customer Gender Distribution</span>
                                </h3>
                            </div>

                            <div class="card-body d-flex justify-content-between flex-column pb-1">
                                <canvas id="kt_chartjs_donut1" class="mh-400px mt-6"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card card-flush h-md-100">

                            <div class="card-header pt-5 mb-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label" style="color: grey;">Customer Age Distribution</span>
                                </h3>
                            </div>

                            <div class="card-body d-flex justify-content-between flex-column pb-1">
                                <canvas id="kt_chartjs_donut2" class="mh-400px mt-6"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card card-flush h-md-100">

                            <div class="card-header pt-5 mb-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label" style="color: grey;">Customer Segmentation</span>
                                </h3>
                            </div>

                            <div class="card-body d-flex justify-content-between flex-column pb-1">
                                <canvas id="kt_chartjs_donut3" class="mh-400px mt-6"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gx-5 gx-xl-10">
                <div class="row">
                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card card-flush h-md-100">

                            <div class="card-header pt-5 mb-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label" style="color: grey;">Top Selling Treatment</span>
                                </h3>
                            </div>

                            <div class="card-body d-flex justify-content-between flex-column pb-1">
                                <canvas id="kt_chartjs_barright" class="mh-400px mt-6"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card card-flush h-md-100">

                            <div class="card-header pt-5 mb-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label" style="color: grey;">Top Spender</span>
                                </h3>
                            </div>

                            <div class="card-body d-flex justify-content-between flex-column pb-1">
                                <canvas id="kt_chartjs_donut2" class="mh-400px mt-6"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card card-flush h-md-100">

                            <div class="card-header pt-5 mb-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label" style="color: grey;">Customer BirthDay</span>
                                </h3>
                            </div>

                            <div class="card-body d-flex justify-content-between flex-column pb-1">
                                <canvas id="kt_chartjs_donut3" class="mh-400px mt-6"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>