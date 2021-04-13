<?php

namespace App\Models;

use DB;
class Taggable extends AdminModel
{

        protected $table               = 'taggables';
        protected $folderUpload        = 'taggable' ;
        protected $fieldSearchAccepted = ['id', 'name', 'email', 'fullname'];
        protected $crudNotAccepted     = ['_token','thumb_current', 'password_confirmation', 'taskAdd', 'taskChangePassword', 'taskChangeLevel', 'taskEditInfo'];
        protected $guarded=[];

        public function taggable()
        {
            return $this->morphTo();
        }



}

