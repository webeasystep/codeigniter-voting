<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Voting_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /* This function create new category. */

    function create($orderd_data)
    {
           foreach($orderd_data as $key => $value){
               $this->db->set('dv_title',$this->input->post('dv_title'));
               $this->db->set($key,$value);
               $this->db->set('dv_created', time());
           }
        $this->db->insert('ci_voting');

       // $this->db->insert_batch('ci_voting',$insert);

    }


    function update($orderd_data,$id)
    {


           $this->db->where('dv_id',$id);
		   $this->db->delete('ci_voting');

        foreach($orderd_data as $key => $value){
            $this->db->set($key,$value);
            $this->db->set('dv_created', time());
        }
        $this->db->set('dv_title',$this->input->post('dv_title'));
        $this->db->set('dv_state',$this->input->post('dv_state'));
        $this->db->insert('ci_voting');
    }


    /* This function delete categor of new from database. */

    function delete($id)
    {
        $this->db->where('dv_id', $id);
        $this->db->delete('ci_voting');

        $this->db->where('v_voting_id', $id);
        $this->db->delete('ci_voting_counter');
        return TRUE;
    }

    function active($id) {
        $this->db->set('dv_state', 1);
        $this->db->where('dv_id', $id);
        $this->db->update('ci_voting');

        $this->db->set('dv_state',0);
        $this->db->where('dv_id !=', $id);
        $this->db->update('ci_voting');
        return $this->db->elapsed_time();
    }

    function deactivate($id) {
        $this->db->set('dv_state', 0);
        $this->db->where('dv_id', $id);
        $this->db->update('ci_voting');

        $this->db->set('dv_state',1);
        $this->db->where('dv_id !=', $id);
        $this->db->update('ci_voting');
    }

    function get_one($id)
    {
       $this->db->where('dv_id',$id);
       $result=$this->db->get('ci_voting');
       return $result->row();
    }
    /*  This function get all categories of news from database sort by order asc.*/

    function get_categories()
    {
        $this->db->order_by('dv_id', 'asc');
        $result=$this->db->get('ci_voting');
        return $result->result_array();
    }




    function get_categories_active()
    {
        $this->db->where('dv_state', '1');
        $result=$this->db->get('ci_voting');
        return $result->result_array();
    }

    function get_all_columns($id) {
        $this->db->where('dv_id',$id);
        $this->db->select('A,B,C,D,E,F,G,H,I,J');
        $result=$this->db->get('ci_voting');
        $return = array();
        if ($result->num_rows() > 0) {
            foreach ($result->row_array() as $key=>$value) {
                $return[$key] = $value;
            }
        }

        return $return;
    }

    function is_voted($id)
    {
        $this->db->where('v_voting_id', $id);
        $result = $this->db->get('ci_voting_counter');
        if ($result->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


}