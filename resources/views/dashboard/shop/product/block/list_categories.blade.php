<select name="category_id" required>
    @foreach ($categories as $category)
        @if($category->isActive())
            <option value="{{ $category->id }}" @if($category->id == $active) selected @endif>
                @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor{{ $category->title }}
            </option>
        @endif
    @endforeach
</select>
