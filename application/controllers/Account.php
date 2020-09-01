<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function login($page='login')
	{   
       
		if ( ! file_exists(APPPATH.'views/account/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        // $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('account/'.$page);
        // $this->load->view('pages/'.$page, $data);
        // $this->load->view('templates/footer', $data);
	}
}
