<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Models\author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = book::with('author')->get();
        $authors = author::whereDoesntHave('book');
        return view('CRUD.book',compact('data','authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
        ],[
            'name.required'=>'Nama buku harus diisi',
            'name.min'=>'Nama buku minimal 3 karakter',

        ]);

        $data = [
            'author_id' => (int)$request->input('author_id'),
            'name' => $request->input('name'),
            'date' => $request->input('date')
            
        ];
        Book::create($data);

        return redirect()->route('CRUD.index')->with('success','berhasil menambahkan data');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
    $request->validate([
        'name' => 'required|min:3',
        'date' => 'required|date'
    ], [
        'name.required' => 'Nama buku harus diisi',
        'name.min' => 'Nama buku minimal 3 karakter',
    ]);

    // Temukan item berdasarkan ID
    $book = Book::findOrFail($id);

    // Update data
    $book->name = $request->input('name');
    $book->save(); // Simpan perubahan ke database

    // Redirect kembali ke halaman dengan pesan sukses
    return redirect()->route('CRUD.index')->with('success', 'Berhasil mengubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::where('id',$id)->delete();

        return redirect()->route('CRUD.index')->with('success', 'Berhasil menghapus');
    }
}
