<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/23/19
 * Time: 10:34 PM
 */

namespace App\Models;


use App\Services\SegmentService;
use Illuminate\Database\Eloquent\Model;




class ArticleSegment extends Model
{


    protected $table = 'articles_segments';

    public $timestamps = false;


    protected $fillable = [
        'article_id',
        'segment_id',
        'segment_type',
        'display_order',
        'enabled'
    ];



    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }


    public function segment()
    {
        return SegmentService::find_segment($this->segment_type, $this->segment_id);
    }

}