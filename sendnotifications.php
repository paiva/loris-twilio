<?php
    /* Send an SMS using Twilio. You can run this file 3 different ways:
     *
     * 1. Save it as sendnotifications.php and at the command line, run
     *         php sendnotifications.php
     *
     * 2. Upload it to a web host and load mywebhost.com/sendnotifications.php
     *    in a web browser.
     *
     * 3. Download a local server like WAMP, MAMP or XAMPP. Point the web root
     *    directory to the folder containing this file, and load
     *    localhost:8888/sendnotifications.php in a web browser.
     */

    // Step 1: Get the Twilio-PHP library from twilio.com/docs/libraries/php,
    // following the instructions to install it with Composer.
    require_once "vendor/autoload.php";
    use Twilio\Rest\Client;

    // Step 2: set our AccountSid and AuthToken from https://twilio.com/console
    $AccountSid     = getenv('TWILIO_ACCOUNT_SID');
    $AuthToken      = getenv('TWILIO_AUTH_TOKEN');
    $user_name      = getenv('MY_NAME');
    $user_number    = "+1" . getenv('MY_PHONE_NUMBER');
    $twilio_number  = "+1" . getenv('TWILIO_NUMBER');

    // Step 3: instantiate a new Twilio Rest Client
    $client = new Client($AccountSid, $AuthToken);

    // Step 4: make an array of people we know, to send them a message.
    // Feel free to change/add your own phone number and name here.
    $people = array(
        "$user_number" => "$user_name"
    );

    // Step 5: Loop over all our friends. $number is a phone number above, and
    // $name is the name next to it
    foreach ($people as $number => $name) {

        $sms = $client->account->messages->create(

            // the number we are sending to - Any phone number
            $number,

            array(
                // Step 6: Change the 'From' number below to be a valid Twilio number
                'from' => "$twilio_number",

                // the sms body
                'body' => "Dear $name, your scan is uploaded in LORIS!"
            )
        );

        // Display a confirmation message on the screen
        echo "Sent message to $name";
    }
