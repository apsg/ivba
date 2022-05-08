<?php
namespace App\Domains\Forms\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Blade;

/**
 * @property int            id
 * @property int            form_id
 * @property int            user_id
 * @property array          answers
 * @property int|null       commenter_id
 * @property Carbon|null    commented_at
 * @property string|null    comment
 * @property Carbon         created_at
 * @property Carbon         updated_at
 *
 * @property-read Form      form
 * @property-read User      user
 * @property-read User|null commenter
 */
class FormAnswer extends Model
{
    protected $fillable = [
        'form_id',
        'user_id',
        'answers',
        'commenter_id',
        'commented_at',
        'comment',
    ];

    protected $casts = [
        'answers'      => 'array',
        'commented_at' => 'datetime',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commenter() : BelongsTo
    {
        return $this->belongsTo(User::class, 'commenter_id');
    }

    public function form() : BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function formatAnswersAsTable()
    {
        return view('common.forms.answers.table', ['answer' => $this]);
    }
}
