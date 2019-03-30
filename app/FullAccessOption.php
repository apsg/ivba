<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FullAccessOption
 *
 * @property int $id
 * @property int $duration
 * @property float $price
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
