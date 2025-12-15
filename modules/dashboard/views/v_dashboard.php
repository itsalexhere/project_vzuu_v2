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
                            <!--begin::Header-->
                            <div class="card-header pt-5 mb-6">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Currency-->
                                        <span class="fs-3 fw-semibold text-gray-500 align-self-start me-1">$</span>
                                        <!--end::Currency-->

                                        <!--begin::Value-->
                                        <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">3,274.94</span>
                                        <!--end::Value-->

                                        <!--begin::Label-->
                                        <span class="badge badge-light-success fs-base">
                                            <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>
                                            9.2%
                                        </span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Statistics-->

                                    <!--begin::Description-->
                                    <span class="fs-6 fw-semibold text-gray-500">Avg. Agent Earnings</span>
                                    <!--end::Description-->
                                </h3>
                                <!--end::Title-->

                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Menu-->
                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <i class="fa fa-users fs-1 text-gray-500 me-n1"></i>
                                    </button>

                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">
                                                New Ticket
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">
                                                New Customer
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->

                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">
                                                        Admin Group
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">
                                                        Staff Group
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">
                                                        Member Group
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">
                                                New Contact
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary  btn-sm px-4" href="#">
                                                    Generate Reports
                                                </a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body py-0 px-0">
                                <!--begin::Nav-->
                                <ul class="nav d-flex justify-content-between mb-3 mx-9" role="tablist">
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px active" data-bs-toggle="tab" id="kt_charts_widget_35_tab_1" href="#kt_charts_widget_35_tab_content_1" aria-selected="true" role="tab">

                                            1d
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px " data-bs-toggle="tab" id="kt_charts_widget_35_tab_2" href="#kt_charts_widget_35_tab_content_2" aria-selected="false" tabindex="-1" role="tab">

                                            5d
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px " data-bs-toggle="tab" id="kt_charts_widget_35_tab_3" href="#kt_charts_widget_35_tab_content_3" aria-selected="false" tabindex="-1" role="tab">

                                            1m
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px " data-bs-toggle="tab" id="kt_charts_widget_35_tab_4" href="#kt_charts_widget_35_tab_content_4" aria-selected="false" tabindex="-1" role="tab">

                                            6m
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px " data-bs-toggle="tab" id="kt_charts_widget_35_tab_5" href="#kt_charts_widget_35_tab_content_5" aria-selected="false" tabindex="-1" role="tab">

                                            1y
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->

                                </ul>
                                <!--end::Nav-->

                                <!--begin::Tab Content-->
                                <div class="tab-content mt-n6">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade active show" id="kt_charts_widget_35_tab_content_1" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_1">
                                        <!--begin::Chart-->
                                        <div id="kt_charts_widget_35_chart_1" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6" style="min-height: 215px;">
                                            <div id="apexcharts6978ccpw" class="apexcharts-canvas apexcharts6978ccpw apexcharts-theme-light" style="width: 366.75px; height: 200px;"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" class="apexcharts-svg apexcharts-zoomable hovering-zoom" xmlns:data="ApexChartsNS" transform="translate(0, 0)" width="366.75" height="200">
                                                    <foreignObject x="0" y="0" width="366.75" height="200">
                                                        <style type="text/css">
                                                            .apexcharts-flip-y {
                                                                transform: scaleY(-1) translateY(-100%);
                                                                transform-origin: top;
                                                                transform-box: fill-box;
                                                            }

                                                            .apexcharts-flip-x {
                                                                transform: scaleX(-1);
                                                                transform-origin: center;
                                                                transform-box: fill-box;
                                                            }

                                                            .apexcharts-legend {
                                                                display: flex;
                                                                overflow: auto;
                                                                padding: 0 10px;
                                                            }

                                                            .apexcharts-legend.apexcharts-legend-group-horizontal {
                                                                flex-direction: column;
                                                            }

                                                            .apexcharts-legend-group {
                                                                display: flex;
                                                            }

                                                            .apexcharts-legend-group-vertical {
                                                                flex-direction: column-reverse;
                                                            }

                                                            .apexcharts-legend.apx-legend-position-bottom,
                                                            .apexcharts-legend.apx-legend-position-top {
                                                                flex-wrap: wrap
                                                            }

                                                            .apexcharts-legend.apx-legend-position-right,
                                                            .apexcharts-legend.apx-legend-position-left {
                                                                flex-direction: column;
                                                                bottom: 0;
                                                            }

                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                                                            .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                                                            .apexcharts-legend.apx-legend-position-right,
                                                            .apexcharts-legend.apx-legend-position-left {
                                                                justify-content: flex-start;
                                                                align-items: flex-start;
                                                            }

                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                                                            .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                                                justify-content: center;
                                                                align-items: center;
                                                            }

                                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                                                            .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                                                justify-content: flex-end;
                                                                align-items: flex-end;
                                                            }

                                                            .apexcharts-legend-series {
                                                                cursor: pointer;
                                                                line-height: normal;
                                                                display: flex;
                                                                align-items: center;
                                                            }

                                                            .apexcharts-legend-text {
                                                                position: relative;
                                                                font-size: 14px;
                                                            }

                                                            .apexcharts-legend-text *,
                                                            .apexcharts-legend-marker * {
                                                                pointer-events: none;
                                                            }

                                                            .apexcharts-legend-marker {
                                                                position: relative;
                                                                display: flex;
                                                                align-items: center;
                                                                justify-content: center;
                                                                cursor: pointer;
                                                                margin-right: 1px;
                                                            }

                                                            .apexcharts-legend-series.apexcharts-no-click {
                                                                cursor: auto;
                                                            }

                                                            .apexcharts-legend .apexcharts-hidden-zero-series,
                                                            .apexcharts-legend .apexcharts-hidden-null-series {
                                                                display: none !important;
                                                            }

                                                            .apexcharts-inactive-legend {
                                                                opacity: 0.45;
                                                            }
                                                        </style>
                                                    </foreignObject>
                                                    <g class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g>
                                                    <g class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g>
                                                    <rect width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                                    <g class="apexcharts-yaxis" rel="0" transform="translate(-8, 0)">
                                                        <g class="apexcharts-yaxis-texts-g"></g>
                                                    </g>
                                                    <g class="apexcharts-inner apexcharts-graphical" transform="translate(22, 30)">
                                                        <defs>
                                                            <clipPath id="gridRectMask6978ccpw">
                                                                <rect width="341.75" height="162" x="-3.5" y="-3.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                            <clipPath id="gridRectBarMask6978ccpw">
                                                                <rect width="341.75" height="162" x="-3.5" y="-3.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                            <clipPath id="gridRectMarkerMask6978ccpw">
                                                                <rect width="341.75" height="155" x="-3.5" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                            <clipPath id="forecastMask6978ccpw"></clipPath>
                                                            <clipPath id="nonForecastMask6978ccpw"></clipPath>
                                                            <linearGradient x1="0" y1="0" x2="0" y2="1" id="SvgjsLinearGradient1003">
                                                                <stop stop-opacity="0.4" stop-color="rgba(114,57,234,0.4)" offset="0.15"></stop>
                                                                <stop stop-opacity="0.2" stop-color="rgba(255,255,255,0.2)" offset="1.2"></stop>
                                                                <stop stop-opacity="0.2" stop-color="rgba(255,255,255,0.2)" offset="1"></stop>
                                                            </linearGradient>
                                                        </defs>
                                                        <g class="apexcharts-grid">
                                                            <g class="apexcharts-gridlines-horizontal">
                                                                <line x1="0" y1="38.75" x2="334.75" y2="38.75" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                                <line x1="0" y1="77.5" x2="334.75" y2="77.5" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                                <line x1="0" y1="116.25" x2="334.75" y2="116.25" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                            </g>
                                                            <g class="apexcharts-gridlines-vertical"></g>
                                                            <line x1="0" y1="155" x2="334.75" y2="155" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                                            <line x1="0" y1="1" x2="0" y2="155" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                                        </g>
                                                        <g class="apexcharts-grid-borders">
                                                            <line x1="0" y1="0" x2="334.75" y2="0" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                            <line x1="0" y1="155" x2="334.75" y2="155" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g class="apexcharts-area-series apexcharts-plot-series">
                                                            <g class="apexcharts-series" zIndex="0" seriesName="Earnings" data:longestSeries="true" rel="1" data:realIndex="0">
                                                                <path d="M-2008.4999999999998 98.16666666666666C-1949.9187499999998 98.16666666666666 -1899.7062499999997 46.5 -1841.1249999999995 46.5C-1782.5437499999998 46.5 -1732.3312499999997 46.5 -1673.75 46.5C-1615.1687499999998 46.5 -1564.95625 82.66666666666666 -1506.375 82.66666666666666C-1447.79375 82.66666666666666 -1397.5812499999997 82.66666666666666 -1339 82.66666666666666C-1280.41875 82.66666666666666 -1230.20625 113.66666666666666 -1171.625 113.66666666666666C-1113.04375 113.66666666666666 -1062.83125 113.66666666666666 -1004.2499999999999 113.66666666666666C-945.6687499999999 113.66666666666666 -895.4562499999998 82.66666666666666 -836.8749999999999 82.66666666666666C-778.2937499999999 82.66666666666666 -728.08125 82.66666666666666 -669.5 82.66666666666666C-610.9187499999999 82.66666666666666 -560.70625 41.33333333333334 -502.12499999999994 41.33333333333334C-443.54375 41.33333333333334 -393.33124999999995 41.33333333333334 -334.75 41.33333333333334C-276.16875 41.33333333333334 -225.95625000000004 62 -167.37499999999997 62C-108.79375000000002 62 -58.58124999999998 62 0 62C58.58124999999998 62 108.79374999999999 38.75 167.375 38.75C225.95625 38.75 276.16875 38.75 334.75 38.75C334.75 38.75 334.75 38.75 334.75 155L-2008.4999999999998 155L-2008.4999999999998 98.16666666666666C-2008.4999999999998 98.16666666666666 -2008.4999999999998 98.16666666666666 -2008.4999999999998 98.16666666666666 " fill="url(#SvgjsLinearGradient1003)" fill-opacity="1" stroke="none" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask6978ccpw)" pathTo="M -2008.4999999999998 98.16666666666666C -1949.9187499999998 98.16666666666666 -1899.7062499999997 46.5 -1841.1249999999998 46.5C -1782.5437499999998 46.5 -1732.3312499999997 46.5 -1673.7499999999998 46.5C -1615.1687499999998 46.5 -1564.95625 82.66666666666666 -1506.375 82.66666666666666C -1447.79375 82.66666666666666 -1397.58125 82.66666666666666 -1339 82.66666666666666C -1280.41875 82.66666666666666 -1230.20625 113.66666666666666 -1171.625 113.66666666666666C -1113.04375 113.66666666666666 -1062.83125 113.66666666666666 -1004.2499999999999 113.66666666666666C -945.6687499999999 113.66666666666666 -895.4562499999998 82.66666666666666 -836.8749999999999 82.66666666666666C -778.2937499999999 82.66666666666666 -728.08125 82.66666666666666 -669.5 82.66666666666666C -610.9187499999999 82.66666666666666 -560.70625 41.33333333333334 -502.12499999999994 41.33333333333334C -443.54375 41.33333333333334 -393.33124999999995 41.33333333333334 -334.75 41.33333333333334C -276.16875 41.33333333333334 -225.95625 62 -167.375 62C -108.79375 62 -58.58125 62 0 62C 58.58125 62 108.79375 38.75 167.375 38.75C 225.95625 38.75 276.16875 38.75 334.75 38.75C 334.75 38.75 334.75 38.75 334.75 155 L -2008.4999999999998 155z" pathFrom="M -602.55 98.16666666666666C -579.1175 98.16666666666666 -559.0325 46.5 -535.6 46.5C -512.1675 46.5 -492.0825 46.5 -468.65 46.5C -445.2175 46.5 -425.1325 82.66666666666666 -401.7 82.66666666666666C -378.2675 82.66666666666666 -358.1825 82.66666666666666 -334.75 82.66666666666666C -311.3175 82.66666666666666 -291.2325 113.66666666666666 -267.8 113.66666666666666C -244.3675 113.66666666666666 -224.2825 113.66666666666666 -200.85 113.66666666666666C -177.4175 113.66666666666666 -157.3325 82.66666666666666 -133.9 82.66666666666666C -110.4675 82.66666666666666 -90.38250000000001 82.66666666666666 -66.95 82.66666666666666C -43.5175 82.66666666666666 -23.4325 41.33333333333334 0 41.33333333333334C 23.4325 41.33333333333334 43.5175 41.33333333333334 66.95 41.33333333333334C 90.38250000000001 41.33333333333334 110.4675 62 133.9 62C 157.3325 62 177.4175 62 200.85 62C 224.2825 62 244.3675 38.75 267.8 38.75C 291.2325 38.75 311.3175 38.75 334.75 38.75C 334.75 38.75 334.75 38.75 334.75 155 L -602.55 155zz"></path>
                                                                <path d="M-2008.4999999999998 98.16666666666666C-1949.9187499999998 98.16666666666666 -1899.7062499999997 46.5 -1841.1249999999995 46.5C-1782.5437499999998 46.5 -1732.3312499999997 46.5 -1673.75 46.5C-1615.1687499999998 46.5 -1564.95625 82.66666666666666 -1506.375 82.66666666666666C-1447.79375 82.66666666666666 -1397.5812499999997 82.66666666666666 -1339 82.66666666666666C-1280.41875 82.66666666666666 -1230.20625 113.66666666666666 -1171.625 113.66666666666666C-1113.04375 113.66666666666666 -1062.83125 113.66666666666666 -1004.2499999999999 113.66666666666666C-945.6687499999999 113.66666666666666 -895.4562499999998 82.66666666666666 -836.8749999999999 82.66666666666666C-778.2937499999999 82.66666666666666 -728.08125 82.66666666666666 -669.5 82.66666666666666C-610.9187499999999 82.66666666666666 -560.70625 41.33333333333334 -502.12499999999994 41.33333333333334C-443.54375 41.33333333333334 -393.33124999999995 41.33333333333334 -334.75 41.33333333333334C-276.16875 41.33333333333334 -225.95625000000004 62 -167.37499999999997 62C-108.79375000000002 62 -58.58124999999998 62 0 62C58.58124999999998 62 108.79374999999999 38.75 167.375 38.75C225.95625 38.75 276.16875 38.75 334.75 38.75 " fill="none" fill-opacity="1" stroke="#7239ea" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask6978ccpw)" pathTo="M -2008.4999999999998 98.16666666666666C -1949.9187499999998 98.16666666666666 -1899.7062499999997 46.5 -1841.1249999999998 46.5C -1782.5437499999998 46.5 -1732.3312499999997 46.5 -1673.7499999999998 46.5C -1615.1687499999998 46.5 -1564.95625 82.66666666666666 -1506.375 82.66666666666666C -1447.79375 82.66666666666666 -1397.58125 82.66666666666666 -1339 82.66666666666666C -1280.41875 82.66666666666666 -1230.20625 113.66666666666666 -1171.625 113.66666666666666C -1113.04375 113.66666666666666 -1062.83125 113.66666666666666 -1004.2499999999999 113.66666666666666C -945.6687499999999 113.66666666666666 -895.4562499999998 82.66666666666666 -836.8749999999999 82.66666666666666C -778.2937499999999 82.66666666666666 -728.08125 82.66666666666666 -669.5 82.66666666666666C -610.9187499999999 82.66666666666666 -560.70625 41.33333333333334 -502.12499999999994 41.33333333333334C -443.54375 41.33333333333334 -393.33124999999995 41.33333333333334 -334.75 41.33333333333334C -276.16875 41.33333333333334 -225.95625 62 -167.375 62C -108.79375 62 -58.58125 62 0 62C 58.58125 62 108.79375 38.75 167.375 38.75C 225.95625 38.75 276.16875 38.75 334.75 38.75" pathFrom="M -602.55 98.16666666666666C -579.1175 98.16666666666666 -559.0325 46.5 -535.6 46.5C -512.1675 46.5 -492.0825 46.5 -468.65 46.5C -445.2175 46.5 -425.1325 82.66666666666666 -401.7 82.66666666666666C -378.2675 82.66666666666666 -358.1825 82.66666666666666 -334.75 82.66666666666666C -311.3175 82.66666666666666 -291.2325 113.66666666666666 -267.8 113.66666666666666C -244.3675 113.66666666666666 -224.2825 113.66666666666666 -200.85 113.66666666666666C -177.4175 113.66666666666666 -157.3325 82.66666666666666 -133.9 82.66666666666666C -110.4675 82.66666666666666 -90.38250000000001 82.66666666666666 -66.95 82.66666666666666C -43.5175 82.66666666666666 -23.4325 41.33333333333334 0 41.33333333333334C 23.4325 41.33333333333334 43.5175 41.33333333333334 66.95 41.33333333333334C 90.38250000000001 41.33333333333334 110.4675 62 133.9 62C 157.3325 62 177.4175 62 200.85 62C 224.2825 62 244.3675 38.75 267.8 38.75C 291.2325 38.75 311.3175 38.75 334.75 38.75" fill-rule="evenodd"></path>
                                                                <g class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0">
                                                                    <g class="apexcharts-series-markers">
                                                                        <path d="M0,0" fill="#7239ea" fill-opacity="1" stroke="#7239ea" stroke-opacity="0.9" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-marker w4t1n0a32 no-pointer-events" default-marker-size="0"></path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                            <g class="apexcharts-datalabels" data:realIndex="0"></g>
                                                        </g>
                                                        <line x1="-0.5" y1="0" x2="-0.5" y2="155" stroke="#7239ea" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="-0.5" y="0" width="1" height="155" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                                        <line x1="0" y1="0" x2="334.75" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                        <line x1="0" y1="0" x2="334.75" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                                        <g class="apexcharts-xaxis" transform="translate(20, 0)">
                                                            <g class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                                        </g>
                                                        <g class="apexcharts-yaxis-annotations apexcharts-hidden-element-shown"></g>
                                                        <g class="apexcharts-xaxis-annotations apexcharts-hidden-element-shown"></g>
                                                        <g class="apexcharts-point-annotations apexcharts-hidden-element-shown"></g>
                                                    </g>
                                                    <rect width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect>
                                                    <rect width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect>
                                                </svg>
                                                <div class="apexcharts-legend" style="max-height: 100px;"></div>
                                                <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 33px; top: 65px;">
                                                    <div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;">7PM</div>
                                                    <div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0 apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" shape="circle" style="color: rgb(114, 57, 234);"></span>
                                                        <div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;">
                                                            <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Earnings: </span><span class="apexcharts-tooltip-text-y-value">2800$</span></div>
                                                            <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                            <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: -0.648438px; top: 187px;">
                                                    <div class="apexcharts-xaxistooltip-text" style="font-family: inherit; font-size: 12px; min-width: 23.2505px;">7PM</div>
                                                </div>
                                                <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                    <div class="apexcharts-yaxistooltip-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Chart-->

                                        <!--begin::Table container-->
                                        <div class="table-responsive mx-9 mt-n6">
                                            <!--begin::Table-->
                                            <table class="table align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr>
                                                        <th class="min-w-100px"></th>
                                                        <th class="min-w-100px text-end pe-0"></th>
                                                        <th class="text-end min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->

                                                <!--begin::Table body-->
                                                <tbody>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-danger">-139.34</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">3:10 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$3,207.03</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-success">+576.24</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">3:55 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$3,274.94</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-success">+124.03</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->


                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_2" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_2">
                                        <!--begin::Chart-->
                                        <div id="kt_charts_widget_35_chart_2" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
                                        <!--end::Chart-->

                                        <!--begin::Table container-->
                                        <div class="table-responsive mx-9 mt-n6">
                                            <!--begin::Table-->
                                            <table class="table align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr>
                                                        <th class="min-w-100px"></th>
                                                        <th class="min-w-100px text-end pe-0"></th>
                                                        <th class="text-end min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->

                                                <!--begin::Table body-->
                                                <tbody>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">4:30 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$2,345.45</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-success">+134.02</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">11:35 AM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-primary">-124.03</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">3:30 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$1,756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-danger">+144.04</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->


                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_3" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_3">
                                        <!--begin::Chart-->
                                        <div id="kt_charts_widget_35_chart_3" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
                                        <!--end::Chart-->

                                        <!--begin::Table container-->
                                        <div class="table-responsive mx-9 mt-n6">
                                            <!--begin::Table-->
                                            <table class="table align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr>
                                                        <th class="min-w-100px"></th>
                                                        <th class="min-w-100px text-end pe-0"></th>
                                                        <th class="text-end min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->

                                                <!--begin::Table body-->
                                                <tbody>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">3:20 AM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$3,756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-primary">+185.03</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">12:30 AM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-danger">+124.03</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">4:30 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-success">-154.03</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->


                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_4" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_4">
                                        <!--begin::Chart-->
                                        <div id="kt_charts_widget_35_chart_4" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
                                        <!--end::Chart-->

                                        <!--begin::Table container-->
                                        <div class="table-responsive mx-9 mt-n6">
                                            <!--begin::Table-->
                                            <table class="table align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr>
                                                        <th class="min-w-100px"></th>
                                                        <th class="min-w-100px text-end pe-0"></th>
                                                        <th class="text-end min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->

                                                <!--begin::Table body-->
                                                <tbody>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-warning">+124.03</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">5:30 AM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$1,756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-info">+144.65</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">4:30 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$2,085.25</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-primary">+154.06</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->


                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_5" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_5">
                                        <!--begin::Chart-->
                                        <div id="kt_charts_widget_35_chart_5" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
                                        <!--end::Chart-->

                                        <!--begin::Table container-->
                                        <div class="table-responsive mx-9 mt-n6">
                                            <!--begin::Table-->
                                            <table class="table align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr>
                                                        <th class="min-w-100px"></th>
                                                        <th class="min-w-100px text-end pe-0"></th>
                                                        <th class="text-end min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->

                                                <!--begin::Table body-->
                                                <tbody>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$2,045.04</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-warning">+114.03</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">3:30 AM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-primary">-124.03</span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-gray-600 fw-bold fs-6">10:30 PM</a>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="text-gray-800 fw-bold fs-6 me-1">$1.756.26</span>
                                                        </td>

                                                        <td class="pe-0 text-end">
                                                            <span class="fw-bold fs-6 text-info">+165.86</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->

                                </div>
                                <!--end::Tab Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-6 mb-5">
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
        </div>
    </div>
</div>