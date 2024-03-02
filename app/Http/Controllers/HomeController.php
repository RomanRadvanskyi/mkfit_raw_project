<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function homepage()
    {
        return view('web.homepage');
    }
    public function servicespage()
    {
        return view('web.servicespage');
    }
    public function gallerypage()
    {
        return view('web.gallerypage');
    }
    public function contactpage()
    {
        return view('web.contactpage');
    }

    public function index()
    {
        if (Auth::id())
        {
            $usertype=Auth()->user()->usertype;
            if ($usertype=='user')
            {
                return view('dashboard');
            }
            elseif ($usertype=='admin')
            {
                return view('admin.adminhome');
            }
            else {
                return redirect()->back();
            }
        }
    }
}
