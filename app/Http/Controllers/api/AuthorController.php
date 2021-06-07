<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{

    public function register(Request $request){
// validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:authors",
            "password" => "required|confirmed",
            "phone_no" => "required"
        ]);

        // create data
        $author = new Author();

        $author->name = $request->name;
        $author->email = $request->email;
        $author->phone_no = $request->phone_no;
        $author->password = bcrypt($request->password);

        // save data and send response
        $author->save();

        return response()->json([
            "status" => 1,
            "message" => "Author created successfully"
        ]);
    }
    public function login(Request $request){
        // validation
        $login_data = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
        // validate author data
        if(!auth()->attempt($login_data)){

            return response()->json([
                "status" => false,
                "message" => "Invalid Credentials"
            ]);
        }

        // token
        $token = auth()->user()->createToken("auth_token")->accessToken;

        // send response
        return response()->json([
            "status" => true,
            "message" => "Author Logged in successfully",
            "access_token" => $token
        ]);
    }
    public function profile(){

    }
    public function logout(){

    }
}
