<?php
namespace App\ViewComposers;


use App\MenuItem;
use Illuminate\View\View;

class FrontLayoutViewComposer
{
    public function compose(View $view)
    {
        $menu = MenuItem::getMenu(1);
        $view->with(compact('menu'));
    }
}