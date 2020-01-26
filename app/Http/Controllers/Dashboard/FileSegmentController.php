<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/27/19
 * Time: 10:31 PM
 */

namespace App\Http\Controllers\Dashboard;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ArticleSegment;





class FileSegmentController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }






    public function update(Request $request, $article_segment_id)
    {
        $segment = ArticleSegment::find($article_segment_id)->segment();

        $validator = Validator::make($request->all(), [
            'name' => 'max:256',
            'description' => 'nullable|max:2048',
        ]);

        if( $validator->fails() )
        {
            return redirect('/dashboard/segment/' . $segment->id);
        }

        $segment->name = $request->get('name');
        $segment->description = $request->get('description');
        $segment->save();

        return redirect('/dashboard/segment/' . $article_segment_id);
    }


    public function upload_file(Request $request, $article_segment_id)
    {
        $segment = ArticleSegment::find($article_segment_id)->segment();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf',
        ]);

        if($validator->fails())
        {
            return redirect('/dashboard/segment/' . $article_segment_id);
        }

        $data = file_get_contents(realpath(request()->file));
        $data = base64_encode($data);

        $segment->file = $data;
        $segment->save();

        return redirect('/dashboard/segment/' . $article_segment_id);
    }


    public function delete_file($article_segment_id)
    {
        $segment = ArticleSegment::find($article_segment_id)->segment();

        $segment->file = null;
        $segment->save();

        return redirect('/dashboard/segment/' . $article_segment_id);
    }


    public function upload_file_preview(Request $request, $article_segment_id)
    {
        $segment = ArticleSegment::find($article_segment_id)->segment();


        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails())
        {
            return redirect('/dashboard/segment/' . $article_segment_id);
        }

        $data = file_get_contents(realpath(request()->file));
        $data = base64_encode($data);

        $segment->preview = $data;
        $segment->save();

        return redirect('/dashboard/segment/' . $article_segment_id);
    }


    public function delete_file_preview($article_segment_id)
    {
        $segment = ArticleSegment::find($article_segment_id)->segment();

        $segment->preview = null;
        $segment->save();

        return redirect('/dashboard/segment/' . $article_segment_id);
    }




}