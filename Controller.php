<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'models/KontaktModel.php';

if (file_get_contents('php://input')) {
    // get the raw POST data
    $rawData = file_get_contents('php://input');

    // this returns null if not valid json
    $data = json_decode($rawData);

    switch ($data->action) {
        case 'delete':
            $kontakt = new KontaktModel();

            // Delete contact
            $kontakt->delete($data->id);

            break;
        case 'deleteOlderThan2Weeks':
            $kontakt = new KontaktModel();

            // Delete older contacts
            $kontakt->deleteOlderThan2Weeks();
            break;

        case 'getContactInfo':
            $kontakt = new KontaktModel();

            // Get one contact
            $emailInfo = $kontakt->getOne($data->id);

            echo $emailInfo['vorname'];
            echo '<br>';
            echo $emailInfo['nachname'];
            echo '<br>';
            echo $emailInfo['email_subject'];
            echo '<br>';
            echo $emailInfo['email_message'];

            break;
    }
}
