<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/23/19
 * Time: 10:34 PM
 */

namespace App\Models;



use Illuminate\Database\Eloquent\Model;




class Category extends Model
{


    protected $table = 'categories';

    public $timestamps = false;


    protected $fillable = [
        'name',
        'enabled',
        'display_order'
    ];



    public function articles()
    {
        return $this->belongsToMany('App\Models\Article', 'categories_articles')->withPivot('display_order')->orderBy('display_order', 'asc');
    }



}