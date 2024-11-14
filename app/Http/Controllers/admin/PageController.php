<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start with the base query for pages
        $pages = Page::orderBy('id', 'ASC');

        // If there is a search keyword, apply it to the query
        if ($keyword = $request->get("keyword")) {
            $pages->where(function ($query) use ($keyword) {
                // Existing search criteria for pages table
                $query->where("pages.name", "like", "%{$keyword}%")
                    ->orWhere("pages.slug", "like", "%{$keyword}%")
                ->orWhere("pages.content", "like", "%{$keyword}%");
            });
        }

        // Apply pagination on the query and fetch the results
        $pages = $pages->get();

        return view("admin.Pages.list", compact("pages"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.Pages.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages',
            'content' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $page = new Page();
        $page->name = $request->input('name');
        $page->slug = $request->input('slug');
        $page->content = $request->input('content');
        $page->status = $request->input('status');
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $pageId)
    {
        $page = Page::find($pageId);

        // dd("page Data : " , $page);

        return view("admin.Pages.show", compact("page"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.Pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $id,
            'content' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $page = Page::findOrFail($id);
        $page->name = $request->input('name');
        $page->slug = $request->input('slug');
        $page->content = $request->input('content');
        $page->status = $request->input('status');
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
