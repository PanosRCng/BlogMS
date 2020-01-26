<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/27/19
 * Time: 10:31 PM
 */

namespace App\Http\Controllers\Dashboard;



use App\Http\Controllers\Controller;
use App\Models\ArticleSegment;
use App\Services\SegmentService;




class SegmentController extends Controller
{

    const SEGMENT_TYPE_VIEWS = [
        'text' => 'dashboard/segment_text',
        'file' => 'dashboard/segment_file',
        'photo gallery' => 'dashboard/segment_photo_gallery',
    ];


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function segment($article_segment_id)
    {
        $segment = ArticleSegment::find($article_segment_id)->segment();

        return view(static::SEGMENT_TYPE_VIEWS[$segment->type()], ['segment' => $segment]);
    }


    public function enable($article_segment_id)
    {
        $article_segment = ArticleSegment::find($article_segment_id);
        $article_segment->enabled = 1;
        $article_segment->save();

        return redirect('dashboard/article/' . $article_segment->article->id);
    }


    public function disable($article_segment_id)
    {
        $article_segment = ArticleSegment::find($article_segment_id);
        $article_segment->enabled = 0;
        $article_segment->save();

        return redirect('dashboard/article/' . $article_segment->article->id);
    }


    public function delete($article_segment_id)
    {
        $article_segment = ArticleSegment::find($article_segment_id);

        $article_id = $article_segment->article->id;

        SegmentService::delete_segment($article_segment_id);

        return redirect('dashboard/article/' . $article_id);
    }



}