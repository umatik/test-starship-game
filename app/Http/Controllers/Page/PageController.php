<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;

/**
 * Class PageController
 * @package App\Http\Controllers\Pages
 */
class PageController  extends Controller
{
    /**
     * @return Factory|View
     */
    public function home()
    {
        return view('Pages.home');
    }

    /**
     * @return Factory|View
     */
    public function game()
    {
        return view('Pages.game');
    }
}
