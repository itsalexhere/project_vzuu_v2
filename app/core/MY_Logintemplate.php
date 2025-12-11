<?php defined('BASEPATH') or exit('No direct script access allowed');

abstract class MY_Logintemplate extends MX_Controller
{

    protected $_js = JS_LOGIN_AUTH;
    protected $_background_login = "";
    protected $_form_image = "";
    protected $_logo_image = "";
    protected $_login = LOGIN;
    protected $_setting_profile = '';

    public function __construct()
    {
        parent::__construct();

        $this->template->set_layout($this->_login, THEME);
        $this->template->set('js', $this->_js);

        $this->_setting_profile = $this->getSettingProfile();

        if ($this->_background_login != "") {
            $this->template->set('background_login', $this->_background_login);
        }
        if ($this->_form_image != "") {
            $this->template->set('form_image', $this->_form_image);
        }

        if ($this->_logo_image != "") {
            $this->template->set("logo_image", $this->_logo_image);
        }

        if ($this->_setting_profile != '' || $this->_setting_profile != null) {
            $this->template->set('setting_profile', $this->_setting_profile);
        }
    }

    protected function getSettingProfile()
    {
        $this->load->model('company_profile/Company_profile_model', 'company_profile_model');
        $get = $this->company_profile_model->detail();
        if ($get) {
            $data['name'] = $get->name;
            $data['image']   = $get->image_path;
            return $data;
        }
        return null;
    }
}
