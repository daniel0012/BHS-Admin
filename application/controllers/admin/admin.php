<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
       {
            parent::__construct();
			$this->output->enable_profiler(FALSE);
			if(!$this->session->userdata('id')) {
				redirect('login');
			}
       }
	   
	public function index()
	{
		switch ($this->session->userdata('position')) {
			case '8'://admin
				
				break;
			
			case '2'://sbc
			case '3'://sbc
			case '9'://sbc	
			case '6'://vp
				$this->load->model('Phase_1_model');
				
				$background= $this->Phase_1_model->get_no_background();
				$data['action_items'] = array();
				if (is_array($background)) {
					
					foreach ($background as $id => $name):
						$data['action_items'][] = '<a href="admin/etts/update_background/'.$id.'">'.$name.'</a>\'s backgound check is pending.';
					endforeach;
				}
				
				$contract= $this->Phase_1_model->get_no_contract();
				if (is_array($contract)) {
					
					foreach ($contract as $id => $name):
						$data['action_items'][] = '<a href="admin/etts/update_contract/'.$id.'">'.$name.'</a>\'s employee contract approval is pending.';
					endforeach;
				}
				
				$supervision= $this->Phase_1_model->get_no_supervision();
				if (is_array($supervision)) {
					
					foreach ($supervision as $id => $name):
						$data['action_items'][] = '<a href="admin/etts/update_supervision/'.$id.'">'.$name.'</a>\'s supervision for licensure agreement approval is pending.';
					endforeach;
				}
				
				break;
				
			case '7'://pres
				$this->load->model('Phase_model'); 
				$approval_tasks = $this->Phase_model->get_tasks_approval(7);
				if (is_array($approval_tasks)) {
					
					foreach ($approval_tasks as $id => $name):
						$data['action_items'][] = '<a href="'.base_url().'etts/approval/'.$id.'">'.$name.'</a> has a task that requires approval.';
					endforeach;
				}				
				
			
				break;
				
			case '5'://sbc
				$this->load->model('Phase_model');
				$approval_tasks = $this->Phase_model->get_tasks_approval(5);
				if (is_array($approval_tasks)) {
					
					foreach ($approval_tasks as $id => $name):
						$data['action_items'][] = '<a href="'.base_url().'etts/approval/'.$id.'">'.$name.'</a> has a task that requires approval.';
					endforeach;
				}
				break;
			
			default:
				
				break;
		}
		
		$data['title'] = 'Dashboard';
		$data['content'] = 'dashboard';
		
		$this->load->view('template', $data);
	}

	
	public function employees()
	{
		$data = array(
			'title' => 'Employees',
			'content' => 'employees'
		);
		$this->load->view('template', $data);
	}
	
	public function store()
	{
		$data = array(
			'title' => 'Store',
			'content' => 'store'
		);
		$this->load->view('template', $data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */