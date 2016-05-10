<?php

namespace App\Http\Controllers;

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;

class ParseController extends Controller
{
    public function __construct()
    {
        //parent::__construct();
        ParseClient::initialize('y85gvCv3uUKdvZkHfS3iuteRFhdcVQdhRUv9vM6e', '5UsTjg05xz7q1UpVN5AFTlXYYpSftZH1EpkHL7VZ', 'xqc0IGBCnr6zHvLU3avUoCCr3pbGE9NhMhODV0PH');
    }


    public function photoList()
    {
        $query = new ParseQuery("Photo");

        // All results:
        $results = $query->find();
        $totalResults = count($results);

        $photos = array();
        //        echo "<pre>";
        //        var_dump($results);

        foreach($results as $key => $result) {
            $object = $result;
            $id = $object->getObjectId();
            $created = $object->getCreatedAt();
            $lat = $object->get('lat');
            $lon = $object->get('lon');
            $zone = $object->get('zone');
            $color = $object->get('color');
            
            /*            $userQuery = ParseUser::query();
            $user = $userQuery->get($object->get('user'));
            $userResult = $userQuery->find();
            $userID = $userResult->get('username');
            */
            $image = $object->get('image');
            $imageURL = $image->getURL();

            $approved = $object->get('approved');

            $photos[] = array(
                'id' => $id,
                'created' => $created,
                'lat' => $lat,
                'lon' => $lon,
                //                'user' => $user,
                'imageURL' => $imageURL,
                'approved' => $approved,
                'zone' => $zone,
                'color' => $color
            );
        }

        header('Content-Type: application/json');
        echo json_encode($photos);
    }

    public function photo($id)
    {
        $query = new ParseQuery("Photo");
        $object = $query->get($id);
        $id = $object->getObjectId();
        $created = $object->getCreatedAt();
        $lat = $object->get('lat');
        $lon = $object->get('lon');
        $zone = $object->get('zone');
        $color = $object->get('color');


        $image = $object->get('image');
        $imageURL = $image->getURL();

        $approved = $object->get('approved');
        $photo = array(
            'id' => $id,
            'created' => $created,
            'lat' => $lat,
            'lon' => $lon,
            //                'user' => $user,
            'imageURL' => $imageURL,
            'approved' => $approved,
            'zone' => $zone,
            'color' => $color
        );

        header('Content-Type: application/json');
        echo json_encode($photo);
    }
}