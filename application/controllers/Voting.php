<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* @property voting_counter_model $voting_counter */
class Voting extends Front_end
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('voting_counter_model', 'voting_counter');
    }

    public function index()
    {
        $this->vote_page();
    }

    /**
     *  display all categories of voting in frontend.
     */
    public function vote_page()
    {
        $data['vote'] = $this->voting_counter->get_one_active();
        $columns = $this->voting_counter->get_all_columns_active();
        $data['columns'] = array_filter($columns);
        $this->view('content/vote_page', $data);
    }

    /**
     * This function to vote
     * @param integer $id
     */
    public function voted($id)
    {

        $ip = $this->input->ip_address();
        $v_column = $this->input->post('v_column');
        if (!empty($v_column)) {
            $found_ip = $this->voting_counter->check_ip($id, $ip);
            if (empty($found_ip)) {
                $this->voting_counter->add_vote($id, $ip);
                $data['result'] = $this->voting_counter->result($id);
                $data['rows'] = $this->voting_counter->getNumVoting($id);
                $this->view('content/vote_result_current', $data);
            } else {
                $data['result'] = $this->voting_counter->result($id);
                $data['rows'] = $this->voting_counter->getNumVoting($id);
                $this->view('content/vote_result_current', $data);
            }
        }
    }



}

/* End of file dashboard.php */
/* Location: ./system/application/modules/matchbox/controllers/dashboard.php */