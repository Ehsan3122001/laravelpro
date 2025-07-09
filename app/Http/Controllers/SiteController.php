<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index'); // الصفحة الرئيسية
    }

    public function about()
    {
        return view('site.about'); // صفحة من نحن
    }

    public function team()
    {
        return view('site.team'); // صفحة تواصل معنا
    }

    public function testimonial()
    {
        return view('site.testimonial'); // صفحة تواصل معنا
    }

    public function contact()
    {
        return view('site.contact'); // صفحة تواصل معنا
    }

    public function courses()
    {
        return view('site.courses'); // قائمة الدورات
    }

    public function login()
    {
        return view('auth.login'); // صفحة تسجيل الدخول من لارفيل
    }
}
