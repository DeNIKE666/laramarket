<?php
namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class NavCategoriesComposer
{
    public function compose(View $view)
    {
        $view->with('navbarCategories', Category::getAllCategory());
    }
}
