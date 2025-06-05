<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Facades\BookFacade;

class BookController extends Controller
{
    protected $bookFacade;

    public function __construct(BookFacade $bookFacade)
    {
        $this->bookFacade = $bookFacade;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->bookFacade->listBooks();
        
        return Inertia::render("books/index", [
            "books" => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("books/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "Titulo" => "required",
            "Editora" => "required",
            "Edicao" => "required",
            "AnoPublicacao" => "required",
            "Preco" => "required",
        ]);

        $this->bookFacade->createBook($request->all()); 

        return redirect()->route("books.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = $this->bookFacade->getBook($id);
        
        return Inertia::render("books/edit", [
            "book" => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "Titulo" => "required",
            "Editora" => "required",
            "Edicao" => "required",
            "AnoPublicacao" => "required",
            "Preco" => "required",
        ]);

        $this->bookFacade->updateBook($id, $request->all()); 

        return redirect()->route("books.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->bookFacade->deleteBook($id);

        return redirect()->route("books.index");
    }
}
