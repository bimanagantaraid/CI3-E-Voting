<?php

class My_Form_Validation extends CI_Form_validation
{
    public function __construct($rules = array())
    {
        $this->CI = &get_instance();
        parent::__construct($rules);
    }
    public function edit_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $user_id);
        if(isset($this->CI->db)){
            $dataOld = $this->CI->db->where('user_id', $user_id)->get('user')->row_array();
            if($dataOld['username'] == $str){
                return TRUE;
            }
            if (password_verify($str, $dataOld['password'])){
                return TRUE;
            } else {
                return FALSE;
            }

            if ($dataOld['email'] == $str){
                return TRUE;
            }

            if($this->CI->db->limit(1)->get_where($table, array($field => $str, 'user_id !=' => $user_id))->num_rows()){
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
}
