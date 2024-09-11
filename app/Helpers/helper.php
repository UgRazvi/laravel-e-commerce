<?php

// echo "Hello Usman";

use App\Models\Category;
use App\Models\Section;
use App\Models\SubCategory;

// function getSections()
// {
// return Section::orderBy('id', 'asc')
// ->with('category')
// ->where('showhome', '=', 'Yes')
// ->get();
// }

function getSections()
{
    // Fetch sections with their respective categories and subcategories
    return Section::with('categories.subcategories')
    ->where('status','=',1)
        ->where('showhome', '=', 'Yes')  // Filter by 'showhome' attribute
        ->orderBy('id', 'asc')           // Order sections by ID
        ->get();                         // Retrieve the collection
}


  function getCategories()
  {
      return Category::orderBy('name', 'asc')
          ->with('subcategories')
          ->where('showhome', '=', 'Yes')
          ->get();
  }
  function getSubCategories()
  {
      return SubCategory::orderBy('name', 'asc')
          ->where('showhome', '=', 'Yes')
          ->get();
  }