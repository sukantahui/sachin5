<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->model('Board_model');
        $this->load->model('School_model');
    }
    /******************************************  API for disstricts ***********************************************/
    //API -  Fetch Districts
    function districts_get()
    {
        //$id  = $this->get('id');
        $id = $this->uri->segment(3);
        if (!$id) {
            $result = $this->District_model->get_all_districts();
            if ($result) {
                echo json_encode($result, JSON_NUMERIC_CHECK);
                //$this->response($result, 200);
            } else {
                $this->response("No record found", 404);
            }
        } else {
            $result = $this->District_model->get_district_by_id($id);
            if ($result) {
                //$this->response($result, 200);
                echo json_encode($result, JSON_NUMERIC_CHECK);
            } else {
                $this->response("Invalid id", 404);
            }
        }
    }

    //API - create a new district
    function districts_post()
    {
        $name = $this->post('district_name');
        $state_id = $this->post('state_id');


        if (!$name || !$state_id) {
            $this->response("Enter the district details to save", 400);
        } else {
            $result = $this->District_model->add(array("district_name" => $name, "state_id" => $state_id));
            if ($result === 0) {
                $this->response("District coild not be saved. Try again.", 404);
            } else {
                $this->response("success", 200);
            }
        }
    }

    //API - update district
    function districts_put()
    {

        $district_name = $this->put('district_name');
        $state_id = $this->put('state_id');
        $id = $this->put('id');

        if (!$district_name || !$state_id || !$id) {
            $this->response("Enter complete District information to update" . $id, 400);
        } else {
            $result = $this->District_model->update($id, array("district_name" => $district_name, "state_id" => $state_id));
            if ($result === 0) {
                $this->response("District could not be updated. Try again.", 404);
            } else {
                $this->response("success", 200);
            }
        }
    }

    //API - delete district
    function districts_delete()
    {
        $id = $this->uri->segment(3);
        if (!$id) {
            $this->response("Parameter missing for delete", 404);
        }

        if ($this->District_model->delete($id)) {
            $this->response("Success", 200);
        } else {
            $this->response("Failed", 400);
        }
    }
    /******************************************  API for disstricts ***********************************************/

    /******************************************  API for Customers ***********************************************/
    //API -  Fetch Customers
    function students_get()
    {
        $student_id = $this->uri->segment(3);
        // $student_id = $this->get('id');
        // $this->response($student_id, 200);
        if (!$student_id) {
            $result = $this->Student_model->select_students()->result_array();
            if ($result) {
                echo json_encode($result, JSON_NUMERIC_CHECK);
                //$this->response($result, 200);
            } else {
                $this->response("No record found", 404);
            }
        } else {
            $result = $this->Student_model->select_student_by_id($student_id)->result_array();
            if ($result) {
                //$this->response($result, 200);
                echo json_encode($result, JSON_NUMERIC_CHECK);
            } else {
                $this->response("Invalid id", 404);
            }
        }
    }

    //API - create a new student
    function students_post()
    {
        $student = array();
        $student['person_name'] = $this->post('person_name');
        $student['sex'] = $this->post('sex');
        $student['email'] = $this->post('email');
        $student['address_line1'] = $this->post('address_line1');
        $student['address_line2'] = $this->post('address_line2');
        $student['father_name'] = $this->post('father_name');
        $student['mother_name'] = $this->post('mother_name');
        $student['dob'] = $this->post('dob');
        $student['po'] = $this->post('po');
        $student['pin'] = $this->post('pin');
//        $customer['state']= $this->post('state');
        $student['contact1'] = $this->post('contact1');
        $student['contact2'] = $this->post('contact2');
        $student['school_id'] = $this->post('school_id');


        if (!$student['person_name']) {
            $this->response("Enter the student details to save", 400);
        } else {
            $result = $this->Student_model->add_student((object)$student);
            if ($result === 0) {
                $this->response("District could not be saved. Try again.", 404);
            } else {
                $this->response($result, 200);
            }
        }
    }

    //API - update Customer
    function students_put()
    {

        $student = array();
//        $student['id']=$this->uri->segment(3);
        $student['id'] = $this->put('student_id');
        $student['person_name'] = $this->put('person_name');
        $student['sex'] = $this->put('sex');
        $student['email'] = $this->put('email');
        $student['address_line1'] = $this->put('address_line1');
        $student['address_line2'] = $this->put('address_line2');
        $student['father_name'] = $this->put('father_name');
        $student['mother_name'] = $this->put('mother_name');
        $student['dob'] = $this->put('dob');
        $student['po'] = $this->put('po');
        $student['pin'] = $this->put('pin');
//        $customer['state']= $this->post('state');
        $student['contact1'] = $this->put('contact1');
        $student['contact2'] = $this->put('contact2');
        $student['school_id'] = $this->put('school_id');

//        if(count($customer)!=12){
//            $this->response("Enter customer details to save ".count($customer), 400);
//        }

        if (!$student['person_name']) {
            $this->response("Enter complete District information to update", 400);
        } else {
            $result = $this->Student_model->student_update((object)$student);
            if ($result === 0) {
                $this->response("District could not be updated. Try again.", 404);
            } else {
                $this->response($result, 200);
            }
        }
    }

    function students_delete()
    {
        $student_id = $this->uri->segment(3);
        $result = $this->Student_model->delete_Student($student_id);
        if (!$student_id) {
            $this->response("Parameter missing for delete", 404);
        }

        if ($this->Student_model->delete_Student($student_id)) {
            $this->response($result, 200);
        } else {
            $this->response($result, 400);
        }
    }


    /******************************************  End of API for Students ***********************************************/


    function boards_get()
    {
        $board_id = $this->uri->segment(3);
        if (!$board_id) {
            $result = $this->Board_model->select_boards()->result_array();
            if ($result) {
                echo json_encode($result, JSON_NUMERIC_CHECK);
                //$this->response($result, 200);
            } else {
                $this->response("No record found", 404);
            }
        } else {
            $result = $this->Board_model->select_board_by_id($board_id)->result_array();
            if ($result) {
                //$this->response($result, 200);
                echo json_encode($result, JSON_NUMERIC_CHECK);
            } else {
                $this->response("Invalid id", 404);
            }
        }
    }

    function boards_post()
    {
        $boards = array();
        $boards['board_name'] = $this->post('board_name');
        if (!$boards['board_name']) {
            $this->response("Enter the board details to save", 400);
        } else {
            $result = $this->Board_model->add_board((object)$boards);
            if ($result === 0) {
                $this->response("District could not be saved. Try again.", 404);
            } else {
                $this->response($result, 200);
            }
        }
    }

    function boards_put()
    {
        $boards = array();
        $boards['board_name'] = $this->put('board_name');
        $boards['id'] = $this->put('id');
        if (!$boards['board_name']) {
            $this->response("Enter the board details to save", 400);
        } else {
            $result = $this->Board_model->update_board((object)$boards);
            if ($result === 0) {
                $this->response("District could not be saved. Try again.", 404);
            } else {
                $this->response($result, 200);
            }
        }
    }

    function boards_delete()
    {
        $board_id = $this->uri->segment(3);
        $result = $this->Board_model->delete_board($board_id);
        if (!$board_id) {
            $this->response("Parameter missing for delete", 404);
        }

        if ($this->Board_model->delete_board($board_id)) {
            $this->response($result, 200);
        } else {
            $this->response($result, 400);
        }
    }

    function schools_get(){
        $school_id = $this->uri->segment(3);
        if(!$school_id) {
            $result = $this->School_model->select_schools()->result_array();
            if ($result) {
                echo json_encode($result,JSON_NUMERIC_CHECK);
                //$this->response($result, 200);
            } else {
                $this->response("No record found", 404);
            }
        }else{
            $result = $this->School_model->select_school_by_id($school_id)->result_array();
            if($result){
                //$this->response($result, 200);
                echo json_encode($result,JSON_NUMERIC_CHECK);
            }else{
                $this->response("Invalid id", 404);
            }
        }
    }

    function schools_post()
    {
        $schools = array();
        $schools['school_name'] = $this->post('school_name');
        $schools['board_id'] = $this->post('board_id');
        if (!$schools['school_name']) {
            $this->response("Enter the board details to save", 400);
        } else {
            $result = $this->School_model->add_school((object)$schools);
            if ($result === 0) {
                $this->response("District could not be saved. Try again.", 404);
            } else {
                $this->response($result, 200);
            }
        }
    }

    function schools_put()
    {
        $schools = array();
        $schools['school_name'] = $this->put('school_name');
        $schools['board_id'] = $this->put('board_id');
        $schools['id'] = $this->put('id');
        if (!$schools['school_name']) {
            $this->response("Enter the board details to save", 400);
        } else {
            $result = $this->School_model->update_school((object)$schools);
            if ($result === 0) {
                $this->response("District could not be saved. Try again.", 404);
            } else {
                $this->response($result, 200);
            }
        }
    }

    function schools_delete()
    {
        $school_id = $this->uri->segment(3);
        $result = $this->School_model->delete_school($school_id);
        if (!$school_id) {
            $this->response("Parameter missing for delete", 404);
        }

        if ($this->School_model->delete_school($school_id)) {
            $this->response($result, 200);
        } else {
            $this->response($result, 400);
        }
    }
}