<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls extends MX_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('polls/poll_lib');
		$this->load->model('polls/poll_model','poll_m',true);

		$this->load->helper('html');
			
	}

	public function index($id=''){
		show_404();
		
		//$this->load->view('polls/view', $poll);
		
	}
	
	
	// Add vote on option to poll
	// ----------------------------------------------------------------------
	public function vote($poll_id)
	{
		if(!$poll_id){
			show_404();
		}

		$this->load->library('agent');
		$referrer = $this->agent->referrer();

		if($this->input->post()){
			$this->form_validation->set_rules('option','Options', 'required');
			if($this->form_validation->run()==true){
				if($this->poll_m->has_previously_voted($poll_id)){
					message('error','<strong>Sorry,</strong> You have already voted!');
					redirect($referrer);
				}

				$option_id = $this->input->post('option');
				if (!$this->poll_lib->vote($poll_id, $option_id)) {
					message('error','Error while processing. Please try again');
					redirect($referrer);
				}else{
					point_add(11);
					message('voted','Thank you for your vote');
					redirect($referrer);
				}
			}else{
				message('error',validation_errors());
				redirect($referrer);
			}
		}else{
			show_404();
		}
		
		
	}


	
	// View poll
	// ----------------------------------------------------------------------
	public function view($id='')
	{
		if ($id) {
			$poll = $this->poll_m->get_poll($id);
			$poll['options'] = $this->poll_m->get_poll_options($id);
			
		} else {
			$poll = $this->poll_m->get_latest_poll();
			$poll['options'] = $this->poll_m->get_poll_options($poll['poll_id']);
		}

		foreach($poll['options'] as $r=> $option){
			$opt_id = $option['option_id'];
			$poll['options'][$r]['vote'] = $this->poll_m->get_options_votes($opt_id);
		}

		$this->load->view('view',$poll);
		
	}

	

	
	// View datastructure
	// ----------------------------------------------------------------------
	public function data()
	{
		echo '<h2>Single poll (note: needs a valid id): </h2>';
		echo '<pre>';
		print_r($this->poll_lib->single_poll(4));
		echo '</pre>';
		
		echo '<h2>Latest poll: </h2>';
		echo '<pre>';
		print_r($this->poll_lib->single_poll()); // note no value passed in: so returns latest poll
		echo '</pre>';
		
		echo '<h2>Multiple polls: </h2>';
		echo '<pre>';
		print_r($this->poll_lib->all_polls(10, 0));
		echo '</pre>';
	}
}

/* End of file poll.php */
/* Location: ./application/controllers/poll.php */