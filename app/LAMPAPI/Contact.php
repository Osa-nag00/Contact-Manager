<?php
require_once('../config/config.php');

// Setting global variable to use database connection for different operations
global $conn;

// Attempting to establish MySQL database connection
$conn = new mysqli($dbServer, $dbUsername, $dbPassword, $dbName);

// Unable to connect to MySQL database
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

/** 
 * This string of conditionals is responsible for handling all of the requests
 * from the frontend. The POST request is responsible for (C)reating a contact,
 * the GET request is responsible for (R)eading contacts, the PUT request is
 * responsible for (U)pdating a contact, and the DELETE request is responsible
 * for (D)eleting contact
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Parsing JSON data from frontend
    $data = parseJsonData();
    $user_id = $data['user_id'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $phone = $data['phone'];
    
    // We exit if the contact is not valid or there is a duplicate
    validateContact($first_name, $email, $phone);
    checkForDuplicate($user_id, $first_name, $last_name);

    // Attempting to add contact with given information to the user with user_id
    $newContactID = addContact($user_id, $first_name, $last_name, $email, $phone);
    echo json_encode($newContactID);

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Parsing JSON data from frontend
    $data = parseJsonData();
    $user_id = $data['user_id'];

    // Attempting to read all contacts of user with user_id
    $contacts = getContacts($user_id);
    echo json_encode($contacts);

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    // Parsing JSON data from frontend
    $data = parseJsonData();
    $contact_id = $data['contact_id'];
    $newFirstName = $data['first_name'];
    $newLastName = $data['last_name'];
    $newEmail = $data['email'];
    $newPhone = $data['phone'];

    // Attempting to edit the contact of contact with contact_id
    $updated = editContact($contact_id, $newFirstName, $newLastName, $newEmail, $newPhone);
    echo json_encode($updated);

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    // Parsing JSON data from frontend
    $data = parseJsonData();
    $contact_id = $data['contact_id'];

    // Attempting to delete the contact with contact_id
    $deleted = deleteContact($contact_id);
    echo json_encode($deleted);

} else {

    // Handling for any other request, will not perform any database operations
    $error = "This request type is not supported";
    returnWithError($error, 400);

}

// Function to parse the JSON from the frontend, return an array containing the JSON data
function parseJsonData()
{
    $jsonData = file_get_contents('php://input');

    // Check if getting the contents failed
    if ($jsonData === false) {
        $error = "Failed to read JSON data from the request body.";
        returnWithError($error, 400);
    }

    $data = json_decode($jsonData, true);

    // Check if decoding JSON failed
    if ($data === null) {
        $error = "Failed to parse JSON data.";
        returnWithError($error, 400);
    }

    // Returning the JSON data as an array if parsing was successful
    return $data;
}

// Function to format error with error string and response code
function returnWithError($err, $responseCode)
{
    global $conn;

    http_response_code($responseCode);

    // Make the response a JSON
    $obj = array('error' => $err);
    header('Content-Type: application/json');
    echo json_encode($obj);

    // Close global SQL connection
    $conn->close();

    exit;
}

/**
 * I AM STILL WORKING ON IMPLEMENTING EVERYTHING FROM THIS POINT FORWARD 
 */

// Function to add a contact to the database
function addContact($user_id, $firstName, $lastName, $email, $phone )
{
    # TODO
    $todo = "Adding contact function";
    return $todo;
}

// Function to get all of the contacts for a user with that user_id
function getContacts($user_id)
{
    # TODO
    $todo = "Getting contact function";
    return $todo;
}

// This function calls the helper edit functions to edit subfields of the contact
function editContact($contact_id, $newFirstName, $newLastName, $newEmail, $newPhone)
{
    # TODO
    $todo = "Editing contact function";
    return $todo;
}

// Helper function of editContact() to edit the first name
function editFirstName($contact_id, $newFirstName)
{
    # TODO
    $todo = "Helper edit function (first name)";
    return $todo;
}

// Helper function of editContact() to edit the last name
function editLastName($contact_id, $newLastName)
{
    # TODO
    $todo = "Helper edit function (last name)";
    return $todo;
}

// Helper function of editContact() to edit the email
function editEmail($contact_id, $newEmail)
{
    # TODO
    $todo = "Helper edit function (email)";
    return $todo;
}

// Helper function of editContact() to edit the phone number
function editPhone($contact_id, $newPhone)
{
    # TODO
    $todo = "Helper edit function (phone)";
    return $todo;
}

// Function to delete the contact with contact_id from database
function deleteContact($contact_id)
{
    # TODO
    $todo = "Deleting contact function";
    return $todo;
}

/** 
 * My definition of a valid contact is one that has some valid name associated
 * with either an email or phone number. Returns true if the contact is valid,
 * returns an error if not.
 */
function validateContact( $firstName, $email, $phone )
{
    # TODO
    $todo = "Validating contact function";
    return $todo;
}

/**
 * Function to make sure that a contact has not already been added with the
 * first and last name under a user_id. Returns an error if contact already exits
 */
function checkForDuplicate($user_id, $first_name, $last_name)
{
    # TODO
    $todo = "Checking for duplicates function";
    return $todo;
}
