<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = BookResource::collection(Book::with('authors', 'categories')->latest()->paginate(10));

        return response()->json([
            'data' => $book,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {

        // booki image
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('/public/bookImages', $imageName);

        // book file upload as pdf
        $file = $request->file('file_upload');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('/public/bookFileUpload', $fileName);

        // creating new  book
        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'publishing_year' => $request->publishing_year,
            'pages' => $request->pages,
            'language_id' => $request->language_id,
            'image' => $imageName,
            'file_upload' => $fileName,
        ]);
        // creating a book with it's categories & authors
        $book->categories()->attach($request->category_id);
        $book->authors()->attach($request->author_id);

        return response()->json([
            'message' => 'Book created Successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests  $request
     * @param  \App\Models\Book  $book
     */
    public function update(Request $request, Book $book)
    {
        $image = $request->file('image');
        //deleting the old image to the storage
        Storage::delete('/public/bookImages/'.$book->image);
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('/public/bookImages', $imageName);

        // book file upload as pdf
        $file = $request->file('file_upload');
        //deleting the old image to the storage
        Storage::delete('/public/bookFileUpload/'.$book->file_upload);
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('/public/bookFileUpload', $fileName);

        // creating new  book
        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'publishing_year' => $request->publishing_year,
            'pages' => $request->pages,
            'language_id' => $request->language_id,
            'image' => $imageName,
            'file_upload' => $fileName,
        ]);

        // creating a book with it's categories & authors
        $book->categories()->sync($request->category_id);
        $book->authors()->sync($request->author_id);

        return response()->json([
            'message' => 'Book updated Successfully',
            'book' => $book,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        //  deleting the old file upload in storage folder
        Storage::delete('/public/bookFileUpload/'.$book->file_upload);
        //  deleting the old file upload in storage folder
        Storage::delete('/public/bookImages/'.$book->image);

        return response()->json([
            'message' => 'Book deleted Successfully',
        ], 200);
    }
}
