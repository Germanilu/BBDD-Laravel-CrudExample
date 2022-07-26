<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getAllContacts(){
        return "GET All contact " ;
    }

    public function getContactById($id){
        return "GET contact by id" .$id;
    }

    public function putContactById($id){
        return "PUT contact by id" .$id;
    }

    public function postContactById(){
        return "POST New contact";
    }

    public function deleteContactById($id){
        return "DELETe contact by id" .$id;
    }
}
