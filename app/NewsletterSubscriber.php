<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\NewsletterSubscriber.
 *
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Email[] $emails
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\NewsletterSubscriber onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewsletterSubscriber withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\NewsletterSubscriber withoutTrashed()
 * @mixin \Eloquent
 */
class NewsletterSubscriber extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Maile wysyłane do tego subskrybenta.
     * @return [type] [description]
     */
    public function emails()
    {
        return $this->morphMany(\App\Email::class, 'to');
    }

    /**
     * [add description].
     * @param [type] $email [description]
     */
    public static function add($email, $name = null)
    {
        if ($subscriber = static::where('email', $email)->first()) {
            return $subscriber;
        }

        if ($subscriber = static::withTrashed()->where('email', $email)->first()) {
            $subscriber->restore();
            \App\Newsletter::due()->get()->each->planFor($subscriber);

            return $subscriber;
        } else {
            $subscriber = static::create([
                'email' => $email,
                'name'  => $name,
                ]);

            \App\Newsletter::due()->get()->each->planFor($subscriber);

            return $subscriber;
        }
    }

    /**
     * Dla spójności z user - usuwanie z list mailingowych.
     * @return [type] [description]
     */
    public function unsubscribe()
    {
        $this->delete();
        flash('Wypisano Cię z newslettera.');
    }
}
