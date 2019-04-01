app.controller("studentCtrl", function ($scope,$http,$filter,$timeout,dateFilter,$rootScope,studentService,MessageService,$mdDialog,boardService,schoolService) {
    $scope.msg = "This is student controller";
    //Tab area
    $scope.tab = 1;
    $scope.submitstudentdisabled=false;
    $scope.setTab = function(newTab){
        $scope.tab = newTab;
    };
    $scope.isSet = function(tabNum){
        return $scope.tab === tabNum;
    };
    $scope.addboard=true;
    $scope.brdsumbit=false;
    $scope.brdupdate=false;
    $scope.brdentry=false;

    $scope.addschool=true;
    $scope.sclsumbit=false;
    $scope.sclupdate=false;
    $scope.sclentry=false;
    $scope.brdsclentry=false;


    $scope.selectedTab = {
        "color" : "white",
        "background-color" : "coral",
        "font-size" : "15px",
        "padding" : "5px"
    };

    //End of tab area
    $scope.message=MessageService;

    $scope.showDeveloperArea=true;
    $scope.updateStudentDisabled=true;

    $scope.student={address_line2:"",email:""};
    $scope.board={};
    $scope.school={};



    $scope.getSearchItem=function(searchItem){
        if(searchItem=="show-dev"){
            $scope.showDeveloperArea=!$scope.showDeveloperArea;
        }
    }


    $scope.changeDateFormat=function(userDate) {
        return moment(userDate).format('YYYY-MM-DD');
    }

    // $scope.loadSchools=function(){
    //     var request = $http({
    //         method: "post",
    //         url: site_url+"/Student/get_Schools",
    //         data: {
    //         }
    //         ,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    //     }).then(function(response){
    //         $scope.allschools=response.data.records;
    //     });
    // };
    // //calling loadSchools
    // $scope.loadSchools();

    // $scope.loadCourse=function(){
    //     var request = $http({
    //         method: "post",
    //         url: site_url+"/Student/get_Course",
    //         data: {
    //         }
    //         ,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    //     }).then(function(response){
    //         $scope.allcourse=response.data.records;
    //     });
    // };
    //calling loadCourse
    // $scope.loadCourse();
    $scope.selectStudentForEdit=function(tempStudent){
        $scope.updateStudentDisabled=false;
        angular.copy(tempStudent,$scope.student);
        $scope.submitstudentdisabled=true;
        $scope.tab=1;
        $scope.updateableStudentIndex=$scope.students.findIndex(x=>x.id===tempStudent.id);
         //$scope.allStudents[index]=student;
        //console.log(updateableStudentIndex);
        var index=$scope.allBoards.findIndex(x=>x.board_name===tempStudent.board_name);
        $scope.student.board=$scope.allBoards[index];
        $scope.selectSchoolsByBoardID($scope.student.board);
        var indexSchool=$scope.selectedSchools.findIndex(x=>x.school_name===tempStudent.school_name);
        $scope.student.school=$scope.selectedSchools[indexSchool];
    }

    $scope.selectSchoolsByBoardID=function(selectedBoard){
        $scope.selectedSchools=alasql("select * from ? where board_id=?",[$scope.allSchools,selectedBoard.id]);
    }

    $scope.selectBoardBySchoolid=function(selectedsSchool){
        $scope.selectedBoards=alasql("select * from ? where board_id=?",[$scope.allBoards,selectedsSchool.id]);
        console.log(selectedBoards);
    }

    $scope.saveDataToDatabase=function(tempStudent){
        var submitableStudent={};
        submitableStudent.sex=tempStudent.sex;
        submitableStudent.address_line2=tempStudent.address_line2;
        submitableStudent.email=tempStudent.email;
        submitableStudent.person_name=tempStudent.person_name;
        submitableStudent.dob=tempStudent.dob;
        submitableStudent.father_name=tempStudent.father_name;
        submitableStudent.mother_name=tempStudent.mother_name;
        submitableStudent.address_line1=tempStudent.address_line1;
        submitableStudent.po=tempStudent.po;
        submitableStudent.pin=tempStudent.pin;
        submitableStudent.contact1=tempStudent.contact1;
        submitableStudent.contact2=tempStudent.contact2;
        submitableStudent.school_id=tempStudent.school.id;
        $scope.result=studentService.save(submitableStudent);

        $scope.$watchCollection("result",function (newValue, oldValue) {
            if(newValue!=oldValue) {
                if(newValue.success==1){
                    submitableStudent.id=newValue.student_id;
                    $scope.submitstudentdisabled=true;
                    $scope.message.showAlert('Successful','Student has been successfully added',1600);
                    $scope.students.unshift(submitableStudent);
                }
            }
        });
        /*********************************/
        //var request = $http({
        //    method: "post",
        //    url: site_url+"/Student/save_new_student",
        //    data: {
        //        student: submitableStudent
        //    }
        //    ,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        //}).then(function(response){
        //    $scope.reportArray=response.data.records;
        //    if($scope.reportArray.success==1){
        //
        //    }
        //});

        /*********************************/
    }
    $scope.updateStudentByStudentId=function(student){
        $scope.submitstudentdisabled=true;
        var st={};
        st.student_id=student.id;
        st.address_line2=student.address_line2;
        st.email=student.email;
        st.person_name=student.person_name;
        st.father_name=student.father_name;
        st.mother_name=student.mother_name;
        st.address_line1=student.address_line1;
        st.po=student.po;
        st.pin=student.pin;
        st.contact1=student.contact1;
        st.contact2=student.contact2;
        st.school_id=student.school.id;
        st.sex=student.sex;
        st.dob=student.dob;
        $scope.result=studentService.update(st);

        $scope.$watchCollection("result",function (newValue, oldValue) {
            if(newValue!=oldValue) {
                if(newValue.success==1){
                    $scope.updateStudentDisabled=true;
                    $scope.students[$scope.updateableStudentIndex]=student;
                    $scope.message.showAlert('Successful','Update Successful',1600);
                    //var index=$scope.allstudents.findIndex(x=>x.id===student.id);
                    //$scope.message.showAlert('Successful',index,1800);
                    //$scope.allStudents[index]=student;
                }
            }
        });

        // var request = $http({
        //     method: "post",
        //     url: site_url+"/Student/update_student_by_student_id",
        //     data: {
        //         student: st
        //     }
        //     ,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        // }).then(function(response){
        //     $scope.updateReportArray=response.data.records;
        //     if($scope.updateReportArray.success==1){
        //         $scope.showMessage.showAlert('Successful','Successfully Updated',1800);
        //         var index=$scope.allStudents.findIndex(x=>x.id===student.id);
        //         $scope.allStudents[index]=student;
        //         $scope.updateStudentDisabled=true;
        //     }
        // });
    };

    $scope.deletestudent=function(student){
        var confirm = $mdDialog.confirm()
            .title('Are you sure to delete the record?')
            .textContent('Record will be deleted permanently.')
            .ariaLabel('TutorialsPoint.com')
            .targetEvent(event)
            .ok('Yes')
            .cancel('No');
        $mdDialog.show(confirm).then(function() {
            //record will be deleted now
            $scope.result=studentService.delete({'id':student.id},function(){
                if($scope.result.success==1){
                    $scope.studentIndexforDelete=$scope.students.findIndex(x=>x.id===student.id);
                    $scope.students.splice($scope.studentIndexforDelete,1);
                    $scope.message.showAlert('Successful','Successfully Deleted',1600);
                }
            });
            $scope.status = 'Record deleted successfully!';
        }, function() {
            $scope.message.showAlert('failed','Failed to Deleted',1600);
            $scope.status = 'You decided to keep your record.';
        });



    };

    $scope.show_add=function(){
        $scope.brdsumbit=true;
        $scope.brdentry=true;
        $scope.addboard=false;
    }

    $scope.add_board=function(bo){
        $scope.result=boardService.save(bo,function(){
            $scope.message.showAlert('Successful','Successfully Added ',1600);
            $scope.brdsumbit=false;$scope.brdentry=false;
        });
    }
    $scope.editBoard=function(tempboard){
        $scope.brdupdate=true;$scope.brdsumbit=false;
        $scope.addboard=false;$scope.brdentry=true;
        angular.copy(tempboard,$scope.board);

    }

    $scope.updateBoard=function(brd){
        $scope.result=boardService.update(brd,function () {
            $scope.message.showAlert('Successful','Successfully Updated',1600);
            $scope.brdupdate=false;$scope.brdentry=false;
        });
    }

    $scope.deleteBoard=function(delbn) {
        var confirm = $mdDialog.confirm()
            .title('Are you sure to delete the record?')
            .textContent('Record will be deleted permanently.')
            .ariaLabel('TutorialsPoint.com')
            .targetEvent(event)
            .ok('Yes')
            .cancel('No');
        $mdDialog.show(confirm).then(function () {
            //record will be deleted now
            $scope.result=boardService.delete(delbn,function () {
                if($scope.result.success==1) {
                    $scope.boardIndexforDelete=$scope.allBoards.findIndex(x=>x.id===delbn.id);
                    $scope.students.splice($scope.boardIndexforDelete,1);
                    $scope.message.showAlert('Successful', 'Successfully Deleted', 1600);
                }
            });
            $scope.status = 'Record deleted successfully!';
        }, function () {
            $scope.message.showAlert('failed', 'Failed to Deleted', 1600);
            $scope.status = 'You decided to keep your record.';
        });
    }

    $scope.show_addsc=function(){
        $scope.sclentry=true; $scope.addschool=false; $scope.sclupdate=false;
        $scope.brdsclentry=true; $scope.sclsumbit=true;
    }

    $scope.addSchool=function (brd) {
        var snd={};
        snd.school_name=brd.school_name;
        snd.board_id=brd.board.id;
        console.log(snd);
        $scope.result=schoolService.save(snd);
    }

    $scope.editSchool=function (tempSchool) {
        $scope.sclentry=true;$scope.brdsclentry=true;$scope.sclupdate=true;$scope.addschool=false;$scope.sclsumbit=false;
        angular.copy(tempSchool,$scope.school);
        $scope.school.board=$scope.allBoards[$scope.allBoards.findIndex(x=>x.id==tempSchool.board_id)];

    }

    $scope.updateSchool=function (brd) {
        var snd={};
        snd.id=brd.id;
        snd.school_name=brd.school_name;
        snd.board_id=brd.board.id;
        console.log(snd);
        $scope.result=schoolService.update(snd);
    }

    $scope.loading = true;
    $scope.getData = function() {

        $http.get("http://127.0.0.1/sachin5/api/students")
            .then(function(response){
                $scope.students = response.data;
                $scope.loading = false;
                $scope.itemsByPage=12;
            });
    }

    $scope.getBoard = function() {

        $http.get("http://127.0.0.1/sachin5/api/boards")
            .then(function(response){
                $scope.allBoards = response.data;
                $scope.loading = true;
                $scope.itemsByPage=12;
            });
    }

    $scope.getSchool = function() {

        $http.get("http://127.0.0.1/sachin5/api/schools")
            .then(function(response){
                $scope.allSchools = response.data;
                $scope.loading = true;
                $scope.itemsByPage=12;
            });
    }

    $scope.getSchool();
    $scope.getBoard();
    $scope.getData();
    $scope.email_address="biju@example.com";
    $scope.email_subject="Testing";
    $scope.email_body="Hi,I found this website and thought you might like it http://www.geocities.com/wowhtml/";

});

