<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/23/19
 * Time: 10:34 PM
 */

namespace App\Models;



use Illuminate\Database\Eloquent\Model;




class Sidebar extends Model
{


    protected $table = 'sidebar';

    public $timestamps = false;


    protected $fillable = [
        'title',
        'logo',
        'homepage',
        'show_featured_articles',
        'show_social_links',
        'show_categories',
    ];



    public function options()
    {
        return [
            'show_featured_articles',
            'show_social_links',
            'show_categories',
        ];
    }


}