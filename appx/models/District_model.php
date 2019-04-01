
<?php
class District_model extends CI_Model {
// http://programmerblog.net/create-restful-web-services-in-codeigniter/
    public function __construct(){

        $this->load->database();

    }

    //API call - get a book record by isbn
    public function get_district_by_id($id){
//        $this->db->select('id, district_name, state_id');
//        $this->db->from('districts');
//        $this->db->where('id',$id);
//        $query = $this->db->get();
        $sql="select * from districts where id=?";
        $result=$this->db->query($sql,array($id));

        if($result->num_rows() == 1)
        {
            return $result->result_array();
        }
        else
        {
            return 0;
        }
    }
    //API call - get all books record
    public function get_all_districts(){
        $this->db->select('id, district_name, state_id');
        $this->db->from('districts');
        $this->db->order_by("district_name", "desc");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return 0;
        }
    }

    //API call - delete a book record
    public function delete($id){
        $this->db->where('id', $id);
        if($this->db->delete('districts')){
            return true;
        }else{
            return false;
        }
    }

    //API call - add new book record
    public function add($data){
        if($this->db->insert('districts', $data)){
            return true;
        }else{
            return false;
        }
    }

    //API call - update a book record
    public function update($id, $data){
        $this->db->where('id', $id);
        if($this->db->update('districts', $data)){
            return true;
        }else{
            return false;
        }
    }
}