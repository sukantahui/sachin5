<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this -> load -> model('person');
        $this -> load -> model('report_model');
        //$this -> is_logged_in();
    }
    function is_logged_in() {
		$is_logged_in = $this -> session -> userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != 1) {
			echo 'you have no permission to use developer area'. '<a href="">Login</a>';
			die();
		}
	}
    function get_products(){
        $result=$this->sale_model->select_inforce_products()->result_array();
        $report_array['records']=$result;
        echo json_encode($report_array);
    }


    public function angular_view_report(){
        ?>
        <style type="text/css">
            .td-input{
                padding: 2px;
                margin-left: 0px;
                margin-right: 0px;
                text-align: right;
            }
            #sale-table th, #sale-table tr td{
                border: 0;
                padding: 0px;
            }
            #sale-table tfoot{
                border-top: 1px solid black;
            }
            .form-control{
                padding: 0 !important;
            }
            .btn{
                padding-top: 0px !important;
                padding-bottom: 0px !important;
                padding-left: 3px !important;
                padding-right: 3px !important;
            }
            .highlightOne {
                background: orange;
                font-size: 125%;
                margin: 5px;
                padding: 5px;
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
        <div class="d-flex col-12">
            <div class="col-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified indigo" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" ng-style="tab==1 && selectedTab" href="#" role="tab" ng-click="setTab(1)"><i class="fas fa-user-graduate"></i></i>Date to date</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" ng-style="tab==2 && selectedTab" href="#" role="tab" ng-click="setTab(2)"><i class="fa fa-envelope"></i>Mustard Oil Sale List </a>
                    </li>
                </ul>
                <!-- Tab panels -->
                <div class="tab-content">
                    <!--Panel 1-->
                    <div ng-show="isSet(1)">
                        <div id="row my-tab-1">
                            <form name="saleForm" class="form-horizontal" id="saleForm">
                                <div class="card" id="sale-master-card">
                                    <div class="d-flex card-header pt-0 pb-0 bg-gray-2">
                                        <div class="d-flex">
                                            <div class="col"><input type="date" class="form-control" ng-model="start_date"></div>
                                            <div class="col ml-1 mr-1">TO</div>
                                            <div class="col"><input type="date" class="form-control" ng-model="end_date"></div>
                                            <div class="col ml-1"><input type="button" class="form-control" value="Submit" ng-click="loadAllReportByDateToDate(start_date,end_date)"></div>
                                        </div>
                                    </div>

                                    <div class="card-body justify-content-center pt-0 pb-0 bg-gray-4">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Mseed inward</th>
                                                <th>Mseed outward</th>
                                                <th>Closing Balance</th>
                                                <th>Produced Moil</th>
                                                <th>Produced Cake</th>
                                                <th>Wastage</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>John</td>
                                                <td>Doe</td>
                                                <td>john@example.com</td>
                                            </tr>
                                            <tr>
                                                <td>Mary</td>
                                                <td>Moe</td>
                                                <td>mary@example.com</td>
                                            </tr>
                                            <tr>
                                                <td>July</td>
                                                <td>Dooley</td>
                                                <td>july@example.com</td>
                                            </tr>
                                            </tbody>
                                        </table>
<!--                                        <pre>reportList={{reportList | json}}</pre>-->
                                    </div>
                                </div>

                            </form>
<!--                            <pre>oilMaster={{oilMaster | json}}</pre>-->

                        </div> <!--//End of my tab1//-->
                    </div>


                </div>
            </div>
        </div>

        <?php
    }



    function get_report_by_date(){
        $post_data =json_decode(file_get_contents("php://input"), true);
        $result=$this->report_model->select_report_details_by_date_to_date($post_data['start_date'],$post_data['end_date'])->result_array();
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);

    }


    function get_sale_by_month(){
        $result=$this->sale_model->select_sale_mont_wise()->result_array();
        echo json_encode($result);

    }









}
?>