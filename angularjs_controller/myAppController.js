var url=location.href;
var urlAux = url.split('/');

var base_url=urlAux[0]+'/'+urlAux[1]+'/'+urlAux[2]+'/'+urlAux[3]+'/';
//var site_url=urlAux[0]+'/'+urlAux[1]+'/'+urlAux[2]+'/'+urlAux[3]+'/index.php/';
var site_url=urlAux[0]+'/'+urlAux[1]+'/'+urlAux[2]+'/'+urlAux[3]+'/';

// var project_url='http://127.0.0.1/gourisankar/';
var project_url=base_url;


var app = angular.module("myApp", ["ngRoute","angular-md5","ngMessages","ngMaterial","angular-barcode","chart.js","monospaced.qrcode","ngResource","smart-table"]);

app.config(function($routeProvider) {
    $routeProvider
        .when("/", {
            templateUrl : site_url+"base/angular_view_home_advanced",
            controller : "loginCtrl"
        }).when("/login", {
            templateUrl : site_url+"base/angular_view_login",
            controller : "loginCtrl"
        }).when("/staffArea", {
            templateUrl : site_url+"staff/angular_view_welcome",
            controller : "staffCtrl"
        }).when("/student", {
            templateUrl : site_url+"student/angular_view_welcome_student_old",
            controller : "studentCtrl"
        }).when("/Others", {
            templateUrl : site_url+"staff/others_view_welcome",
            controller : "customerCtrl"
        }).when("/Customer", {
            templateUrl : site_url+"customer/angular_view_customer",
            controller : "customerCtrl"
        }).when("/report", {
            templateUrl : site_url+"Report/angular_view_report",
            controller : "reportCtrl"
        });
});


app.directive('pageSelect', function() {
    return {
        restrict: 'E',
        template: '<input type="text" class="select-page" ng-model="inputPage" ng-change="selectPage(inputPage)">',
        link: function(scope, element, attrs) {
            scope.$watch('currentPage', function(c) {
                scope.inputPage = c;
            });
        }
    }
});



app.directive('a', function() {
    return {
        restrict: 'E',
        link: function(scope, elem, attrs) {
            if(attrs.ngClick || attrs.href === '' || attrs.href === '#'){
                elem.on('click', function(e){
                    e.preventDefault();
                });
            }
        }
    };
});




//this directive will convert a input to capitalize
app.directive('capitalize', function() {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, modelCtrl) {
            var capitalize = function(inputValue) {
                if (inputValue == undefined) inputValue = '';
                var capitalized = inputValue.toUpperCase();
                if (capitalized !== inputValue) {
                    // see where the cursor is before the update so that we can set it back
                    var selection = element[0].selectionStart;
                    modelCtrl.$setViewValue(capitalized);
                    modelCtrl.$render();
                    // set back the cursor after rendering
                    element[0].selectionStart = selection;
                    element[0].selectionEnd = selection;
                }
                return capitalized;
            }
            modelCtrl.$parsers.push(capitalize);
            capitalize(scope[attrs.ngModel]); // capitalize initial value
        }
    };
});

//this directive will restrict you from entering data morethan the limit. <input limit-to="4">
app.directive("limitTo", [function() {
    return {
        restrict: "A",
        link: function(scope, elem, attrs) {
            var limit = parseInt(attrs.limitTo);
            angular.element(elem).on("keypress", function(e) {
                if (this.value.length == limit){
                    e.preventDefault();
                }
            });
        }
    }
}]);




