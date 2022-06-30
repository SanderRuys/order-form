<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();
unset($_SESSION["listOfProducts"]);

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
   // echo '<h2>$_GET</h2>';
   // var_dump($_GET);
    echo '<h2>$_POST</h2>';
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
   // echo '<h2>$_COOKIE</h2>';
   // var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
}

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Wood: Willow, core: Phoenix Feather', 'price' => 7],
    ['name' => 'Wood: Alder, core: Dragon Heartstring', 'price' => 7.2],
    ['name' => 'Wood: Blackthorn, core: Unicorn Hair', 'price' => 7.6],
    ['name' => 'Wood: Ebony, core: Veela Hair', 'price' => 6.8],
    ['name' => 'Wood: Blackthorn, core: Unicorn Hair', 'price' => 7.6],
    ['name' => 'Wood: Spruce, core: Thestral Hair', 'price' => 7.1],
    ['name' => 'Wood: Cypress, core: Dragon Heartstring', 'price' => 7.8],
    ['name' => 'Wood: Elder, core: Phoenix Feather', 'price' => 8],
    ['name' => 'Wood: Maple, core: Unicorn Hair', 'price' => 7.6],
];

$totalValue = 0;


function validate()
{
    // TODO: This function will send a list of invalid fields back
    // array with all input 

    $_SESSION["userInfo"] = $_POST;

    //check for errors of empty

    $result = [];
    foreach ($_POST as $i => $inputValue){
        // als email input leeg is
        
        //als email niet geldig is
        //value van $i, $i is nu "email" en niet de inhoud van de input
       if ($i === "email" && !filter_var($inputValue, FILTER_VALIDATE_EMAIL)){
            $result[] = ["name" => $i, "error" => "invalid email adress"];
            //echo "email is not valid <br>";
        }
        //if zipcode is not a number
        elseif ($i === "zipcode" && !is_numeric($inputValue)){
            $result[] = ["name" => $i, "error" => "invalid zipcode"];
        }
        //if street input is empty
        elseif (empty($inputValue) ) {
           $result[] = ["name" => $i, "error" => "empty field"];
           
        }
    }

    return $result;
}

function bucketList($products){
    echo  '<div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Congratulations, you succesfully ordered following wand(s):</h4>
        <ul>';
        foreach($_SESSION["listOfProducts"] as $key => $indexNumber) {
            echo  '<li>';
            echo $products[$indexNumber]["name"];
            echo '</li>';
        }
    echo '</ul></div>';     
}

function listOfErrors($errors)
{
    echo '<div class="alert alert-danger" role="alert">
    <ul>';
    foreach($errors as $key => $error) {
        echo '<li>';
        echo $error['name']. ' - ' . $error["error"];
        echo '</li>';
    }
    echo '</ul></div>';
}

function setAddress()
{
    $street = $_POST['street'];
    $streetNumber = $_POST['streetnumber'];
    $zipCode = $_POST['zipcode'];
    $city = $_POST['city'];

    echo '<ul>';
    echo '<li>' . $street . ' number: ' . $streetNumber;
    echo '<li>' . $zipCode . ' ' . $city;
    echo '</ul>';
}

function handleForm($totalValue, $products)
{
    $totalOrders = [];
    // TODO: form related tasks (step 1)
    

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        //wanneer er input in validate zit zijn er fouten
        /*foreach($invalidFields as $invalid){
            echo '<div class="alert alert-danger" role="alert">'.$invalid.' is invalid or empty!</div>';
        }*/
        listOfErrors($invalidFields);
    } else {
        // TODO: handle successful submission
        //handle orders here!! (step1)
        
        //var_dump($_POST['products']);
        //echo "<h4>Congratulations, you succesfully ordered following wand(s):</h4><br>";
        foreach($_POST['products'] as $i => $product){
            //echo $products[$i]['name'];
            //$_SESSION["listOfProducts"][] = ["product"=> $products[$i]['name'], "price"=> $products[$i]['price']];
            $_SESSION["listOfProducts"][] = $i;
            //$totalValue += $products[$i]['price'];
            //$totalOrders[] = $products[$i]['name'];
            //echo '<div class="alert alert-success" role="alert">'.$products[$i]['name'].'</div>';
            }
            //echo $products[$i]['price']."<br>";
            //var_dump($products[$i]['price']);


            bucketList($products);
            
        
       $_POST['totalValue'] = $totalValue;
        //echo "<h5>For a total price of: </h5><br>";
        //echo '<div class="alert alert-success" role="alert">€'.$totalValue.'</div>';
        echo "<h5>It will be delivered by owl to the following adress: </h5><br>";
        setAddress();

    }
    
}

// TODO: replace this if by an actual check
//$formSubmitted = false;
if (isset($_POST['submit'])) {
    
    //whatIsHappening();
    handleForm($totalValue, $products);
}


if (isset($_SESSION["listOfProducts"])){
    foreach($_SESSION["listOfProducts"] as $key => $value) 
    {
        $price = $products[$value]["price"];
        $totalValue += $price;      
    }
}


//echo "<pre>";
//print_r($_POST);
//echo "</pre>";


require 'form-view.php';