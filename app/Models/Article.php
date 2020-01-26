<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/23/19
 * Time: 10:34 PM
 */

namespace App\Models;



use App\Services\ArticleService;
use Illuminate\Database\Eloquent\Model;




class Article extends Model
{


    protected $table = 'articles';

    public $timestamps = true;


    protected $fillable = [
        'title',
        'enabled'
    ];



    public function article_segments()
    {
        return $this->hasMany('App\Models\ArticleSegment')->orderBy('display_order');
    }


    public function segment_display_order()
    {
        $last_segment = $this->hasMany('App\Models\ArticleSegment')->orderBy('display_order', 'desc')->first();

        if($last_segment == null)
        {
            return 0;
        }

        return ($last_segment->display_order + 1);
    }


    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'categories_articles')->withPivot('display_order');
    }


    public function enabled_article_segments()
    {
        return $this->article_segments->where('enabled', '=', '1');
    }


    public function images()
    {
        return ArticleService::article_images($this->id);
    }


    public function template()
    {
        if($this->template != null)
        {
            return $this->template;
        }

        return ArticleService::DEFAULT_ARTICLE_TEMPLATE;
    }


}