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

            $html =
                '<div class="row">' .
                '       <div class="col-md-12">' .
                '           <div class="signup-form">' .
                '               <form action="" class="mt-5 border p-4 bg-light shadow">' .
                '                  ' .
                '                   <div class="row">' .
                '                       <div class="mb-3 col-md-6">' .
                '                           <label>Vorname </label>' .
                '                           <input type="text" name="fname" class="form-control" disabled value="' .
                $emailInfo['vorname'] .
                '">' .
                '                       </div>' .
                '                        <div class="mb-3 col-md-6">' .
                '                           <label>Nachname: </label>' .
                '                           <input type="text" name="Lname" class="form-control" disabled value="' .
                $emailInfo['nachname'] .
                '">' .
                '                       </div>' .
                '                        ' .
                '                       <div class="mb-3 col-md-6">' .
                '                           <label>From: </label>' .
                '                           <input type="text" name="fname" class="form-control" disabled value="' .
                $emailInfo['from_email'] .
                '">' .
                '                       </div>' .
                '                        <div class="mb-3 col-md-6">' .
                '                           <label>To: </label>' .
                '                           <input type="text" name="Lname" class="form-control" disabled value="' .
                $emailInfo['to_email'] .
                '">' .
                '                       </div>' .
                '                        <div class="mb-3 col-md-12">' .
                '                           <label>Subject</label>' .
                '                           <input type="text" name="password" class="form-control" disabled value="' .
                $emailInfo['email_subject'] .
                '">' .
                '                       </div>' .
                '                        <div class="mb-3">' .
                '                         <label for="exampleFormControlTextarea1" class="form-label">Message</label>' .
                '                         <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled> ' .
                $emailInfo['email_message'] .
                ' </textarea>' .
                '                       </div>' .
                '' .
                '                        ' .
                '                   </div>' .
                '               </form>' .
                '           </div>' .
                '       </div>' .
                '   </div>';

            echo $html;

            break;
    }
}
