<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Item
 *
 * @property int $lesson_id
 * @property int $items_id
 * @property string $items_type
 * @property int $position
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Lesson[] $lesson
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereItemsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereItemsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item wherePosition($value)
 * @mixin \Eloquent
 */
class Item extends Model{

	protected $guarded = [];

	public $view = 'admin.partials.item';	

	public static function boot(){
		parent::boot();

		/**
		 * Podczas usuwania zasobu "odłącz" go wpierw od 
		 * wszystkich lekcji.
		 */
		static::deleting(function($model){
			$model->lesson()->detach();
		});
	}

	/**
	 * Lekcja, do której należy ten obiekt
	 * @return [type] [description]
	 */
	public function lesson(){
		return $this->morphToMany(\App\Lesson::class, 'items');
	}

	/**
	 * Slug
	 * @return [type] [description]
	 */
	public function slug(){
		return str_slug((new \ReflectionClass($this))->getShortName());
	}

	/**
	 * link usuwania
	 * @return [type] [description]
	 */
	public function deleteLink(){
		return url('/admin/'.$this->slug(). '/' . $this->id . '/delete');
	}
	
}