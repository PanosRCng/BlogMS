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





class TextSegmentController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }




    public function update_text(Request $request, $article_segment_id)
    {
        $segment = ArticleSegment::find($article_segment_id)->segment();

        $validator = Validator::make($request->all(), [
            'text' => 'nullable',
        ]);

        if( $validator->fails() )
        {
            return redirect('/dashboard/segment/' . $article_segment_id);
        }

        $segment->text = $request->get('text');
        $segment->save();

        return redirect('/dashboard/segment/' . $article_segment_id);
    }


}