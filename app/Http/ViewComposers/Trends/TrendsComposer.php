<?php

namespace App\Http\ViewComposers\Trends;

use App\Models\Category;
use App\Models\RequestProduct;
use Illuminate\Contracts\View\View;

class TrendsComposer
{

    /**
     * TrendsComposer constructor.
     */
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $trends = [];
        $requestProductsAll = RequestProduct::get()->groupBy('category_id');

        foreach($requestProductsAll as $index => $value) {
            if($value != "") {
                $trends[$index]['title'] = Category::whereCategoryId($index)->first()->title;
                $trends[$index]['count'] = count($value);
            }
        }

        $view->with(compact('trends'));
    }
}