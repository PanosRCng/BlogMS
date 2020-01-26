<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 1/23/20
 * Time: 12:38 AM
 */

namespace App\Services;



use App\Models\SocialLink;




class SocialLinkService
{

    const LINKS_TYPES_ICONS = [
        'github' => 'fa fa-github-square fa-lg',
        'linkedin' => 'fa fa-linkedin-square fa-lg',
        'twitter' => 'fa fa-twitter-square fa-lg',
        'facebook' => 'fa fa-facebook-square fa-lg',
        'email' => 'fa fa-envelope-square fa-lg',
        'other' => 'fa fa-external-link-square fa-lg'
    ];


    public static function create($type, $url)
    {
        $display_order = 0;

        $link = SocialLink::orderBy('display_order', 'desc')->first();
        if($link != null)
        {
            $display_order = $link->display_order + 1;
        }

        $socialLink = new SocialLink(['type' => $type, 'url' => $url, 'display_order' => $display_order]);
        $socialLink->save();
    }



    public static function change_link_order($social_link_id, $direction='up')
    {
        $socialLink = SocialLink::find($social_link_id);

        $current_order = $socialLink->display_order;

        if($direction == 'up')
        {
            $displaced_link = SocialLink::where('display_order', '<', $current_order)->orderBy('display_order', 'desc')->first();
        }
        else if($direction == 'down')
        {
            $displaced_link = SocialLink::where('display_order', '>', $current_order)->orderBy('display_order', 'asc')->first();
        }

        if($displaced_link == null)
        {
            return;
        }

        $socialLink->display_order = $displaced_link->display_order;
        $displaced_link->display_order = $current_order;

        $socialLink->save();
        $displaced_link->save();
    }

}