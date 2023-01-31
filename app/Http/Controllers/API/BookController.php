<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json([
            'data' => $books
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'successfully creating book',
            'data' => [
                'code' => 200,
                'title' => $request->title,
                'description' => $request->description
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::where('id', $id)->get();
        return response()->json([
            'data' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $input = $request->all();
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $book = Book::where('id', $id)->latest()->first();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->save();
        return response()->json([
            'message' => 'successfully update book',
            'data' => [
                'code' => 200,
                'title' => $request->title,
                'description' => $request->description
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $book = Book::where('id', $id)->first();
       $book->delete();
       return response()->json([
         'message' => 'Successfully Delete Book'
       ]);
    }
}
