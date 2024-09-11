<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // return view("front.clone_x.index"); // Already Cloned.
        //  return view("front.clone_y.index"); // Basic Design.
     
        return view("front.Ytb_home"); // To Follow The Proccess
        
        // return view("front.index"); // My Clone

        // return view("front.clone-index"); // Pre Clone  
        
        // return view("front.myntra-code"); // To Analyze Structure
        // return view("front.test-index"); // To Test Data
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
