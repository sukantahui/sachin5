<?php
class Board_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('huiui_helper');
    }

    function select_boards()
    {
        $sql = "select id,board_name from board where inforce=1 ";
        $result = $this->db->query($sql, array());
        return $result;
    }

    function select_board_by_id($id){
        $sql="select * from board where id=?";
        $result = $this->db->query($sql,array($id));
        return $result;
    }

    function delete_board($id){
        $return_array=array();
        try{
            $this->db->query("START TRANSACTION");
            $this->db->trans_start();

            $sql="delete from board WHERE id=?";

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

    function update_board($st){
        $return_array=array();
        try{
            $this->db->query("START TRANSACTION");
            $this->db->trans_start();

            $sql="update board set board_name=? where id=?";

            $result=$this->db->query($sql,array(
                $st->board_name
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
    function add_board($st){
        $return_array=array();
        try{
            $this->db->query("START TRANSACTION");
            $this->db->trans_start();

            $sql="insert into board(
                board_name
                ) values(?)";

            $result=$this->db->query($sql,array(
                $st->board_name
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