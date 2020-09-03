<?php

defined('BASEPATH') OR exit('No direct script access allowed');
@include_once(APPPATH.'libraries/Redis.php');
use Redis\CI_Redis;

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

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->driver('cache', array('adapter' => 'redis')); //set cache
		
		$this->redis = new CI_Redis();
		$this->load->library(['form_validation','session']);
	}
	
	public function listUser(){
		$list_user = $this->db->query('select * from default_guest');
		if(!$list_user){
			$error = $this->db->error();
		}else{
			foreach ($list_user->result_array() as $key => $user) {
				echo $key.'.'.$user['fullname'].'<br>';
			}
			
		}
		
		// print_r($list_user->result_array());
	}
	public function login($page='login'){   
		// echo base_url(uri_string());
		if ( ! file_exists(APPPATH.'views/account/'.$page.'.php')){
			show_404();
		}

        $this->load->view('account/'.$page);
	}
	
	public function loginUser(){
		// echo 'login';
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password_hash_md5 = md5($password);

		if ($this->form_validation->run() == FALSE) {
			// $this->load->view('account/login');
			// return redirect()->to('account/login');
			echo 'error';
		}else{
			$this->load->helper('cookie');
			$user = $this->db->get_where('default_guest',['email' => $email,'password'=>$password_hash_md5])->row();
			
			$data['data_login'] = array(
					'user_id' => $user->user_id,
					'fullname' => $user->fullname,
					'email' => $user->email,
						
				);
				// $data2 = array(
				// 	'name'   => 'sdffgsdfg',
				// 	'value'  => 'sdfgsdfgdfsg',
				// 	'expire' => '86500',
				// 	'domain' => '',
				// 	'path'   => '/',
				// 	'prefix' => 'myprefix_'
				// );
			// set_cookie($data2);
			// $data['test'] = get_cookie('name');
			return $this->load->view('account/profile', $data);
		}

	}
	public function register($page='register'){   
		if ( ! file_exists(APPPATH.'views/account/'.$page.'.php'))
        {
            show_404();
		}
        $this->load->view('account/'.$page);
	}
	public function registerUser(){

		// $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		// $this->form_validation->set_rules('password', 'Password', 'required');


		$arr = [];
		$arr['fullname'] =  $this->input->post('fullname');
		$arr['email'] =  $this->input->post('email');
		$arr['password'] =  $password_hash_md5 = md5($this->input->post('password'));

		$sql = $this->db->set($arr)->insert('default_guest');
		if($sql){
			$data['data_login'] = array(
				'fullname' => $arr['fullname'],
				'email' => $arr['email'],	
			);
		// $this->cache->save('registerUser', $data, 100);
		return $this->load->view('account/profile', $data);
		}else echo 'Insert error';
		// print_r($sql);
	}
	public function profile(){
		return $this->load->view('account/profile');
	}
	public function cacheTest(){

			$cached = $this->redis->get('testCache');
			// $getCache = $this->redis->checked_requied('old_cache');

			$foo = 'foobarbaz26823!';
			$this->redis->set('testCache', $foo, 300);
			// $this->redis->del('testCache');
			// print_r($this->redis->get('testCache'));
			print_r($this->redis->keys('*'));
			
			
	
		
	}

}
