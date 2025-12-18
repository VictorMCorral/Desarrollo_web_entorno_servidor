<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Esto es el index";
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Esto es el create";
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Esto es el store con: " . $request->name ." con cantidad de " . $request->price;
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Esto es el show con: " . $id;
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Esto es el edit con: " . $id;
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Esto es el update con: " . $request . " y " . $id;
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "Esto es el destroy con: " . $id;
    }
}
