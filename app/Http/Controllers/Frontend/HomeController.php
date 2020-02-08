<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\CmsPerson;
use App\CmsImage;
use App\Setting;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $staff = CmsPerson::all();
        $gallery = CmsImage::orderBy('sort', 'asc')->get();
        $setting = Setting::pluck('value', 'key');
        return view('frontend.index2', compact('staff', 'gallery', 'setting'));
    }

}
