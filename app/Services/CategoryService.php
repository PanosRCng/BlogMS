<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 11/27/19
 * Time: 10:47 PM
 */

namespace App\Services;


use App\Models\Article;
use App\Models\Category;




class CategoryService
{

    public static function next_display_order()
    {
        $categories = Category::all()->sortBy("display_order");

        if(count($categories) == 0)
        {
            return 0;
        }

        return ($categories->last()->display_order) + 1;
    }


    public static function featured_articles_category()
    {
        $featured_articles_category = Category::where('name', '=', 'featured articles')->first();

        if($featured_articles_category == null)
        {
            $featured_articles_category = new Category(['name' => 'featured articles', 'enabled' => 0, 'display_order' => CategoryService::next_display_order()]);
            $featured_articles_category->save();
        }

        return $featured_articles_category;
    }


    public static function delete_category($category_id)
    {
        $category = Category::find($category_id);

        $category->articles()->detach();

        $category->delete();
    }


    public static function attach_article($category_id, $article_id)
    {
        $category = Category::find($category_id);

        $display_order = 0;

        if( count($category->articles) > 0 )
        {
            $display_order = $category->articles->last()->pivot->display_order + 1;
        }

        $category->articles()->attach($article_id, ['display_order' => $display_order]);
    }


    public static function unattached_articles($category_id)
    {
        $unattached = [];

        $category = Category::find($category_id);

        $category_articles_ids = [];
        foreach($category->articles as $article)
        {
            $category_articles_ids[$article->id] = 1;
        }

        foreach(Article::all() as $article)
        {
            if( array_key_exists($article->id, $category_articles_ids) )
            {
                continue;
            }

            $unattached[] = $article;
        }

        return $unattached;
    }


    public static function change_article_order($category_id, $article_id, $direction='up')
    {
        $category = Category::find($category_id);
        $article = $category->articles()->where('article_id', '=', $article_id)->first();

        $current_order = $article->pivot->display_order;

        if($direction == 'up')
        {
            $displaced_article = $category->articles()->where('display_order', '<', $current_order)->get()->last();
        }
        else if($direction == 'down')
        {
            $displaced_article = $category->articles()->where('display_order', '>', $current_order)->get()->first();
        }

        if($displaced_article == null)
        {
            return;
        }

        $article->pivot->display_order = $displaced_article->pivot->display_order;
        $displaced_article->pivot->display_order = $current_order;

        $article->pivot->save();
        $displaced_article->pivot->save();
    }


}