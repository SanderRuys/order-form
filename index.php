<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

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
    //echo '<h2>$_SESSION</h2>';
    //var_dump($_SESSION);
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

    //check for errors of empty

    $result = [];
    foreach ($_POST as $i => $inputValue){
        // als email input leeg is
        if (empty($inputValue) && $i === "email"){
            //wordt achteraan in de array toegevoegd
            $result[] = $i;
            echo "email is empty <br>";
        }
        //als email niet geldig is
        //value van $i, $i is nu "email" en niet de inhoud van de input
        elseif ($i === "email" && !filter_var($inputValue, FILTER_VALIDATE_EMAIL)){
            $result[] = $i;
            echo "email is not valid <br>";
        }
        //if street input is empty
        elseif (empty($inputValue) && $i === "street") {
           $result[] = $i;
           echo "street is empty <br>";
        }
        //if streetnumber input is empty
        elseif (empty($inputValue) && $i === "streetnumber"){
            $result[] = $i;
            echo "streetnumber is empty <br>";
        }
        //if city is empty
        elseif (empty($inputValue) && $i === "city"){
            $result[] = $i;
            echo "city is empty <br>";
        }
        //if zipcode is empty
        elseif (empty($inputValue) && $i === "zipcode"){
            $result[] = $i;
            echo "zipcode is empty <br>";
        }
        //if zipcode is not a number
        elseif ($i === "zipcode" && !is_numeric($inputValue)){
            $result[] = $i;
            echo "zipcode is not a number";
        }
    }

    return $result;
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
        foreach($invalidFields as $invalid){
            echo '<div class="alert alert-danger" role="alert">'.$invalid.' is invalid or empty!</div>';
        }
        
    } else {
        // TODO: handle successful submission
        //handle orders here!! (step1)
        //var_dump($_POST['products']);
        echo "<h4>Congratulations, you succesfully ordered following wand(s):</h4><br>";
        foreach($_POST['products'] as $i => $product){
            //echo $products[$i]['name'];
            //echo $products[$i]['price']."<br>";
            //var_dump($products[$i]['price']);
            $totalValue += $products[$i]['price'];
            $totalOrders[] = $products[$i]['name'];
            echo '<div class="alert alert-success" role="alert">'.$products[$i]['name'].'</div>';
        }
       $_POST['totalValue'] = $totalValue;
        echo "<h5>For a total price of: </h5><br>";
        echo '<div class="alert alert-success" role="alert">€'.$totalValue.'</div>';
        echo "<h5>It will be delivered by owl to the following adress: </h5><br>";

    }
    
}

// TODO: replace this if by an actual check
//$formSubmitted = false;
if (isset($_POST['submit'])) {
   // whatIsHappening();
    handleForm($totalValue, $products);
}

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
require 'form-view.php';