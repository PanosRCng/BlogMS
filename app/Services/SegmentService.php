<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/25/19
 * Time: 11:00 PM
 */

namespace App\Services;




use App\Models\Article;
use App\Models\ArticleSegment;




class SegmentService
{

    const SEGMENT_TYPE_CLASSES = [
        'text' => 'App\Models\TextSegment',
        'file' => 'App\Models\FileSegment',
        'photo gallery' => 'App\Models\PhotoGallerySegment'
    ];




    public static function create_segment($segment_type)
    {
        $segmentClass = static::SEGMENT_TYPE_CLASSES[$segment_type];

        $segment = new $segmentClass();
        $segment->save();

        return $segment;
    }


    public static function find_segment($segment_type, $segment_id)
    {
        $segmentClass = static::SEGMENT_TYPE_CLASSES[$segment_type];

        return $segmentClass::find($segment_id);
    }


    public static function delete_segment($article_segment_id)
    {
        $article_segment = ArticleSegment::find($article_segment_id);

        $segment = $article_segment->segment();

        if($segment->type() == 'photo gallery')
        {
            foreach($segment->photos as $photo)
            {
                $photo->delete();
            }
        }

        $segment->delete();

        $article_segment->delete();
    }


    public static function add_segment($article, $segment_type)
    {
        $segment = static::create_segment($segment_type);

        $data = [
            'article_id' => $article->id,
            'segment_id' => $segment->id,
            'segment_type' => $segment->type(),
            'display_order' => $article->segment_display_order(),
            'enabled' => 1
        ];

        $article_segment = new ArticleSegment($data);
        $article_segment->save();

        return $article_segment;
    }

}