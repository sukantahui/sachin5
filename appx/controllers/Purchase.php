<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this -> load -> model('student_model');
        $this -> load -> model('purchase_model');
        //$this -> is_logged_in();
    }
    function is_logged_in() {
		$is_logged_in = $this -> session -> userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != 1) {
			echo 'you have no permission to use developer area'. '<a href="">Login</a>';
			die();
		}
	}


    public function angular_view_purchase(){
        ?>
        <style type="text/css">
            .td-input-left{
                padding: 0.175rem !important;
                margin-left: 0px;
                margin-right: 0px;
                text-align: right;
            }

            .td-input-right{
                padding: 0.175rem !important;
                margin-left: 0px;
                margin-right: 0px;
                text-align: right;
            }

            #purchase-table th, #purchase-table tr td{
                border: 0;
            }
            #panel-heading{
                margin-left: 0px !important;
                padding-left: 0px !important;
            }
            md-input-container label{
                color: red;
            }

           
        </style>
        <div class="d-flex">
            <div class="p-2 my-flex-item col-12">
                <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                    <!-- Brand -->
                    <a class="navbar-brand" href="#">Logo</a>

                    <!-- Links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#!staffArea">Back <i class="fas fa-home"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
                        <md-content md-theme="docs-dark" layout-gt-sm="row" layout-padding>
                            <div>
                            <md-input-container>
                                <label>Title</label>
                                <input ng-model="user.title">
                            </md-input-container>

                            <md-input-container>
                                <label>Email</label>
                                <input ng-model="user.email" type="email">
                            </md-input-container>
                            </div>
                        </md-content>

       
        <?php
    }

    function save_new_purchase(){
        $post_data =json_decode(file_get_contents("php://input"), true);
        $purchase_master=(object)$post_data['purchase_master'];
        $purchase_details_list=(object)$post_data['purchase_details_list'];
        $result=$this->purchase_model->insert_new_purchase($purchase_master,$purchase_details_list);
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);
    }
    function update_saved_purchase(){
        $post_data =json_decode(file_get_contents("php://input"), true);
        $purchase_master=(object)$post_data['purchase_master'];
        $purchase_details_list=(object)$post_data['purchase_details_list'];
        $result=$this->purchase_model->update_purchase_master_details($purchase_master,$purchase_details_list);
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);

    }
    function get_all_purchase(){
        $result=$this->purchase_model->select_all_purchase()->result_array();
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);

    }
    function get_purchase_details_by_purchase_master_id(){
        $post_data =json_decode(file_get_contents("php://input"), true);
        $result=$this->purchase_model->select_purchase_details_by_purchase_master_id($post_data['purchase_master_id'])->result_array();
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);

    }
    function get_purchase_master_by_purchase_master_id(){
        $post_data =json_decode(file_get_contents("php://input"), true);
        $result=$this->purchase_model->select_purchase_master_by_purchase_master_id($post_data['purchase_master_id']);
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);

    }
}
?>