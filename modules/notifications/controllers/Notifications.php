<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends MY_Owner
{
    protected $title;
    protected $path;

    public function __construct()
    {
        $this->_function_except = ['show'];
        parent::__construct();
        $this->title = "Notifications";
        $this->path = "notifications";
    }

    public function index()
    {
        $this->template->title(ucfirst($this->title));
        $this->setTitlePage(ucfirst($this->title));
        $this->assetsBuild(['datatables']);
        $this->setJs($this->path);

        $notifications = [
            [
                'type'        => 'danger',
                'icon'        => 'bi-star',
                'title'       => 'Customer Birthday!',
                'message'     => "Today is Novia's birthday! Send a birthday message.",
                'date'        => '12/11/2025',
                'action_text' => 'Mark as Read',
            ],
            [
                'type'        => 'info',
                'icon'        => 'bi-bell',
                'title'       => 'New Appointment',
                'message'     => 'You have a new appointment request.',
                'date'        => '13/11/2025',
                'action_text' => 'Mark as Read',
            ],
            [
                'type'        => 'new',
                'icon'        => 'bi-bell',
                'title'       => 'Treatment',
                'message'     => 'You have a new appointment request.',
                'date'        => '13/11/2025',
                'action_text' => 'Mark as Unread',
            ],
        ];

        $data = [
            'notifications' => $notifications
        ];

        $this->template->build('v_show',$data);
    }

    public function show()
    {
        isAjaxRequestWithPost();
        $this->function_access('view');

        echo $this->customer_model->show();
    }
}