<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/23/19
 * Time: 10:34 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class FileSegment extends Model
{

    const TYPE = 'file';


    protected $table = 'file_segments';

    public $timestamps = false;


    protected $fillable = [
        'name',
        'description',
        'file',
        'preview'
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