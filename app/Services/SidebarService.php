<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 12/2/19
 * Time: 11:59 PM
 */

namespace App\Services;



use App\Models\Sidebar;




class SidebarService
{

    public static function sidebar()
    {
        $sidebar = Sidebar::all()->first();

        if($sidebar == null)
        {
            $sidebar = new Sidebar();
            $sidebar->save();
        }

        return $sidebar;
    }

}