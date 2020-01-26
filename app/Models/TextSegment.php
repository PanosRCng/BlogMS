<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/23/19
 * Time: 10:34 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class TextSegment extends Model
{

    const TYPE = 'text';


    protected $table = 'text_segments';

    public $timestamps = false;


    protected $fillable = [
        'text',
    ];



    public function type()
    {
        return static::TYPE;
    }


    public function article_segment()
    {
        return $this->hasOne('App\Models\ArticleSegment', 'segment_id')->where('segment_type', '=', static::TYPE);
    }


    public function article()
    {
        return $this->article_segment->article;
    }

}