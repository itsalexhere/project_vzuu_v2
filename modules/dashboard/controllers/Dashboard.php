<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Owner
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->template->title('Dashboard');
        $this->setTitlePage('Dashboard');
        $this->setJs("dashboard");

        $cards = [
            [
                'label_card' => 'Total Customer',
                'value_card' => 473
            ],
            [
                'label_card' => 'Scheduled Appointment',
                'value_card' => 102
            ],
            [
                'label_card' => 'Completed Treatment',
                'value_card' => 1982
            ]
        ];

        $card_lines = [
            [
                'label_card_line' => 'Customer Growth',
                'id_chart' => 'kt_chartjs_2',
                'value_card_line' => 72,
                'value_percentage_card_line' => 30,
                'type_card_line' => "danger"
            ],
            [
                'label_card_line' => 'Total Revenue',
                'id_chart' => 'kt_chartjs_3',
                'value_card_line' => 'Rp. 103.075.201',
                'value_percentage_card_line' => 12,
                'type_card_line' => "success"
            ]
        ];

        $card_pies = [
            [
                'label_card_line' => 'Customer Gender Distribution',
                'id_chart' => 'kt_chartjs_donut1',
                'value_card_line' => 72,
                'value_percentage_card_line' => 30,
                'type_card_line' => "danger"
            ],
            [
                'label_card_line' => 'Customer Age Distribution',
                'id_chart' => 'kt_chartjs_donut2',
                'value_card_line' => 'Rp. 103.075.201',
                'value_percentage_card_line' => 12,
                'type_card_line' => "success"
            ],
            [
                'label_card_line' => 'Customer Segmentation',
                'id_chart' => 'kt_chartjs_donut3',
                'value_card_line' => 'Rp. 103.075.201',
                'value_percentage_card_line' => 12,
                'type_card_line' => "success"
            ]
        ];

        $data = [
            'cards' => $cards,
            'card_lines' => $card_lines,
            'card_pies' => $card_pies
        ];

        $this->template->build('v_dashboard',$data);
    }
}
