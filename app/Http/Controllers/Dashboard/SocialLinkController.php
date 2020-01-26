<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/27/19
 * Time: 10:31 PM
 */

namespace App\Http\Controllers\Dashboard;



use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Services\SocialLinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;





class SocialLinkController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }




    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|max:100',
            'url' => 'required|max:2048',
        ]);

        if( $validator->fails() )
        {
            return redirect('dashboard/social_links')
                ->withErrors($validator)
                ->withInput();
        }

        SocialLinkService::create($request->get('type'), $request->get('url'));

        return redirect('dashboard/social_links');
    }



    public function delete($id)
    {
        $socialLink = SocialLink::find($id);

        $socialLink->delete();

        return redirect('dashboard/social_links');
    }


    public function enable($id)
    {
        $socialLink = SocialLink::find($id);
        $socialLink->enabled = 1;
        $socialLink->save();

        return redirect('dashboard/social_links');
    }


    public function disable($id)
    {
        $socialLink = SocialLink::find($id);
        $socialLink->enabled = 0;
        $socialLink->save();

        return redirect('dashboard/social_links');
    }


    public function move_up($id)
    {
        SocialLinkService::change_link_order($id, 'up');

        return redirect('dashboard/social_links');
    }


    public function move_down($id)
    {
        SocialLinkService::change_link_order($id, 'down');

        return redirect('dashboard/social_links');
    }


}