<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class URL
{
    
    public static function linkCategory($category)
    {
        return route('category/index', [
            'category_slug' => $category->slug,
            'category_id' => $category->id,
        ]);
    }



    public static function linkArticle($article)
    {
        return route('article/detail', [
            'article_slug' => 'abc',
            'article_id'   => $article->id
        ]);

    }
    public static function linkAuthor($author)
    {
        return route('article/author', [
            'author_slug' => $author['username'],
            'author_id'   => $author['id']
        ]);

    }
    public static function linkPage($page)
    {
        return route('page/detail', [

            'page_slug' => $page->slug,
            'id'   => $page->id
        ]);

    }
    public static function linkLike($item)
    {
        return route('article/increaseLike', [

            'id'   => $item->id
        ]);

    }
    public static function linkArchive($item)
    {
        return route('article/archive', [

            'id'   => $item
        ]);

    }
    public static function linkCategoryArticle($category_article)
    {

        $arr=[
            'category_article_slug' => $category_article->slug,
            'id'=>$category_article->id
        ];
        return route('article/index',$arr,true,null );

    }


    public static function linkProduct($product)
    {
        return route('product/index', [
            'product_slug' => $product->slug,
            'product_id'   =>$product->id
        ]);

    }
    

}