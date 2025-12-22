<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="d-flex flex-column flex-column-fluid">
    <div class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            <button class="btn btn-success btn-sm fw-bold mb-6" type="button" id="btnSide"
                data-type="modal"
                data-url="<?= base_url("customer/side") ?>">
                <i class="fa-solid fa-filter fs-4 me-2"></i>
                Filter
            </button>

            <div class="row">
                <?php
                $total_cards = count($cards);

                $col_xl = 12 / $total_cards;

                $col_xl = floor($col_xl);

                // minimal col 3
                if ($col_xl < 3) {
                    $col_xl = 3;
                }

                foreach ($cards as $card): ?>
                    <div class="col-md-6 col-xl-<?= $col_xl ?> mb-5">

                        <?= $this->load->view(
                            PATH_COMPONENTS . 'dashboard/card',
                            [
                                'label_card' => $card['label_card'],
                                'value_card' => $card['value_card']
                            ],
                            true
                        ); ?>

                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <?php
                $total_cards = count($card_lines);

                $col_xl = 12 / $total_cards;

                $col_xl = floor($col_xl);

                // minimal col 3
                if ($col_xl < 3) {
                    $col_xl = 3;
                }

                foreach ($card_lines as $card): ?>
                    <div class="col-md-6 col-xl-<?= $col_xl ?> mb-5">

                        <?= $this->load->view(
                            PATH_COMPONENTS . 'dashboard/card_line_chart',
                            [
                                'label_card_line' => $card['label_card_line'],
                                'id_chart' => $card['id_chart'],
                                'value_card_line' => $card['value_card_line'],
                                'value_percentage_card_line' => $card['value_percentage_card_line'],
                                'type_card_line' => $card['type_card_line']
                            ],
                            true
                        ); ?>

                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <?php
                $total_cards = count($card_pies);

                $col_xl = 12 / $total_cards;

                $col_xl = floor($col_xl);

                // minimal col 3
                if ($col_xl < 3) {
                    $col_xl = 3;
                }

                foreach ($card_pies as $card): ?>
                    <div class="col-md-6 col-xl-<?= $col_xl ?> mb-5">

                        <?= $this->load->view(
                            PATH_COMPONENTS . 'dashboard/card_pie_chart',
                            [
                                'label_card_line' => $card['label_card_line'],
                                'id_chart' => $card['id_chart'],
                                'value_card_line' => $card['value_card_line'],
                                'value_percentage_card_line' => $card['value_percentage_card_line'],
                                'type_card_line' => $card['type_card_line']
                            ],
                            true
                        ); ?>

                    </div>
                <?php endforeach; ?>
            </div>

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