<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/27/19
 * Time: 10:47 PM
 */

namespace App\Services;


use Illuminate\Support\Facades\Storage;
use App\Models\Article;




class ArticleService
{

    const DEFAULT_ARTICLE_TEMPLATE = 'default';



    public static function delete_article($article_id)
    {
        $article = Article::find($article_id);

        foreach($article->article_segments as $article_segment)
        {
            SegmentService::delete_segment($article_segment->id);
        }

        $article->delete();
    }


    public static function featured_articles()
    {
        $featured_articles_category = CategoryService::featured_articles_category();

        $featured_articles = $featured_articles_category->articles()->get();

        if($featured_articles)
        {
            return $featured_articles;
        }

        return [];
    }


    public static function article_images($article_id)
    {
        $images = [];

        $article = Article::find($article_id);

        foreach($article->article_segments as $article_segment)
        {
            if($article_segment->segment_type == 'photo gallery')
            {
                $segment = SegmentService::find_segment($article_segment->segment_type, $article_segment->segment_id);

                foreach($segment->photos as $photo)
                {
                    $images[] = $photo->bytes;
                }
            }

            if($article_segment->segment_type == 'file')
            {
                $segment = SegmentService::find_segment($article_segment->segment_type, $article_segment->segment_id);

                if($segment->preview != null)
                {
                    $images[] = $segment->preview;
                }
            }
        }

        return $images;
    }


    public static function change_segment_order($article_id, $article_segment_id, $direction='up')
    {
        $article = Article::find($article_id);
        $article_segment = $article->article_segments()->where('id', '=', $article_segment_id)->first();

        $current_order = $article_segment->display_order;

        if($direction == 'up')
        {
            $displaced_article_segment = $article->article_segments()->where('display_order', '<', $current_order)->orderBy('display_order', 'desc')->first();
        }
        else if($direction == 'down')
        {
            $displaced_article_segment = $article->article_segments()->where('display_order', '>', $current_order)->orderBy('display_order', 'asc')->first();
        }

        if($displaced_article_segment == null)
        {
            return;
        }

        $article_segment->display_order = $displaced_article_segment->display_order;
        $displaced_article_segment->display_order = $current_order;

        $article_segment->save();
        $displaced_article_segment->save();
    }


    public static function templates()
    {
        $templates = [];

        $templates[] = static::DEFAULT_ARTICLE_TEMPLATE;

        foreach(Storage::disk('article_templates')->files('') as $file)
        {
            $templates[] = str_replace('.blade.php', '', $file);
        }

        return $templates;
    }


}