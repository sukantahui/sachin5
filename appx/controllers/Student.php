<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this -> load -> model('person');
        $this -> load -> model('Student_model');
        //$this -> is_logged_in();
    }
    function is_logged_in() {
		$is_logged_in = $this -> session -> userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != 1) {
			echo 'you have no permission to use developer area'. '<a href="">Login</a>';
			die();
		}
	}


    public function angular_view_welcome_student_old(){
        ?>
        <style type="text/css">
            #pin {
                -webkit-appearance: none;
                margin: 0;
                -moz-appearance: textfield;
            }


        </style>
        <div class="card" style="height: 100vh;">
            <!-- Nav project -->
            <div class="card-header bg-gray-3">
                <!-- Menu will be here -->
                <?php
                require_once("menu_staff.php");
                ?>
                <ul class="nav nav-tabs nav-justified indigo" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" ng-style="tab==1 && selectedTab" href="#" role="tab" ng-click="setTab(1)"><i class="fa fa-user" ></i> New Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" ng-style="tab==2 && selectedTab" href="#" role="tab" ng-click="setTab(2)"><i class="fa fa-heart"></i> Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" ng-style="tab==3 && selectedTab" href="#" role="tab" ng-click="setTab(3)"><i class="fa fa-envelope"></i>Update Student</a>
                    </li>
                </ul>
            </div>
            <!-- End of Nav project -->
            <div class="card-body">
                 <div id = "inputContainer" class = "inputDemo" ng-cloak ng-show="isSet(1)">
                    <md-content layout-padding>
                        <form name = "studentForm">
                            <div class="d-flex">
                                <div class="col col-md-6 col-sm-12 bg-gray-2 p-3">

                                    <!--Student Name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>Student Name</label>
                                        <input required name = "studentName" ng-model = "student.person_name" >
<!--                                        <div ng-messages = "studentForm.studentName.$error">-->
<!--                                            <div ng-message = "required">This is required.</div>-->
<!--                                        </div>-->
                                    </md-input-container>

                                    <!--Father's Name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>Father's Name</label>
                                        <input required name = "father_name" ng-model = "student.father_name">
<!--                                        <div ng-messages = "studentForm.father_name.$error">-->
<!--                                            <div ng-message = "required">This is required.</div>-->
<!--                                        </div>-->
                                    </md-input-container>

                                    <!--Mother's Name-->
                                    <md-input-container  class = "col-5 md-block p-3">
                                        <label>Mother's Name</label>
                                        <input required name = "mother_name" ng-model = "student.mother_name">
<!--                                        <div ng-messages = "studentForm.mother_name.$error">-->
<!--                                            <div ng-message = "required">This is required.</div>-->
<!--                                        </div>-->
                                    </md-input-container>

                                    <!--sex-->
                                    <md-input-container  class = "col-5 md-block p-2">
                                        <label>Sex</label>
                                    </md-input-container>
                                    <md-radio-group required class="pb-3" ng-model="student.sex" layout="row">
                                        <md-radio-button value="Male" class="md-primary">Male</md-radio-button>
                                        <md-radio-button value="Female" class="md-success"> Female </md-radio-button>
                                    </md-radio-group>

                                    <!--Date of birth-->
                                    <div class="form-group" style="padding-bottom: 25px">
                                        <md-input-container class = "md-block p-1">
                                            <label>Date of Birth</label>
                                        </md-input-container>
                                        <div flex-gt-xs required style="padding: 2px" >
                                            <md-datepicker required name="dob" ng-model="student.dob" ng-change="student.dob=changeDateFormat(student.dob)" md-placeholder="Date of Birth"></md-datepicker>
                                        </div>
                                        <div ng-messages = "studentForm.dob.$error">
                                        </div>
                                    </div>

                                     <!--Address 1-->
                                    <md-input-container class = "md-block p-3">
                                            <label>Address Line 1</label>
                                            <input md-maxlength = "100" required name = "address_line1"
                                                   ng-model = "student.address_line1">
                                            <div ng-messages = "studentForm.address_line1.$error">
<!--                                                <div ng-message = "required">This is required.</div>-->
                                                <div ng-message = "md-maxlength">The Address has to be less
                                                    than 100 characters long.</div>
                                            </div>
                                    </md-input-container>

                                    <!--Address 2-->
                                    <md-input-container class = "md-block p-3">
                                        <label>Address Line 2</label>
                                        <input md-maxlength = "100" name = "address_line2"
                                               ng-model = "student.address_line2">
                                        <div ng-messages = "studentForm.address_line2.$error">
                                            <div ng-message = "md-maxlength">The Address has to be less
                                                than 100 characters long.</div>
                                        </div>
                                    </md-input-container>

                                    <!--police office Name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>PO Name</label>
                                        <input required name = "po" ng-model = "student.po">
                                        <div ng-messages = "studentForm.po.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>

                                    <!--pin number-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>pin</label>
                                        <input type="number" required id="pin" name = "pin" limit-to="6" ng-model = "student.pin">
