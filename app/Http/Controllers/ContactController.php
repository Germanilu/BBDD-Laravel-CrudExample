<?php

namespace App\Http\Controllers;

use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{


    //GET ALL
    public function getAllContacts()
    {
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

            return response()->json([
                'success' => true,
                'message' => 'Get all contacts Retrieved',
                'data' => $contacts
            ]);
        } catch (\Exception $exception) {
            //El log del error
            Log::error('Error getting contacts: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error getting contacts'
            ], 500);
        }
    }


    //GET BY ID

    public function getContactById($id)
    {

        try {

            Log::info('Getting contact');

            //Busco el id en contact
            $contact = Contact::query()
                ->find($id);
            //Si el id no existe devuelvo error
            if (!$contact) {
                return response()->json([
                    'success' => true,
                    'message' => 'Contact not found',
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Get contact by ID',
                'data' => $contact
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Error getting contact by id: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error getting contact by ID'
            ], 500);
        }
    }




    //POST CONTACT 
    public function postContactById(Request $request)
    {

        try {
            Log::info('Creating contact');

            // Validaciones (Documentacion: Available Validation Rules)
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone_number' => 'digits_between:9,12|required|string',
                'birthday' => 'before:today|required',

            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };


            //Esto es para ver si estoy recuperando el name (dumpDie)
            // dd($request->input('name'));

            //Requiero con cada linea lo que le paso en postman
            $name = $request->input('name');
            $email = $request->input('email');
            $phoneNumber = $request->input('phone_number');
            $birthday = $request->input('birthday');
            $userId = $request->input('user_id');


            //Instancio un nuevo obj de newUser
            $newContact = new Contact();

            $newContact->name = $name;
            $newContact->email = $email;
            $newContact->phone_number = $phoneNumber;
            $newContact->birthday = $birthday;
            $newContact->user_id = $userId;

            $newContact->save();

            return response()->json([
                'success' => true,
                'message' => 'POST New contact',
                'data' => $newContact
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Error Creating contact: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error Creating new Contact'
            ], 500);
        }
    }
    //Edit Contact
    public function putContactById(Request $request, $id)
    {

        try {
            //Hago las validaciones 
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'email' => 'email',
                'phone_number' => 'string'

            ]);
            //Si failea una validacion devuelvo un error 
            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };

            //Recupero el contacto existente
            $contact = Contact::query()->findOrFail($id);

            //Le digo que lo setee el nuevo campo que le estoy pasando x body en contact
            $name =  $request->input('name');
            $email = $request->input('email');
            $phone_number = $request->input('phone_number');
            if (isset($name)) {
                $contact->name = $name;
            } else if (isset($email)) {
                $contact->email = $email;
            } else if (isset($phone_number)) {
                $contact->phone_number = $phone_number;
            }

            //Guardo el nuevo contact
            $contact->save();

            return response()->json([
                'success' => true,
                'message' => 'PUT New contact',
                'data' => $contact
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Error Updating contact: ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Updating Contact'
            ], 500);
        }
    }


    //Delete Contact
    public function deleteContactById($id)
    {

        try {
            Log::info('Deleting contact');
            //Busco el id por url
            $contact = Contact::query()
                ->find($id);
            //Si no encuentro el ID tiro error
            if (!$contact) {
                return response()->json([
                    'success' => true,
                    'message' => 'Unable to delete Contact.',
                ], 400);
            }
            //Si lo encuentro aqui lo borro
            $contact->delete();

            return response()->json([
                'success' => true,
                'message' => 'Contact Deleted',
                'data' => $contact
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Error Deleting contact: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error Deleting Contact'
            ], 500);
        }
        return "DELETe contact by id" . $id;
    }
}
