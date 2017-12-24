<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FullAccessOption extends Model
{
    protected $guarded = [];


    /**
     * Link do zakupu tej opcji
     * @return [type] [description]
     */
    public function buyLink(){
    	return url('/cart/add_full_access/'.$this->id);
    }

}
