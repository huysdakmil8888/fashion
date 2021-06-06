<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use DB;

class ArticleModel extends AdminModel implements TranslatableContract
{
    use Translatable;
    protected $table='article';
    protected $translationForeignKey = 'article_model_id';

    protected $folderUpload='article';
    protected $fieldSearchAccepted=['name','content'];
    protected $crudNotAccepted=['_token','thumb_current','tag'];
    protected $guarded=[];
    public $translatedAttributes = ['name', 'content','slug','description'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function category_article()
    {
        return $this->belongsTo(CategoryArticleModel::class,'category_article_id');
    }
    public function user()
    {
        return $this->belongsTo(UserModel::class,'user_id');
    }
    public function comments()
    {
        return $this->hasMany(CommentArticleModel::class,'article_id','id');
    }

    public function increaseView($params)
    {
        $this->where('id',$params['id'])->update($params);

    }
    public function increaseLike($params)
    {
        $this->where('id',$params['id'])->update($params);

    }
    public function listItems($params = null, $options = null) {
     
        $result = null;

        if($options['task'] == "admin-list-items") {
            $query = $this::with('translation')
//                ->leftJoin('category as c', 'article.category_id', '=', 'c.id')
            ;


            if ($params['filter']['status'] !== "all")  {
                $query->where('status', '=', $params['filter']['status'] );
            }

            if ($params['filter']['category'] !== "all")  {
                $categories = CategoryModel::descendantsAndSelf($params['filter']['category'])->pluck('id')->toArray();
                $query->whereIN('a.category_id', $categories);
            }

            if ($params['search']['value'] !== "")  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere( $column, 'LIKE',  "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) { 
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%" );
                } 
            }


            $result =  $query->orderBy('article.id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);


        }

        if($options['task'] == 'news-list-items') {
            $query = $this->with('user')
                        ->where('status', '=', 'active' )
                        ->limit(2);

            $result = $query->get();
        }

        if($options['task'] == 'news-list-items-featured') {
	
            $query = $this->select('a.id', 'a.name', 'a.content', 'a.category_id', 'c.name as category_name', 'a.thumb')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->where('a.type', 'featured')
                ->orderBy('a.id', 'desc')
                ->take(3);

            $result = $query->get()->toArray();
        }

        
        if($options['task'] == 'news-list-items-latest') {
            
            $query = $this->select('a.id', 'a.name', 'a.created', 'a.category_id', 'c.name as category_name', 'a.thumb')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->orderBy('id', 'desc') 
                ->take(4);
            ;
            $result = $query->get()->toArray();
        }

        if($options['task'] == 'news-list-items-in-category') {
            $query = $this->select('id', 'name', 'content', 'thumb', 'created')
                ->where('status', '=', 'active')
                ->where('category_id', '=', $params['category_id'])
                ->take(4)
            ;
            $result = $query->get()->toArray();
        }
        
        if($options['task'] == 'news-list-items-related-in-category') {
            $query = $this->select('id', 'name', 'content', 'thumb', 'created')
                ->where('status', '=', 'active')
                ->where('a.id', '!=', $params['article_id'])
                ->where('category_id', '=', $params['category_id'])
                ->take(4)
            ;
            $result = $query->get()->toArray();
        }
        
        

        return $result;
    }

    public function countItems($params = null, $options  = null) {
     
        $result = null;

        if($options['task'] == 'admin-count-items-group-by-status') {
         
            $query = $this::groupBy('status')
                        ->select( DB::raw('status , COUNT(id) as count') );

            if ($params['search']['value'] !== "")  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) { 
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%" );
                } 
            }

            $result = $query->get()->toArray();
           

        }

        return $result;
    }

    public function getItem($params = null, $options = null) { 
        $result = null;

        //form article
        if($options['task'] == 'get-item') {
            $result = self::with('user','tags')
                ->where('id', $params['id'])
                ->first();

        }

        if($options['task']=='news-get-item'){
            $result=self::with(['user','category_article'])
                ->where('category_article_id',$params['category_article_id'])
                ->orderby('id','desc')
                ->paginate(4);

        }
        if($options['task']=='news-get-item-by-author'){
            $result=self::with(['user','category_article'])
                ->where('user_id',$params['author_id'])
                ->select('id','like','view','user_id','category_article_id','name','slug','content','created_by','created','thumb')
                ->paginate(4);
        }
        if($options['task']=='news-get-item-by-tag'){
            $result=Tag::find($params['tag'])->articles()
                ->paginate(4);
        }
        //get article same category
        if($options['task']=='news-get-item-recent'){
            $result=self::where("id","<>",$params['id'])
                ->where("category_article_id",$params['category_article_id'])
                ->take(3)->orderBy('id','desc')
                ->get();
        }
        //get archives
        if($options['task']=='news-get-item-archive'){
           $result= self::all()->groupBy(function($date) {
                return Carbon::parse($date->created)->format('M Y');
            });
           if(isset($params['archive'])){
                return $result[$params['archive']];
           }else{
               return $result->take(5);

           }
        }


        return $result;
    }

    public function saveItem($params = null, $options = null) { 


        if($options['task'] == 'change-type') {
            self::where('id', $params['id'])->update(['type' => $params['currentType']]);
            return [
                'id' => $params['id'],
                'message' => config('zvn.notify.success.update')
            ];
        }

        if($options['task'] == 'add-item') {

            $params['created_by'] = "hailan";
            $params['created']    = date('Y-m-d');
//            $params['vi']=['locale'=>'vi'];
//            $params['en']=['locale'=>'en'];

            $article=self::create($this->prepareParams($params));

            //luu tag
            $this->saveTag($params,$article);
        }

        if($options['task'] == 'edit-item') {

            $params['modified_by']   = "hailan";
            $params['modified']      = date('Y-m-d');
            $article=self::where('id',$params['id'])->get()->first();
//            $article->translate('en')->locale='en';
//            $article->translateOrNew($locale)->name = "Title {$locale}";

            foreach ($params as $key=>$value) {
                if(in_array($key,['vi','en'])){
                    //save translation
                    foreach ($value as $key2=>$value2) {
                        $article->translateOrNew($key)->$key2=$value2;
                    }
                }else{
                        $article->$key=$value;
                }
            }
            $article->save();
//            $article->update($this->prepareParams($params));
            //luu tag
//            $this->saveTag($params,$article);


        }

        if ($options['task'] == 'change-category') {
            $params['modified_by']  = session('userInfo')['username'];
            $params['modified']     = date('Y-m-d H:i:s');
            $this->where('id', $params['id'])->update($this->prepareParams($params));

            $result = [
                'id' => $params['id'],
                'modified' => Template::showItemHistory($params['modified_by'], $params['modified']),
                'message' => config('zvn.notify.success.update')
            ];

            return $result;
        }
    }

    public function deleteItem($params = null, $options = null) 
    { 
        if($options['task'] == 'delete-item') {
            $item   = self::getItem($params, ['task'=>'get-thumb']);
//            $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }

}

