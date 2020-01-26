<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 6/8/19
 * Time: 1:23 AM
 */

namespace App\Http\Controllers;



use App\Models\Article;
use App\Models\Category;
use App\Models\SocialLink;
use App\Services\SidebarService;
use App\Services\CategoryService;




class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        return redirect('dashboard/articles');
    }



    public function sidebar()
    {
        $data = [
            'sidebar' => SidebarService::sidebar()
        ];

        return view('dashboard/sidebar', $data);
    }


    public function featured_articles()
    {
        $data = [
            'category' => CategoryService::featured_articles_category()
        ];

        return view('dashboard/category', $data);
    }


    public function articles()
    {
        $data = [
            'articles' => Article::all()
        ];

        return view('dashboard/articles', $data);
    }


    public function categories()
    {
        $data = [
            'categories' => Category::all()
        ];

        return view('dashboard/categories', $data);
    }


    public function social_links()
    {
        $data = [
            'socialLinks' => SocialLink::all()->sortBy('display_order')
        ];

        return view('dashboard/social_links', $data);
    }

}