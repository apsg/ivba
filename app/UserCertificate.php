<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserCertificate
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $certificate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Certificate $certificate
 * @property-read \App\Course $course
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereCertificateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereUserId($value)
 * @mixin \Eloquent
 */
class UserCertificate extends Model
{
    protected $guarded = [];

    /**
     * Użytkownik, dla którego wystawiono ten certyfikat
     * @return [type] [description]
     */
    public function user(){
    	return $this->belongsTo(\App\User::class);
    }

    /**
     * Odniesienie do certyfikatu
     * @return [type] [description]
     */
    public function certificate(){
    	return $this->belongsTo(\App\Certificate::class);
    }

    /**
     * Kurs, do którego był przypisany ten certyfikat.
     * @return [type] [description]
     */
    public function course(){
    	return $this->belongsTo(\App\Course::class);
    }

    /**
     * Link pobierania tego certyfikatu
     * @return [type] [description]
     */
    public function getDownloadUrl(){
        return url('/certificate/'.$this->id.'/download');
    }

}