<!--                                        <div ng-messages = "studentForm.pin.$error">-->
<!--                                            <div ng-message = "required">This is required.</div>-->
<!--                                        </div>-->
                                    </md-input-container>

                                    <!--contact No. 1-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>Contact Number 1</label>
                                        <input required name = "number1" limit-to="10" ng-model = "student.contact1">
<!--                                        <div ng-messages = "studentForm.number1.$error">-->
<!--                                            <div ng-message = "required">This is required.</div>-->
<!--                                        </div>-->
                                    </md-input-container>

                                    <!--contact No. 2-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>Contact Number 2</label>
                                        <input name = "number2" limit-to="10" ng-model = "student.contact2">
                                        <div ng-messages = "studentForm.number2.$error">
                                        </div>
                                    </md-input-container>

                                    <!--Email-->
                                    <md-input-container class = "col-3 md-block p-3">
                                        <label>Email</label>
                                        <input type = "email" name = "userEmail"
                                               ng-model = "student.email"
                                               minlength = "10" maxlength = "100" ng-pattern = "/^.+@.+\..+$/" />
                                        <div ng-messages = "studentForm.email.$error" role = "alert">
                                            <div ng-message-exp = "['minlength', 'maxlength','pattern']">
                                                Your email must be between 10 and 100 characters long and should
                                                be a valid email address.
                                            </div>
                                        </div>
                                    </md-input-container>

                                    <!--board_name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>board</label>
                                        <md-select required name="board" ng-model="student.board" ng-change="selectSchoolsByBoardID(student.board)">
                                            <md-option ng-value="board" ng-repeat="board in allBoards">{{board.board_name}}</md-option>
                                        </md-select>
                                        <div ng-messages = "studentForm.board.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>


                                    <!--school_name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>School</label>
                                        <md-select required name="school" ng-model="student.school" >
                                            <md-option ng-value="school" ng-repeat="school in selectedSchools">{{school.school_name}}</md-option>
                                        </md-select>
                                        <div ng-messages = "studentForm.school.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>

                                    <!--course-->
<!--                                    <md-input-container class = "col-5 md-block p-3">-->
<!--                                        <label>Course</label>-->
<!--                                        <md-select required name="course" ng-model="student.course" >-->
<!--                                            <md-option ng-value="course" ng-repeat="course in allcourse">{{course.cource_name}}</md-option>-->
<!--                                        </md-select>-->
<!--                                        <div ng-messages = "studentForm.course.$error">-->
<!--                                            <div ng-message = "required">This is required.</div>-->
<!--                                        </div>-->
<!--                                    </md-input-container>-->

                                    <md-input-container>
                                        <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
                                            <md-button class="md-raised md-primary" ng-click="saveDataToDatabase(student)" ng-disabled="!studentForm.$valid || submitstudentdisabled">Submit</md-button>
                                            <md-button class="md-raised md-primary" ng-click="updateStudentByStudentId(student)" ng-disabled="!studentForm.$dirty || updateStudentDisabled">Update</md-button>
                                        </section>
                                    </md-input-container>
                                </div>
                                <div class="col bg-gray-3">
                                    <div class="container">
                                        <h1>Listing Example with smart-table and AngularJS</h1>
                                        <div ng-show="loading"><img src="img/waiting.gif"> </div>
                                        <a ng-href="mailto:{{email_address}}?subject={{email_subject}}&amp;body={{email_body}}&amp;cc=janedoe@gmail.com &amp;bcc=billybob@yahoo.com">2 Send email</a>
                                        <div st-toggle-menu></div>
                                        {{ (employees | filter : {'employee_name':'SOHEL'})[0].employee_salary }}
                                        <table class="table table-striped" st-table="allStudents"  st-safe-src="employees">
                                            <thead>
                                            <tr>
                                                <th st-toggle-column st-sort="Student_id">Student od</th>
                                                <th st-toggle-column st-sort="Student_name">Student name</th>
                                                <th st-toggle-column st-sort="contact">Contact</th>
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
                                            <tr ng-repeat="st in allStudents">
                                                <td st-toggle-item>{{st.id | uppercase}}</td>
                                                <td st-toggle-item>{{st.person_name}}</td>
                                                <td st-toggle-item>{{st.contact1}}</td>
                                                <td st-toggle-item><a ng-href="mailto:{{st.email}}?subject=free chocolate">email</a></td>
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
                    </md-content>
                </div>
                <div ng-show="isSet(2)">
                    <div class="col bg-gray-3">
                        <div class="container">
                            <h1>Listing Example with smart-table and AngularJS</h1>
                            <div ng-show="loading"><img src="img/waiting.gif"> </div>
                            <a ng-href="mailto:{{email_address}}?subject={{email_subject}}&amp;body={{email_body}}&amp;cc=janedoe@gmail.com &amp;bcc=billybob@yahoo.com">2 Send email</a>
                            <div st-toggle-menu></div>
