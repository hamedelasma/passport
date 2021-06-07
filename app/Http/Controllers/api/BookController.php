<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Author;
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
        $books = Book::get();

        return response()->json([
            "status" => 1,
            "message" => "All Books",
            "data" => $books
        ]);
    }
    public function authorBook()
    {
        $author_id = auth()->user()->id;
        $books = Author::find($author_id)->books;

        return response()->json([
            "status" => 1,
            "message" => "Author Books",
            "data" => $books
        ]);
    }
    public function show($id){
        $author_id = auth()->user()->id;

        if (Book::where([
            "author_id" => $author_id,
            "id" => $id
        ])->exists()) {

            $book = Book::find($id);

            return response()->json([
                "status" => true,
                "message" => "Book data found",
                "data" => $book
            ]);
        } else {

            return response()->json([
                "status" => false,
                "message" => "Author Book doesn't exists"
            ]);
        }
    }
    public function update(Request $request,$id){
        $author_id = auth()->user()->id;

        if (Book::where([
            "author_id" => $author_id,
            "id" => $id
        ])->exists()) {
            $book = Book::find($id);
            $book->title = isset($request->title) ? $request->title : $book->title;
            $book->description = isset($request->description) ? $request->description : $book->description;
            $book->book_cost = isset($request->book_cost) ? $request->book_cost : $book->book_cost;
            $book->save();
            return response()->json([
                "status" => 1,
                "message" => "Book data has been updated"
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Author Book doesn't exists"
            ]);
        }
    }
    public function delete($id){
        $author_id = auth()->user()->id;

        if (Book::where([
            "author_id" => $author_id,
            "id" => $id
        ])->exists()) {

            $book = Book::find($id);

            $book->delete();

            return response()->json([
                "status" => true,
                "message" => "Book has been deleted"
            ]);
        }else{

            return response()->json([
                "status" => false,
                "message" => "Author Book doesn't exists"
            ]);
        }
    }
}