//it will allow integer values only <input numbers-only>
app.directive('numbersOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9-]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});



app.run(function($rootScope){
    $rootScope.CurrentDate = Date;
});
////Directive for input maxlength//
app.directive('myMaxlength', function() {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, ngModelCtrl) {
            var maxlength = Number(attrs.myMaxlength);
            function fromUser(text) {
                if (text.length > maxlength) {
                    var transformedInput = text.substring(0, maxlength);
                    ngModelCtrl.$setViewValue(transformedInput);
                    ngModelCtrl.$render();
                    return transformedInput;
                }
                return text;
            }
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});
app.directive('goldDecimalPlaces',function(){
    return {
        link:function(scope,ele,attrs){
            ele.bind('keypress',function(e){
                var newVal=$(this).val()+(e.charCode!==0?String.fromCharCode(e.charCode):'');
                if($(this).val().search(/(.*)\.[0-9][0-9][0-9]/)===0 && newVal.length>$(this).val().length){
                    e.preventDefault();
                }
            });
        }
    };
});
//currency decimal places
app.directive('currencyDecimalPlaces',function(){
    return {
        link:function(scope,ele,attrs){
            ele.bind('keypress',function(e){
                var newVal=$(this).val()+(e.charCode!==0?String.fromCharCode(e.charCode):'');
                if($(this).val().search(/(.*)\.[0-9][0-9]/)===0 && newVal.length>$(this).val().length){
                    e.preventDefault();
                }
            });
        }
    };
});
app.directive('numericValue', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9-.]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});
app.run(function($rootScope){
    $rootScope.roundNumber=function(number, decimalPlaces){
        return parseFloat(parseFloat(number).toFixed(decimalPlaces));
    };
});
app.run(function($rootScope) {
    $rootScope.huiPrintDiv = function(printDetails,userCSSFile, numberOfCopies) {
        var divContents=$('#'+printDetails).html();
        var printWindow = window.open('', '', 'height=400,width=800');

        printWindow.document.write('<!DOCTYPE html>');
        printWindow.document.write('\n<html>');
        printWindow.document.write('\n<head>');
        printWindow.document.write('\n<title>');
        //printWindow.document.write(docTitle);
        printWindow.document.write('</title>');
        printWindow.document.write('\n<link href="'+project_url+'bootstrap-4.0.0/dist/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all">\n');
        printWindow.document.write('\n<link href="'+project_url+'css/print_style/basic_print.css" type="text/css" rel="stylesheet" media="all">\n');
        printWindow.document.write('\n<script src="angularjs/angularjs_1.6.4_angular.min.js"></script>\n');
        printWindow.document.write('\n<link href="'+project_url+'css/print_style/');
        printWindow.document.write(userCSSFile);
        printWindow.document.write('?v='+ Math.random()+'" rel="stylesheet" type="text/css" media="all"/>');


        printWindow.document.write('\n</head>');
        printWindow.document.write('\n<body>');
        printWindow.document.write(divContents);
        if(numberOfCopies==2) {
            printWindow.document.write('\n<hr>');
            printWindow.document.write(divContents);
        }
        printWindow.document.write('\n</body>');
        printWindow.document.write('\n</html>');
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    };
});
app.filter('AmountConvertToWord', function() {
    return function(amount) {
        var words = new Array();
        words[0] = '';
        words[1] = 'One';
        words[2] = 'Two';
        words[3] = 'Three';
        words[4] = 'Four';
        words[5] = 'Five';
        words[6] = 'Six';
        words[7] = 'Seven';
        words[8] = 'Eight';
        words[9] = 'Nine';
        words[10] = 'Ten';
        words[11] = 'Eleven';
        words[12] = 'Twelve';
        words[13] = 'Thirteen';
        words[14] = 'Fourteen';
        words[15] = 'Fifteen';
        words[16] = 'Sixteen';
        words[17] = 'Seventeen';
        words[18] = 'Eighteen';
        words[19] = 'Nineteen';
        words[20] = 'Twenty';
        words[30] = 'Thirty';
        words[40] = 'Forty';
        words[50] = 'Fifty';
        words[60] = 'Sixty';
        words[70] = 'Seventy';
        words[80] = 'Eighty';
        words[90] = 'Ninety';
        amount = amount.toString();
        var atemp = amount.split(".");
        var number = atemp[0].split(",").join("");
        var n_length = number.length;
        var words_string = "";
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
        return "Rupees "+words_string+" Only";
    };
});

//A directive to enable two way binding of file field

