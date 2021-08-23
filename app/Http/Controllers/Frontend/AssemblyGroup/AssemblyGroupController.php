<?php


namespace App\Http\Controllers\Frontend\AssemblyGroup;


use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Contracts\View\View;

class AssemblyGroupController extends FrontendController
{
    /**
     * @return View
     */
    public function index()
    {
        return view('frontend.assembly-groups.index');
    }
}
