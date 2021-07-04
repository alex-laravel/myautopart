<?php


namespace App\Http\Controllers\Frontend\AssemblyGroup;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AssemblyGroupController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('frontend.assembly-groups.index');
    }
}
