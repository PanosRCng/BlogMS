<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/23/19
 * Time: 10:34 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class PhotoGallerySegment extends Model
{

    const TYPE = 'photo gallery';


    protected $table = 'photo_gallery_segments';

    public $timestamps = false;


    protected $fillable = [
        'description',
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


    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }

}