<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
}