<!--                            {{ (employees | filter : {'employee_name':'SOHEL'})[0].employee_salary }}-->
                            <table class="table table-striped" st-table="allStudents" st-safe-src="students">
                                <thead>
                                <tr>
                                    <th st-toggle-column st-sort="Student_id">Student od</th>
                                    <th st-toggle-column st-sort="Student_name">Student name</th>
                                    <th st-toggle-column st-sort="contact">Contact</th>
                                    <th st-toggle-column>email</th>
                                    <th st-toggle-column>update</th>
                                    <th st-toggle-column>delete</th>

                                </tr>
                                <tr>
                                    <th>
                                        <input st-search="Student_name" placeholder="search for Students" class="input-sm form-control" type="search"/>
                                    </th>
                                    <th colspan="4">
                                        <input st-search placeholder="global search" class="input-sm form-control" type="search"/>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="st in allStudents">
                                    <td st-toggle-item>{{st.id | uppercase}}</td>
                                    <td st-toggle-item>{{st.person_name}}</td>
                                    <td st-toggle-item>{{st.contact1}}</td>
                                    <td st-toggle-item><a ng-href="mailto:{{st.email}}?subject=free chocolate">email</a></td>
                                    <td class="text-center" >
                                        <a href="#" ng-click="selectStudentForEdit(st);"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td class="text-center" >
                                        <a href="#" ng-click="deletestudent(st)"><i class="material-icons">delete</i></a>
                                    </td>
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

                </div>
                <div ng-show="isSet(3)" class="d-flex">
                    <div class="col col-md-6 col-sm-12 bg-gray-3">
                        <div class="container">
                            <md-input-container class = "col-5 md-block" ng-show="brdentry">
                                <label>Board Name</label>
                                <input required name = "board_name" ng-model = "board.board_name">
                            </md-input-container>
                            <md-input-container>
                                <section layout="row"  layout-align="end center" layout-wrap>
                                    <md-button class="md-raised md-primary" ng-show="addboard" ng-click="show_add()">Add</md-button>
                                    <md-button class="md-raised md-primary" ng-show="brdsumbit" ng-click="add_board(board)">submit</md-button>
                                    <md-button class="md-raised md-primary" ng-show="brdupdate" ng-click="updateBoard(board)">update</md-button>
                                </section>
                            </md-input-container>
                            <table class="table table-striped" st-table="allBoards">
                                <thead>
                                <tr>
                                    <th st-toggle-column st-sort="board_id">Board ID</th>
                                    <th st-toggle-column st-sort="board_name">Board name</th>
                                    <th st-toggle-column>update</th>
                                    <th st-toggle-column>delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="bn in allBoards">
                                    <td st-toggle-item>{{bn.id }}</td>
                                    <td st-toggle-item>{{bn.board_name}}</td>
                                    <td class="text-center" >
                                        <a href="#" ng-click="editBoard(bn);"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td class="text-center" >
                                        <a href="#" ng-click="deleteBoard(bn)"><i class="material-icons">delete</i></a>
                                    </td>
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
                            <div>
                                <pre>
                                    allBoards={{allBoards | json}};
                                </pre>
                            </div>
                        </div>
                </div>
                    <div class="col col-md-6 col-sm-12 bg-gray-3">
                        <div class="container">

                            <md-input-container class = "col-5 md-block p-3" ng-show="sclentry">
                                <label>School Name</label>
                                <input required name = "school_name" ng-model = "school.school_name">
                            </md-input-container>


                            <md-input-container class = "col-5 md-block p-3" ng-show="brdsclentry">
                                <label>Board Name</label>
                                <md-select required name="board" ng-model="school.board">
                                    <md-option ng-value="board" ng-repeat="board in allBoards">{{board.board_name}}</md-option>
                                </md-select>
                            </md-input-container>


                            <md-input-container>
                                <section layout="row"  layout-align="end center" layout-wrap>
                                    <md-button class="md-raised md-primary" ng-show="addschool" ng-click="show_addsc()">Add</md-button>
                                    <md-button class="md-raised md-primary" ng-show="sclsumbit" ng-click="addSchool(school)">submit</md-button>
                                    <md-button class="md-raised md-primary" ng-show="sclupdate" ng-click="updateSchool(school)">update</md-button>
                                </section>
                            </md-input-container>
                            <table class="table table-striped" st-table="allSchools">
                                <thead>
                                <tr>
                                    <th st-toggle-column st-sort="school_id">School ID</th>
                                    <th st-toggle-column st-sort="board_name">School name</th>
                                    <th st-toggle-column>update</th>
                                    <th st-toggle-column>delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="sc in allSchools">
                                    <td st-toggle-item>{{sc.id }}</td>
                                    <td st-toggle-item>{{sc.school_name}}</td>
                                    <td class="text-center" >
                                        <a href="#" ng-click="editSchool(sc);"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td class="text-center" >
                                        <a href="#" ng-click="deleteSchool(sc)"><i class="material-icons">delete</i></a>
                                    </td>
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
                            <div>
                                <pre>
                                    allSchools={{allSchools | json}};
                                </pre>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <?php
    }

    function get_boards(){
        // in $post_data will store all the parameters in the query string
        $post_data =json_decode(file_get_contents("php://input"), true);


        $result=$this->Student_model->select_boards()->result();
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);

    }

    function get_Schools(){
        // in $post_data will store all the parameters in the query string
        $post_data =json_decode(file_get_contents("php://input"), true);

         $result = $this->Student_model->select_schools()->result();
         $report_array['records'] = $result;
         echo json_encode($report_array, JSON_NUMERIC_CHECK);
    }

    function get_Course(){
        // in $post_data will store all the parameters in the query string
        $post_data =json_decode(file_get_contents("php://input"), true);


        $result=$this->Student_model->select_course()->result();
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);

    }

    function save_new_student(){
        $post_data =json_decode(file_get_contents("php://input"), true);
        $result=$this->Student_model->insert_new_student((object)$post_data);
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);
    }
    public function angular_view_welcome_student(){
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
                                        <!--Student Name-->
                                        <md-input-container class = "col-5 md-block p-3">
                                            <label>Student Name</label>
                                            <input required name = "studentName" ng-model = "student.name" >
                                            <div ng-messages = "studentForm.studentName.$error">
                                                <div ng-message = "required">This is required.</div>
                                            </div>
                                        </md-input-container>

                                        <!--Father's Name-->
                                        <md-input-container class = "col-5 md-block p-3">
                                            <label>Father's Name</label>
                                            <input required name = "father_name" ng-model = "student.father_name">
                                            <div ng-messages = "studentForm.father_name.$error">
                                                <div ng-message = "required">This is required.</div>
                                            </div>
                                        </md-input-container>

                                        <!--Mother's Name-->
                                        <md-input-container  class = "col-5 md-block p-3">
                                            <label>Mother's Name</label>
                                            <input required name = "mother_name" ng-model = "student.mother_name">
                                            <div ng-messages = "studentForm.mother_name.$error">
                                                <div ng-message = "required">This is required.</div>
                                            </div>
                                        </md-input-container>

                                        <!--Address 1-->
                                        <md-input-container class = "md-block p-3">
                                            <label>Address Line 1</label>
                                            <input md-maxlength = "100" required name = "address_line1"
                                                   ng-model = "student.address_line1">
                                            <div ng-messages = "studentForm.address_line1.$error">
                                                <div ng-message = "required">This is required.</div>
                                                <div ng-message = "md-maxlength">The Address has to be less
                                                    than 100 characters long.</div>
                                            </div>
                                        </md-input-container>

                                        <!--Address 2-->
                                        <md-input-container class = "md-block p-3">
                                            <label>Address Line 2</label>
                                            <input md-maxlength = "100" name = "address_line2"
                                                   ng-model = "student.address_line2">
                                            <div ng-messages = "studentForm.address_line2.$error">
                                                <div ng-message = "md-maxlength">The Address has to be less
                                                    than 100 characters long.</div>
                                            </div>
                                        </md-input-container>

                                        <!--police station Name-->
                                        <md-input-container class = "col-5 md-block p-3">
                                            <label>PS Name</label>
                                            <input required name = "ps" ng-model = "student.ps_name">
                                            <div ng-messages = "studentForm.ps.$error">
                                                <div ng-message = "required">This is required.</div>
                                            </div>
                                        </md-input-container>

                                        <!--pin number-->
                                        <md-input-container class = "col-5 md-block p-3">
                                            <label>pin</label>
                                            <input type="number" required id="pin" name = "pin" ng-model = "student.pin">
                                            <div ng-messages = "studentForm.pin.$error">
                                                <div ng-message = "required">This is required.</div>
                                            </div>
                                        </md-input-container>

                                        <!--contact No. 1-->
                                        <md-input-container class = "col-5 md-block p-3">
                                            <label>Contact Number 1</label>
                                            <input required name = "number1" ng-model = "student.contact1">
                                            <div ng-messages = "studentForm.number1.$error">
                                                <div ng-message = "required">This is required.</div>
                                            </div>
                                        </md-input-container>

                                        <!--contact No. 2-->
                                        <md-input-container class = "col-5 md-block p-3">
                                            <label>Contact Number 2</label>
                                            <input name = "number2" ng-model = "student.contact2">
                                            <div ng-messages = "studentForm.number2.$error">
                                            </div>
                                        </md-input-container>

                                        <!--Email-->
                                        <md-input-container class = "col-3 md-block p-3">
                                            <label>Email</label>
                                            <input type = "email" name = "userEmail"
                                                   ng-model = "student.email"
                                                   minlength = "10" maxlength = "100" ng-pattern = "/^.+@.+\..+$/" />
                                            <div ng-messages = "studentForm.userEmail.$error" role = "alert">
                                                <div ng-message-exp = "['minlength', 'maxlength','pattern']">
                                                    Your email must be between 10 and 100 characters long and should
                                                    be a valid email address.
                                                </div>
                                            </div>
                                        </md-input-container>

                                        <!--board_name-->
                                        <md-input-container class = "col-5 md-block p-3">
                                            <label>board</label>
                                            <md-select required name="board" ng-model="student.board" ng-change="selectSchoolsByBoardID(student.board)">
                                                <md-option ng-value="board" ng-repeat="board in allBoards">{{board.board_name}}</md-option>
                                            </md-select>
                                            <div ng-messages = "studentForm.board.$error">
                                                <div ng-message = "required">This is required.</div>
                                            </div>
                                        </md-input-container>


                                        <!--school_name-->
                                        <md-input-container class = "col-5 md-block p-3">
                                            <label>School</label>
                                            <md-select required name="school" ng-model="student.school" >
                                                <md-option ng-value="school" ng-repeat="school in selectedSchools">{{school.school_name}}</md-option>
                                            </md-select>
                                            <div ng-messages = "studentForm.school.$error">
                                                <div ng-message = "required">This is required.</div>
                                            </div>
                                        </md-input-container>

                                        <!--course-->
                                        <!--                                    <md-input-container class = "col-5 md-block p-3">-->
                                        <!--                                        <label>Course</label>-->
                                        <!--                                        <md-select required name="course" ng-model="student.course" >-->
                                        <!--                                            <md-option ng-value="course" ng-repeat="course in allcourse">{{course.cource_name}}</md-option>-->
                                        <!--                                        </md-select>-->
                                        <!--                                        <div ng-messages = "studentForm.course.$error">-->
                                        <!--                                            <div ng-message = "required">This is required.</div>-->
                                        <!--                                        </div>-->
                                        <!--                                    </md-input-container>-->

                                        <md-input-container>
                                            <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
                                                <md-button class="md-raised md-primary" ng-click="saveDataToDatabase(student)" ng-disabled="!studentForm.$valid">Submit</md-button>
                                            </section>
                                        </md-input-container>

                                <div class="col bg-gray-3">
                                    <div class="container">
                                        <h1>Listing Example with smart-table and AngularJS</h1>
                                        <div ng-show="loading"><img src="img/waiting.gif"> </div>
                                        <a ng-href="mailto:{{email_address}}?subject={{email_subject}}&amp;body={{email_body}}&amp;cc=janedoe@gmail.com &amp;bcc=billybob@yahoo.com">2 Send email</a>
                                        <div st-toggle-menu></div>
                                        {{ (employees | filter : {'employee_name':'SOHEL'})[0].employee_salary }}
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
                                                <td st-toggle-item>{{row.person_name | uppercase}}</td>
                                                <td st-toggle-item>{{row.dob}}</td>
                                                <td st-toggle-item>{{row.po}}</td>
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
}
?>