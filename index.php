<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
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
    return [];
}

function handleForm()
{
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

// TODO: replace this if by an actual check
$formSubmitted = false;
if ($formSubmitted) {
    handleForm();
}

require 'form-view.php';