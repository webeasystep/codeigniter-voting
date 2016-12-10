<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Voting_counter_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}


	function add_vote($id, $ip)
	{
		$opt_leave = explode(",", $this->input->post('v_column'));
		$column = $opt_leave[0];
		$data = $opt_leave[1];
		$this->db->set('v_column',$column);
		$this->db->set('v_data',$data);
		$this->db->set('v_vistor_ip',$ip);
		$this->db->set('v_voting_id', $id);
		$this->db->insert('ci_voting_counter');

	}

	function get_one_active()
	{
		$this->db->where('dv_state', 1);
		$result = $this->db->get('ci_voting');
		return $result->row();
	}

	function get_all_columns_active()
	{
		$this->db->where('dv_state', 1);
		$this->db->select('A,B,C,D,E,F,G,H,I,J');
		$result = $this->db->get('ci_voting');
		$return = array();
		if ($result->num_rows() > 0) {
			foreach ($result->row_array() as $key => $value) {
				$return[$key] = $value;
			}
		}

		return $return;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////frontend//////////////////////////////////////////////////////////
	function check_ip($id, $ip)
	{
		$this->db->where('v_voting_id', $id);
		$this->db->where('v_vistor_ip', $ip);
		$result = $this->db->get('ci_voting_counter');
		if ($result->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/*  This function get  result of specified voting by join the ci_voting table and ci_voting_counter table .*/

	function result($id)
	{

		$result = $this->db->query(" SELECT * FROM ci_voting_counter INNER JOIN ci_voting
                            ON ci_voting_counter.v_voting_id = ci_voting.dv_id
                            WHERE dv_id=$id ")->row();
		return $result;
	}

	// get total number of voting one
	function getNumVoting($id)
	{
		$result = $this->db->query("SELECT v_column,v_data,
									SUM(v_value) as vote_value,
			(SELECT SUM(v_value)FROM ci_voting_counter WHERE v_voting_id=$id) as total
									FROM ci_voting_counter
									WHERE v_voting_id=$id
									GROUP BY v_column")->result_array();

		foreach($result as $key => $value)
		{
			$value['prec'] = round(100*($value['vote_value'] / $value['total']),2);
			$result[$key] = $value;

		}
		return array_filter($result);

	}

}