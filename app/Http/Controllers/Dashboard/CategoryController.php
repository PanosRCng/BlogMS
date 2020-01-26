<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/27/19
 * Time: 10:31 PM
 */

namespace App\Http\Controllers\Dashboard;



use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;





class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }





    public function category($id)
    {
        $data = [
            'category' => Category::find($id)
        ];

        return view('dashboard/category', $data);
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:categories',
        ]);

        if( $validator->fails() )
        {
            return redirect('dashboard/categories')
                ->withErrors($validator)
                ->withInput();
        }

        $category = new Category(['name' => $request->get('name'), 'display_order' => CategoryService::next_display_order()]);
        $category->save();

        return redirect('dashboard/categories');
    }



    public function delete($id)
    {
        CategoryService::delete_category($id);

        return redirect('dashboard/categories');
    }



    public function update_name(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:1024',
        ]);

        if( $validator->fails() )
        {
            return redirect('dashboard/category/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->save();

        return redirect('dashboard/category/' . $id);
    }


    public function enable($id)
    {
        $category = Category::find($id);
        $category->enabled = 1;
        $category->save();

        return redirect('dashboard/categories');
    }


    public function disable($id)
    {
        $category = Category::find($id);
        $category->enabled = 0;
        $category->save();

        return redirect('dashboard/categories');
    }

    
    public function attach_article(Request $request, $category_id)
    {
        CategoryService::attach_article($category_id, $request->get('article_id'));

        return redirect('dashboard/category/' . $category_id);
    }


    public function detach_article($category_id, $article_id)
    {
        $category = Category::find($category_id);

        $category->articles()->detach($article_id);

        return redirect('dashboard/category/' . $category_id);
    }


    public function move_up_article($category_id, $article_id)
    {
        CategoryService::change_article_order($category_id, $article_id, 'up');

        return redirect('dashboard/category/' . $category_id);
    }


    public function move_down_article($category_id, $article_id)
    {
        CategoryService::change_article_order($category_id, $article_id, 'down');

        return redirect('dashboard/category/' . $category_id);
    }


}