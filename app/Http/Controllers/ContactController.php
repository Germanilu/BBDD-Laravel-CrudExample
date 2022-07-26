<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function getAllContacts(){
        try {
            //El log es para ver si todo va bien
            Log::info('Getting all contacts');

            //Query Builder
            //A la variable $users le paso el db de contacts y le digo de seleccionar algunos campos y que me haga un get y lo devuelva en array
        // $users = DB::table('contacts')->select('name','email')->get()->toArray();

        //MODEL
        $contacts = Contact::query()
        ->get()
        ->toArray();
    
        return response()-> json([
            'success' => true,
            'message' => 'Get all contacts Retrieved',
            'data' => $contacts 
        ]) ;
        } catch (\Exception $exception) {
            //El log del error
            Log::error('Error getting contacts: '.$exception->getMessage());
            return response()-> json([
                'success' => false,
                'message' => 'Error getting contacts'
            ],500);
        }
    }

    public function getContactById($id){

        try {
            $contact = Contact::query()
            ->find($id);

            if(!$contact){
                return response()-> json([
                    'success' => true,
                    'message' => 'Contact not found',
                ],400) ;
            }
    
            return response()-> json([
                'success' => true,
                'message' => 'Get contact by ID',
                'data' => $contact 
            ],200) ;

            
        } catch (\Exception $exception) {
            return response()-> json([
                'success' => false,
                'message' => 'Error getting contact by ID'
            ],500);
        }
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
