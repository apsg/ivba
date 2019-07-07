<?php
namespace App;

use App\Interfaces\OrderableContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int         id
 * @property string      hash
 * @property string      name
 * @property string|null description
 * @property string      rules_url
 * @property float       price
 * @property float|null  full_price
 * @property int         course_id
 * @property-read Course course
 *
 * @property string      message_email
 * @property string      message_subject
 * @property string      message_body
 *
 * @property Carbon      created_at
 * @property Carbon      updated_at
 *
 * @property-read string link
 *
 */
class QuickSale extends Model implements OrderableContract
{
    protected $fillable = [
        'name',
        'hash',
        'description',
        'rules_url',
        'price',
        'full_price',
        'course_id',
        'message_email',
        'message_subject',
        'message_body',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function cartName() : string
    {
        return $this->name;
    }

    public function removeLink(Order $order) : string
    {
        // TODO: Implement removeLink() method.
    }

    public function getLinkAttribute()
    {
        return url('/qs/' . $this->hash);
    }
}
