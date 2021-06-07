<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create(Request $request){
// validation
        $request->validate([
            "title" => "required",
            "book_cost" => "required"
        ]);

        // create book data
        $book = new Book();

        $book->author_id = auth()->user()->id;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->book_cost = $request->book_cost;

        // save
        $book->save();

        // send response
        return response()->json([
            "status" => 1,
            "message" => "Book created successfully"
        ]);
    }
    public function index(){

    }
    public function show($id){

    }
    public function update(Request $request,$id){

    }
    public function delete($id){

    }
}
