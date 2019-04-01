<?php
class School_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('huiui_helper');
    }

    function select_schools()
    {
        $sql = "select * from school where inforce=1";
        $result = $this->db->query($sql, array());
        return $result;
    }

    function select_school_by_id($id){
        $sql="select * from school where id=?";
        $result = $this->db->query($sql,array($id));
        return $result;
    }

    function delete_school($id){
        $return_array=array();
        try{
            $this->db->query("START TRANSACTION");
            $this->db->trans_start();

            $sql="delete from school WHERE id=?";

            $result=$this->db->query($sql,array($id));

            if($result==FALSE){
                throw new Exception('error deleting student');
            }

            $this->db->trans_complete();
            $return_array['success']=1;
            $return_array['message']='Deleted successful';
        }catch(mysqli_sql_exception $e){
            //$err=(object) $this->db->error();

            $err=(object) $this->db->error();
            $return_array['error']=create_log($err->code,$this->db->last_query(),'student_model','insert_opening',"log_file.csv");
            $return_array['success']=0;
            $return_array['message']='test';
            $this->db->query("ROLLBACK");
        }catch(Exception $e){
            $err=(object) $this->db->error();
            $return_array['error']=create_log($err->code,$this->db->last_query(),'student_model','insert_opening',"log_file.csv");
            // $return_array['error']=mysql_error;
            $return_array['success']=0;
            $return_array['message']=$err->message;
            $this->db->query("ROLLBACK");
        }
        return (object)$return_array;
    }

    function update_school($st){
        $return_array=array();
        try{
            $this->db->query("START TRANSACTION");
            $this->db->trans_start();

            $sql="update school set school_name=? ,board_id=? where id=?";

            $result=$this->db->query($sql,array(
                $st->school_name
                ,$st->board_id
            ,$st->id
            ));

            if($result==FALSE){
                throw new Exception('error updating student');
            }

            $this->db->trans_complete();
            $return_array['success']=1;
            $return_array['message']='Update successful';
        }catch(mysqli_sql_exception $e){
            //$err=(object) $this->db->error();

            $err=(object) $this->db->error();
            $return_array['error']=create_log($err->code,$this->db->last_query(),'purchase_model','insert_opening',"log_file.csv");
            $return_array['success']=0;
            $return_array['message']='test';
            $this->db->query("ROLLBACK");
        }catch(Exception $e){
            $err=(object) $this->db->error();
            $return_array['error']=create_log($err->code,$this->db->last_query(),'purchase_model','insert_opening',"log_file.csv");
            // $return_array['error']=mysql_error;
            $return_array['success']=0;
            $return_array['message']=$err->message;
            $this->db->query("ROLLBACK");
        }
        return (object)$return_array;
    }
    function add_school($st){
        $return_array=array();
        try{
            $this->db->query("START TRANSACTION");
            $this->db->trans_start();

            $sql="insert into school(
                school_name
                ,board_id
                ) values(?,?)";

            $result=$this->db->query($sql,array(
                $st->school_name
                ,$st->board_id
            ));

            if($result==FALSE){
                throw new Exception('error updating student');
            }

            $this->db->trans_complete();
            $return_array['success']=1;
            $return_array['message']='Update successful';
        }catch(mysqli_sql_exception $e){
            //$err=(object) $this->db->error();

            $err=(object) $this->db->error();
            $return_array['error']=create_log($err->code,$this->db->last_query(),'purchase_model','insert_opening',"log_file.csv");
            $return_array['success']=0;
            $return_array['message']='test';
            $this->db->query("ROLLBACK");
        }catch(Exception $e){
            $err=(object) $this->db->error();
            $return_array['error']=create_log($err->code,$this->db->last_query(),'purchase_model','insert_opening',"log_file.csv");
            // $return_array['error']=mysql_error;
            $return_array['success']=0;
            $return_array['message']=$err->message;
            $this->db->query("ROLLBACK");
        }
        return (object)$return_array;
    }

}
?>