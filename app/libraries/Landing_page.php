<?php
class Landing_page
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = get_instance();
    }


    function views($template = NULL, $data = NULL)
    {
        if ($template != NULL) {

            // Header
            $data['header']                 = $this->_ci->load->view('Components/Header', $data, TRUE);

            //Sidebar
            $data['navbar']                 = $this->_ci->load->view('Components/Navbar', $data, TRUE);

            //Content
            $data['content']                 = $this->_ci->load->view($template, $data, TRUE);

            //Footer
            $data['footer']                 = $this->_ci->load->view('Components/Footer', $data, TRUE);

            echo  $this->_ci->load->view('Index', $data, TRUE);
        }
    }
}