app.directive('demoFileModel', function ($parse) {
    return {
        restrict: 'A', //the directive can be used as an attribute only

        /*
         link is a function that defines functionality of directive
         scope: scope associated with the element
         element: element on which this directive used
         attrs: key value pair of element attributes
         */
        link: function (scope, element, attrs) {
            var model = $parse(attrs.demoFileModel),
                modelSetter = model.assign; //define a setter for demoFileModel

            //Bind change event on the element
            element.bind('change', function () {
                //Call apply on scope, it checks for value changes and reflect them on UI
                scope.$apply(function () {
                    //set the model value
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
});

app.service("uploadService", function($http, $q) {

    return ({
        upload: upload
    });

    function upload(file) {
        var upl = $http({
            method: 'POST',
            url: 'http://jsonplaceholder.typicode.com/posts', // /api/upload
            headers: {
                'Content-Type': 'multipart/form-data'
            },
            data: {
                upload: file
            },
            transformRequest: function(data, headersGetter) {
                var formData = new FormData();
                angular.forEach(data, function(value, key) {
                    formData.append(key, value);
                });

                var headers = headersGetter();
                delete headers['Content-Type'];

                return formData;
            }
        });
        return upl.then(handleSuccess, handleError);

    } // End upload function

    // ---
    // PRIVATE METHODS.
    // ---

    function handleError(response, data) {
        if (!angular.isObject(response.data) ||!response.data.message) {
            return ($q.reject("An unknown error occurred."));
        }

        return ($q.reject(response.data.message));
    }

    function handleSuccess(response) {
        return (response);
    }

});

app.directive("fileinput", [function() {
    return {
        scope: {
            fileinput: "=",
            filepreview: "="
        },
        link: function(scope, element, attributes) {
            element.bind("change", function(changeEvent) {
                scope.fileinput = changeEvent.target.files[0];
                var reader = new FileReader();
                reader.onload = function(loadEvent) {
                    scope.$apply(function() {
                        scope.filepreview = loadEvent.target.result;
                    });
                }
                reader.readAsDataURL(scope.fileinput);
            });
        }
    }
}]);


// begininf number to word
app.filter('words', function() {

    function isInteger(query) {

        return query % 1 === 0;

    }




    return function(value) {

        if (value && isInteger(value))

            return  covertWords(value);


        return value;

    };


});


var myappthos = ['','thousand','million', 'billion','trillion'];

var myappdang = ['zero','one','two','three','four', 'five','six','seven','eight','nine'];

var myapptenth = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen'];

var myapptvew = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];


function covertWords(s){

    s = s.toString();

    s = s.replace(/[\, ]/g,'');

    if (s != parseFloat(s)) return 'not a number';

    var query = s.indexOf('.');

    if (query == -1) query = s.length;

    if (query > 15) return 'too big';

    var n = s.split('');

    var str = '';

    var mjk = 0;

    for (var ld=0; ld < query; ld++)

    {

        if ((query-ld)%3==2)

        {

            if (n[ld] == '1')            {
                str += myapptenth[Number(n[ld+1])] + ' ';
                ld++;
                mjk=1;
            }else if (n[ld]!=0){
                str += myapptvew[n[ld]-2] + ' ';
                mjk=1;
            }
        }else if (n[ld]!=0){
            str += myappdang[n[ld]] +' ';
            if ((query-ld)%3==0) str += 'hundred ';
            mjk=1;
        }
        if ((query-ld)%3==1){
            if (mjk) str += myappthos[(query-ld-1)/3] + ' ';
            mjk=0;
        }
    }
    if (query != s.length){
        var dv = s.length;
        str += 'point ';
        for (var ld=query+1; ld<dv; ld++) str += myappdang[n[ld]] +' ';
    }
    return str.replace(/\s+/g,' ');

}
//window.covertWords = covertWords;


// end of number to word




/************* Factories ***************************/
app.factory('MessageService', function($mdDialog,$timeout) {
    //creating service object
    var myObject = {};
    myObject.response=false;
    myObject.showConfirmStatus = "";

    myObject.showAlert = function(title,textContent,duration) {
        // Appending dialog to document.body to cover sidenav in docs app
        // Modal dialogs should fully cover application
        // to prevent interaction outside of dialog
        $mdDialog.show(
            $mdDialog.alert()
                .parent(angular.element(document.querySelector('#popupContainer')))
                .clickOutsideToClose(true)
                .title(title)
                .textContent(textContent)
                .ariaLabel('Alert Dialog Demo')
                .ok('Close')
                //.targetEvent(ev)
        );
        $timeout(function(){
            $mdDialog.hide();
        }, duration);
    };
    //not completed
    myObject.showConfirm = function() {
        // Appending dialog to document.body to cover sidenav in docs app
        var confirm = $mdDialog.confirm()
            .title('Would you like to delete your debt?')
            .textContent('All of the banks have agreed to forgive you your debts.')
            .ariaLabel('Lucky day')
            //.targetEvent(ev)
            .ok('Please do it!')
            .cancel('Sounds like a scam');

        myObject.showConfirmStatus=$mdDialog.show(confirm).then(function() {
            //when okay
            myObject.response=true;
            return true;
        }, function() {
            //when cancel
            myObject.response=false;
            return false;
        });
    };


    // myObject.showPrompt = function(ev) {
    //     // Appending dialog to document.body to cover sidenav in docs app
    //     var confirm = $mdDialog.prompt()
    //         .title('What would you name your dog?')
    //         .textContent('Bowser is a common name.')
    //         .placeholder('Dog name')
    //         .ariaLabel('Dog name')
    //         .initialValue('Buddy')
    //         .targetEvent(ev)
    //         .required(true)
    //         .ok('Okay!')
    //         .cancel('I\'m a cat person');
    //
    //     $mdDialog.show(confirm).then(function(result) {
    //         status = 'You decided to name your dog ' + result + '.';
    //     }, function() {
    //         status = 'You didn\'t name your dog.';
    //     });
    // };

        return myObject;

});

app.factory('CommonCode', function ($window) {
    var root = {};
    root.show = function(msg){
        $window.alert(msg);
    };
    return root;
});

app.factory('Entry', function($resource) {
    var data= $resource('http://127.0.0.1/prakash-rest/api/districts/:id'); // Note the full endpoint address
    update:{
        method:'PUT'
    }
    return data;
});

app.factory('studentService', function ($resource) {
    var link="http://127.0.0.1/sachin5/api/students/:id";
    var data = $resource(link, {id: "@id"}, {
            update:{
                method:'PUT'
            },
            delete: {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            }
        });
        return data;
});

app.factory('boardService', function ($resource) {
    var link="http://127.0.0.1/sachin5/api/boards/:id";
    var data = $resource(link, {id: "@id"}, {
        update:{
            method:'PUT'
        },
        delete: {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        }
    });
    return data;
});

app.factory('schoolService', function ($resource) {
    var link="http://127.0.0.1/sachin5/api/schools/:id";
    var data = $resource(link, {id: "@id"}, {
        update:{
            method:'PUT'
        },
        delete: {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        }
    });
    return data;
});

app.directive("limitTo", [function() {
    return {
        restrict: "A",
        link: function(scope, elem, attrs) {
            var limit = parseInt(attrs.limitTo);
            angular.element(elem).on("keypress", function(e) {
                if (this.value.length == limit){
                    e.preventDefault();
                }
            });
        }
    }
}]);





