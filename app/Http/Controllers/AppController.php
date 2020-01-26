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
use App\Models\FileSegment;
use App\Models\Photo;
use App\Services\ArticleService;
use App\Services\SidebarService;


class AppController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }




    public function index()
    {
        $homepage = SidebarService::sidebar()->homepage;

        if($homepage != null)
        {
            return redirect($homepage);
        }

        return redirect('/dashboard');
    }



    public function article($title)
    {
        $article = Article::where('title', '=', $title)->first();

        if($article == null)
        {
            abort(404);
        }

        if($article->template() == ArticleService::DEFAULT_ARTICLE_TEMPLATE)
        {
            return view('article', ['article' => $article]);
        }

        return view('article_templates.' . $article->template(), ['article' => $article]);
    }


    public function category($name)
    {
        $category = Category::where('name', '=', $name)->where('enabled', '=', 1)->first();

        if($category == null)
        {
            abort(404);
        }

        return view('category', ['category' => $category]);
    }


    public function file($name)
    {
        $file_segment = FileSegment::where('name', '=', $name)->first();

        if($file_segment == null)
        {
            abort(404);
        }

        header("Content-type: application/pdf");
        echo base64_decode($file_segment->file);
    }


    public function photo($id)
    {
        $photo = Photo::where('id', '=', $id)->first();

        if($photo == null)
        {
            abort(404);
        }

        header("Content-type: image/png");
        echo base64_decode($photo->bytes);
    }

}