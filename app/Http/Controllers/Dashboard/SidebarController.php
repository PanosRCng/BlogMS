<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/27/19
 * Time: 10:31 PM
 */

namespace App\Http\Controllers\Dashboard;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\SidebarService;




class SidebarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }




    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:1024',
            'homepage' => 'max:2048',
        ]);

        if( $validator->fails() )
        {
            return redirect('dashboard/sidebar')
                ->withErrors($validator)
                ->withInput();
        }

        $sidebar = SidebarService::sidebar();
        $sidebar->title = $request->get('title');
        $sidebar->homepage = $request->get('homepage');
        $sidebar->save();

        return redirect('dashboard/sidebar');
    }



    public function upload_logo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails())
        {
            return redirect('dashboard/sidebar');
        }

        $sidebar = SidebarService::sidebar();

        $data = file_get_contents(realpath(request()->logo));
        $data = base64_encode($data);

        $sidebar->logo = $data;
        $sidebar->save();

        return redirect('dashboard/sidebar');
    }


    public function delete_logo()
    {
        $sidebar = SidebarService::sidebar();

        $sidebar->logo = null;
        $sidebar->save();

        return redirect('dashboard/sidebar');
    }



    public function enable_option($option)
    {
        $sidebar = SidebarService::sidebar();
        $sidebar->$option = 1;
        $sidebar->save();

        return redirect('/dashboard/sidebar');
    }


    public function disable_option($option)
    {
        $sidebar = SidebarService::sidebar();
        $sidebar->$option = 0;
        $sidebar->save();

        return redirect('/dashboard/sidebar');
    }

}