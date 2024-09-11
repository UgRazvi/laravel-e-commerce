@if (!empty(getSections()))
    @foreach (getSections() as $section)
        
                {{ $section->name }}
                @if ($section->categories->isNotEmpty())
                    
                        @foreach ($section->categories as $category)
                    
                                {{ $category->name }}
                                @if ($category->subcategories->isNotEmpty())
                         
                                        @foreach ($category->subcategories as $subcategory)
                                            <li>{{ $subcategory->name }}</li>
                                        @endforeach
                                    
                                @endif
                            
                        @endforeach
                    
                @endif
      
    @endforeach
@endif




{{-- @if (!empty(getSections()))
    @foreach (getSections() as $section)
        <ul>
            <li>
                {{ $section->name }}
                @if ($section->categories->isNotEmpty())
                    <ul>
                        @foreach ($section->categories as $category)
                            <li>
                                {{ $category->name }}
                                @if ($category->subcategories->isNotEmpty())
                                    <ul>
                                        @foreach ($category->subcategories as $subcategory)
                                            <li>{{ $subcategory->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        </ul>
    @endforeach
@endif --}}