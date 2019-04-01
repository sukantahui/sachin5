<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this -> load -> model('person');
        $this -> load -> model('customer_model');
        $this -> load -> model('Student_model');
//        $this -> is_logged_in();
    }
    function is_logged_in() {
		$is_logged_in = $this -> session -> userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != 1) {
			echo 'you have no permission to use developer area'. '<a href="">Login</a>';
			die();
		}
	}


    public function angular_view_customer(){
        ?>
        <style type="text/css">
            body{
                background-color: #1b1e21;
            }
            #others-area{
                height: 100vh;
                width: 99vw;
            }
            .ui-menu-item{
                background-color: #868e96;
                width: 10vw;
                list-style: none;
                margin-left: 5px;
            }
            /*.pagination a{*/
                /*padding: 3px;*/
                /*background-color: #2e8ece;*/
                /*color: white;*/
                /*margin-right: 2px;*/
            /*}*/
            .select-page {
                width: 50px;
                text-align: center;
            }
            .pagination li a input {
                padding: 0;
                margin: -5px 0;
            }
            .pagination{

            }
            .pagination li{
                height: 20px;
                border-radius: 4px;
                background-color: #1b1e21;
            }
        </style>
        <div class="card" id="others-area" style="overflow-y: auto">
            <div class="card-header bg-gray-3">
                <!-- Menu will be here -->
                <?php
                require_once("menu_staff.php");
                ?>
                <ul class="nav nav-tabs nav-justified indigo" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#" role="tab" ng-click="setTab(1)"><i class="fa fa-user" ></i> New Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#" role="tab" ng-click="setTab(2)"><i class="fa fa-heart"></i> Customer List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#" role="tab" ng-click="setTab(3)"><i class="fa fa-envelope"></i>Update Customers</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-contet">
                    <!--Panel 1-->
                    <div class="" ng-show="isSet(1)">
                        <form name="customerForm">
                            <div class="d-flex">
                                <div class="col col-md-6 col-sm-12 p-3 ">
                                    <div layout-gt-sm="row">
                                        <!--Customer Name  -->
                                        <md-input-container class = "col-8 bigClass md-block  p-3">
                                            <label>Customer Name </label>
                                            <input capitalize  name = "personName"  ng-model = "customer.person_name" ng-blur="copyToMailingName(customer.person_name);" required  md-maxlength = "100">
                                            <div ng-messages = "customerForm.personName.$error">
                                                <div ng-message = "required">This is required.</div>
                                                <div ng-message = "md-maxlength">The Address has to be less than 100 characters long.</div>
                                            </div>
                                        </md-input-container>
                                    </div>

                                    <!--Customer Mailing Name  -->
                                    <md-input-container class = "col-8 bigClass md-block  p-3">
                                        <label>Mailing Name</label>
                                        <input capitalize  name = "mailingName"  ng-model = "customer.mailing_name" required  md-maxlength = "100">
                                        <div ng-messages = "customerForm.mailingName.$error">
                                            <div ng-message = "required">This is required.</div>
                                            <div ng-message = "md-maxlength">The Address has to be less than 100 characters long.</div>
                                        </div>
                                    </md-input-container>

                                    <!--Address 1-->
                                    <md-input-container class = "col-8 md-block bigClass p-3">
                                        <label>Address Line 1</label>
                                        <input capitalize required name = "addressLine1" ng-model = "customer.address_line1"   md-maxlength = "200">
                                        <div ng-messages = "customerForm.addressLine1.$error">
                                            <div ng-message = "required">This is required.</div>
                                            <div ng-message = "md-maxlength">The Address has to be less than 100 characters long.</div>
                                        </div>
                                    </md-input-container>

                                    <!--Address 2-->
                                    <md-input-container class = "col-8 md-block bigClass p-3">
                                        <label>Address Line 2</label>
                                        <input capitalize required name = "addressLine2" ng-model = "customer.address_line2"   md-maxlength = "200">
                                        <div ng-messages = "customerForm.addressLine2.$error">
                                            <div ng-message = "required">This is required.</div>
                                            <div ng-message = "md-maxlength">The Address has to be less than 100 characters long.</div>
                                        </div>
                                    </md-input-container>

                                    <!-- City state District -->
                                    <div layout-gt-sm="row">
                                        <!-- City -->
                                        <md-input-container class="col-3 md-block bigClass"  flex-gt-sm>
                                            <label>City</label>
                                            <input ng-model="customer.city" id="city" ng-keyup="completeCity()">
                                        </md-input-container>

                                        <!-- State -->
                                        <md-input-container class="col-3 md-block" flex-gt-sm>
                                            <label>State</label>
                                            <md-select ng-model = "customer.state_n_district">
                                                <md-optgroup label = "Select states">
                                                    <md-option
                                                            ng-value = "state_n_district"
                                                            ng-repeat = "state_n_district in states_n_districts"
                                                            ng-selected="states_n_districts.indexOf(state_n_district) == states_n_districts.findIndex(x => x.state === 'West Bengal')">
                                                        {{state_n_district.state}}</md-option>
                                                </md-optgroup>
                                            </md-select>
                                        </md-input-container>
                                        <!-- Districts , 11 is the index of Kolkata -->
                                        <md-input-container class="col-3 md-block" flex-gt-sm>
                                            <label>Districts</label>
                                            <md-select ng-model = "customer.district">
                                                <md-optgroup label = "Select states">
                                                    <md-option ng-value = "district"
                                                               ng-repeat = "district in customer.state_n_district.districts"
                                                               ng-selected="customer.state_n_district.districts.indexOf(district)==11">
                                                        {{district}}</md-option>
                                                </md-optgroup>
                                            </md-select>
                                        </md-input-container>
                                    </div>
                                    <div layout-gt-sm="row">
                                        <!-- Post Office -->
                                        <md-input-container class="col-3 md-block bigClass"  flex-gt-sm>
                                            <label>Post Office</label>
                                            <input ng-model="customer.po" id="po" ng-keyup="completePostOffice()">
                                        </md-input-container>
                                        <!--PIN-->
                                        <md-input-container class="col-3 md-block bigClass" flex-gt-sm>
                                            <label>Postal Code</label>
                                            <input limit-to="6" numbers-only name="pin" ng-model="customer.pin" required ng-pattern="/^[0-9]{6}$/" md-maxlength="6">
                                            <div ng-messages="customerForm.pin.$error" role="alert" multiple>
                                                <div ng-message="required" class="my-message">You must supply a postal code.</div>
                                                <div ng-message="pattern" class="my-message">That doesn't look like a valid postal
                                                    code.
                                                </div>
                                                <div ng-message="md-maxlength" class="my-message">
                                                    PIN should be within 6 numbers
                                                </div>
                                            </div>
                                        </md-input-container>
                                    </div>

                                    <div layout-gt-sm="row">
                                        <!-- Phone 1 -->
                                        <md-input-container class="col-3 md-block bigClass" flex-gt-sm>
                                            <label>Phone No. 1</label>
                                            <input limit-to="10" numbers-only name="contact_1" ng-model="customer.contact_1" required ng-pattern="/^[0-9]{10}$/" md-maxlength="10">
                                            <div ng-messages="customerForm.contact_1.$error" role="alert" multiple>
                                                <div ng-message="required" class="my-message">You must supply a Phone Number</div>
                                                <div ng-message="pattern" class="my-message">That doesn't look like a valid Phone Number
                                                </div>
                                                <div ng-message="md-maxlength" class="my-message">
                                                    Phone should be within 10 numbers
                                                </div>
                                            </div>
                                        </md-input-container>
                                        <!-- Phone 2 -->
                                        <md-input-container class="col-3 md-block bigClass" flex-gt-sm>
                                            <label>Phone No. 2</label>
                                            <input limit-to="10" numbers-only name="contact_2" ng-model="customer.contact_2"  ng-pattern="/^[0-9]{10}$/" md-maxlength="10">
                                            <div ng-messages="customerForm.contact_2.$error" role="alert" multiple>
                                                <div ng-message="required" class="my-message">You must supply a Phone Number</div>
                                                <div ng-message="pattern" class="my-message">That doesn't look like a valid Phone Number
                                                </div>
                                                <div ng-message="md-maxlength" class="my-message">
                                                    Phone should be within 10 numbers
                                                </div>
                                            </div>
                                        </md-input-container>
                                    </div>
                                    <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
                                        <md-button class="md-raised md-primary" ng-disabled="!customerForm.$valid">Save</md-button>
                                    </section>
                                </div>

                                <div class="col bg-gray-3">
                                    <div class="container">
                                        <h1>Listing Example with smart-table and AngularJS</h1>
                                        <div ng-show="loading"><img src="img/waiting.gif"> </div>
                                        <a ng-href="mailto:{{email_address}}?subject={{email_subject}}&amp;body={{email_body}}&amp;cc=janedoe@gmail.com &amp;bcc=billybob@yahoo.com">2 Send email</a>
                                        <div st-toggle-menu></div>
                                        {{ (employees | filter : {'employee_name':'PRABHU'})[0].employee_salary }}
                                        <table class="table table-striped" st-table="displayed"  st-safe-src="employees">
                                            <thead>
                                            <tr>
                                                <th st-toggle-column st-sort="employee_name">first name</th>
                                                <th st-toggle-column st-sort="employee_salary">last name</th>
                                                <th st-toggle-column st-sort="employee_age">birth date</th>
                                                <th st-toggle-column>email</th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <input st-search="employee_name" placeholder="search for Employee" class="input-sm form-control" type="search"/>
                                                </th>
                                                <th colspan="4">
                                                    <input st-search placeholder="global search" class="input-sm form-control" type="search"/>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="row in displayed">
                                                <td st-toggle-item>{{row.employee_name | uppercase}}</td>
                                                <td st-toggle-item>{{row.employee_salary}}</td>
                                                <td st-toggle-item>{{row.employee_age}}</td>
                                                <td st-toggle-item><a ng-href="mailto:{{row.email}}?subject=free chocolate">email</a></td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <div st-items-by-page="10" st-pagination="" st-template="view/pagination.custom.html"></div>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>

                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="" ng-show="isSet(2)">
                        This is div 2
                    </div>
                    <div class="" ng-show="isSet(3)">
                        This is div 3
                    </div>

                </div>
            </div>
            <div class="card-footer" ng-show="showDeveloperArea">
                <div class="d-flex">
                    <div class="col bg-gray-3">
                        This is development area dfgsdfg
                    </div>
                    <div class="col bg-gray-4">
                        sdfgsdf
                    </div>
                    <div class="col bg-gray-5">
                        ghdfgh
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public function insert_customer(){
        $post_data =json_decode(file_get_contents("php://input"), true);
        $result=$this->customer_model->insert_new_customer((object)$post_data['customer']);
        $report_array['records']=$result;
        echo json_encode($report_array);
    }
    public function get_customers(){
        $result=$this->customer_model->select_customers()->result_array();
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);
    }
    public function get_states(){
        $result=$this->customer_model->select_states()->result_array();
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);
    }
    public function update_customer_by_customer_id(){
        $post_data =json_decode(file_get_contents("php://input"), true);
        $result=$this->customer_model->update_customer_by_customer_id((object)$post_data['customer']);
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);
    }


}
?>