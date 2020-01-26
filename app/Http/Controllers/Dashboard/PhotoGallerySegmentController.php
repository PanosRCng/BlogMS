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
use App\Models\Photo;




class PhotoGallerySegmentController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }




    public function update_description(Request $request, $article_segment_id)
    {
        $segment = ArticleSegment::find($article_segment_id)->segment();

        $validator = Validator::make($request->all(), [
            'description' => 'nullable|max:2048',
        ]);

        if( $validator->fails() )
        {
            return redirect('/dashboard/segment/' . $segment->id);
        }

        $segment->description = $request->get('description');
        $segment->save();

        return redirect('/dashboard/segment/' . $article_segment_id);
    }




    public function add_photo(Request $request, $article_segment_id)
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

        $photo = new Photo(['photo_gallery_segment_id' => $segment->id, 'bytes' => $data]);
        $photo->save();

        return redirect('/dashboard/segment/' . $article_segment_id);
    }


    public function delete_photo($article_segment_id, $photo_id)
    {
        $photo = Photo::find($photo_id);
        $photo->delete();

        return redirect('/dashboard/segment/' . $article_segment_id);
    }

}