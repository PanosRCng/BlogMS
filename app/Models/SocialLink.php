<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/23/19
 * Time: 10:34 PM
 */

namespace App\Models;



use Illuminate\Database\Eloquent\Model;




class SocialLink extends Model
{


    protected $table = 'social_links';

    public $timestamps = false;


    protected $fillable = [
        'type',
        'url',
        'enabled',
        'display_order'
    ];



}