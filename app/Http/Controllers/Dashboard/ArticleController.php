<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/27/19
 * Time: 10:31 PM
 */

namespace App\Http\Controllers\Dashboard;



use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Article;
use App\Services\SegmentService;




class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }





    public function article($id)
    {
        $data = [
            'article' => Article::find($id)
        ];

        return view('dashboard/article', $data);
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:2048',
        ]);

        if( $validator->fails() )
        {
            return redirect('dashboard/articles')
                ->withErrors($validator)
                ->withInput();
        }

        $article = new Article(['title' => $request->get('title')]);
        $article->save();

        return redirect('dashboard/articles');
    }



    public function delete($id)
    {
        ArticleService::delete_article($id);

        return redirect('dashboard/articles');
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:2048',
            'description' => 'nullable|max:2048',
            'template' => 'max:256',
        ]);

        if( $validator->fails() )
        {
            return redirect('dashboard/article/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $article = Article::find($id);
        $article->title = $request->get('title');
        $article->description = $request->get('description');
        $article->template = $request->get('template');
        $article->save();

        return redirect('dashboard/article/' . $id);
    }


    public function enable($id)
    {
        $article = Article::find($id);
        $article->enabled = 1;
        $article->save();

        return redirect('dashboard/articles');
    }


    public function disable($id)
    {
        $article = Article::find($id);
        $article->enabled = 0;
        $article->save();

        return redirect('dashboard/articles');
    }


    public function create_segment(Request $request, $article_id)
    {
        $article = Article::find($article_id);

        $article_segment = SegmentService::add_segment($article, $request->get('segment_type'));

        return redirect('/dashboard/segment/' . $article_segment->id);
    }


    public function move_up_segment($article_id, $article_segment_id)
    {
        ArticleService::change_segment_order($article_id, $article_segment_id, 'up');

        return redirect('dashboard/article/' . $article_id);
    }


    public function move_down_segment($article_id, $article_segment_id)
    {
        ArticleService::change_segment_order($article_id, $article_segment_id, 'down');

        return redirect('dashboard/article/' . $article_id);
    }

}