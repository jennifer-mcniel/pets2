<?php

//This is my controller

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require
require_once ('vendor/autoload.php');

//Instantiate the F3 Base Class
$f3 = Base::instance();

//Define a default route
//https://jmcniel.greenriverdev.com/328/hello-fat-free/
$f3->route('GET /', function(){
//    echo below is used for testing before executing the template
        echo '<h1>Hello Pets</h1>';

//    //Render a view page
    $view = new Template();
    echo $view->render('view/home.html');
});

$f3->route('GET|POST /order', function($f3) {

    if($_SERVER['REQUEST_METHOD']== 'POST') {
        $pet = $_POST['pet'];
        $color = $_POST['color'];

        if(empty($pet)){
            echo "Please supply a pet type";
        }else {
            $f3->set('SESSION.pet', $pet);
            $f3->set('SESSION.color', $color);

            $f3->reroute('summary');
        }
    }


//    echo '<h1>Order Page</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('view/pet-order.html');
});

//Order Summary
$f3->route('GET /summary', function($f3) {

//    var_dump( $f3->get('SESSION'));

    // Render a view page
    $view = new Template();
    echo $view->render('view/order-summary.html');
});

//Run Fat-Free
$f3->run();