<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\UserCertificate.
 *
 * @property int              $id
 * @property int              $user_id
 * @property int              $course_id
 * @property int              $certificate_id
 * @property Carbon|null      $created_at
 * @property Carbon|null      $updated_at
 * @property-read Certificate $certificate
 * @property-read Course      $course
 * @property-read User        $user
 * @mixin \Eloquent
 */
class UserCertificate extends Model
{
    protected $guarded = [];

    /**
     * Użytkownik, dla którego wystawiono ten certyfikat.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Odniesienie do certyfikatu.
     */
    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }

    /**
     * Kurs, do którego był przypisany ten certyfikat.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Link pobierania tego certyfikatu.
     */
    public function getDownloadUrl()
    {
        return url('/certificate/' . $this->id . '/download');
    }
}
