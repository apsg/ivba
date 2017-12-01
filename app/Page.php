<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    /**
     * Po czym przeszukujemy ścieżki
     * @return [type] [description]
     */
    public function getRouteKeyName(){
        return 'slug';
    }
}
