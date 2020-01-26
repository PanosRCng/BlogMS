<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/23/19
 * Time: 10:34 PM
 */

namespace App\Models;



use Illuminate\Database\Eloquent\Model;




class Photo extends Model
{


    protected $table = 'photos';

    public $timestamps = false;


    protected $fillable = [
        'photo_gallery_segment_id',
        'bytes'
    ];



    public function photo_gallery_segment()
    {
        return $this->hasOne('App\Models\PhotoGallerySegment');
    }

}