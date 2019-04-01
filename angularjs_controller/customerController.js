app.controller("customerCtrl", function ($scope,$http,$filter,$timeout,dateFilter,$rootScope,$mdDialog,MessageService,Entry,studentService,boardService) {
    $scope.msg = "This is play controller";
    //Tab area
    $scope.tab = 1;
    $scope.setTab = function(newTab){
        $scope.tab = newTab;
    };
    $scope.isSet = function(tabNum){
        return $scope.tab === tabNum;
    };
    //End of tab area

    $scope.showDeveloperArea=false;
    $scope.getSearchItem=function(searchItem){
        if(searchItem=="show-dev"){
            $scope.showDeveloperArea=!$scope.showDeveloperArea;
        }
    }

    //Loading States
    $scope.loadStates=function(){
        var request = $http({
            method: "post",
            url: site_url+"/customer/get_states",
            data: {
            }
            ,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function(response){
            $scope.allStates=response.data.records;
        });
    };
    //calling loadBoards
    //$scope.loadStates();

    $scope.customer={mailing_name:'test',sex: 'Male'};
    $http.get('json/states.json').then(function(response) {
        $scope.states = response.data.states;
    });
    $http.get('json/states_n_districts.json').then(function(response) {
        $scope.states_n_districts = response.data.states;
        var index = $scope.states_n_districts.findIndex(x => x.state === "West Bengal");
        $scope.customer.state_n_district=$scope.states_n_districts[index];
    });



    $http.get('json/cities.json').then(function(response) {
        $scope.cities = response.data.cities;
    });

    $scope.completeCity=function(){
        //console.log($scope.cities);
        $( "#city" ).autocomplete({
            source: $scope.cities
        });
    }

    $http.get('json/post_office.json').then(function(response) {
        $scope.post_offices = response.data.postOffices;
    });

    $scope.completePostOffice=function(){
            //console.log($scope.cities);
        $( "#po" ).autocomplete({
            source: $scope.post_offices
        });
    }

    $scope.copyToMailingName=function(person_name){
        if($scope.customer.mailing_name.length<1)
            $scope.customer.mailing_name=person_name;
    }


    /***************************************************/
    $scope.status = '  ';
    $scope.customFullscreen = false;


    $scope.HuiMessage=MessageService;



    $scope.showAdvanced = function(ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'dialog1.tmpl.html',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:true,
            fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
        })
            .then(function(answer) {
                $scope.status = 'You said the information was "' + answer + '".';
            }, function() {
                $scope.status = 'You cancelled the dialog.';
            });
    };

    //$scope.districts = Entry.get({id: 2});

    //$scope.districts = Entry.query({id: 2});
    //$scope.districts = Entry.save({id: 24}, {district_name: 'PPPP',state_id: 19});


    //$scope.testStudent={
    //    person_name: 'Mou Podder3'
    //    ,sex:'Female'
    //    ,email:'moupodder@gmail.com'
    //    ,address_line1:'Barrackpore'
    //    ,address_line2:'N C Pukur'
    //    ,dob:'2000-05-02'
    //    ,po:'n c pukur'
    //    ,pin:'04508456'
    //    ,contact_1: '35345345'
    //    ,contact_2:'345345'
    //    ,person_category_id:'34534534'
    //}
    $scope.testStudent={
        id: 'Sx-00066-188'
        ,person_name: 'dfgh fghdf'
        ,sex:'Female'
        ,email:'moupodder@gmail.com'
        ,address_line1:'Barrackpore'
        ,address_line2:'N C Pukur'
        ,dob:'2000-05-02'
        ,po:'n c pukur'
        ,pin:'04508456'
        ,contact_1: '35345345'
        ,contact_2:'345345'
        ,person_category_id:'34534534'
    }

    //studentServiceUserService.setLink('http://127.0.0.1/sachin4/api/students/:id');
    $scope.students=studentService.query();
    $scope.board={
        board_name:'abcdefg'
    };
   //$scope.boards=boardService.save($scope.board);
    //$scope.boards=boardService.query();




    console.log($scope.districts);



    function DialogController($scope, $mdDialog) {
        $scope.hide = function() {
            $mdDialog.hide();
        };

        $scope.cancel = function() {
            $mdDialog.cancel();
        };

        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };
    }
    /***************************************************/

    $scope.loading = true;
    $scope.getData = function() {

        $http.get("http://dummy.restapiexample.com/api/v1/employees")
            .then(function(response){
                $scope.employees = response.data;
                $scope.loading = false;
                $scope.itemsByPage=12;
            });
    }
    $scope.getData();
    $scope.email_address="biju@example.com";
    $scope.email_subject="Testing";
    $scope.email_body="Hi,I found this website and thought you might like it http://www.geocities.com/wowhtml/";



});

