<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    protected $fillable = [ 'name', 'city', 'body', 'is_registered', 'url', 'user_id' ];

    /**
     * Tworzy nowy proof typu "ktoś się zarejestrował"
     */
    public static function createRegistered(\App\User $user){
    	return static::create([
    		'name'	=> static::getName($user),
    		'city'	=> \App\Helpers\CityFromIp::get( request()->ip() ),
    		'url'	=> url('/register'),
    		'body'	=> "Zarejestrował/a się.",
    		'user_id' => $user->id,
    		'is_registered' => false,
    	]);
    }

    /**
     * Tworzy nowy proof typu "ukończono lekcję"
     */
    public static function createFinishedLesson(\App\User $user, \App\Lesson $lesson){
    	return static::create([
    		'name'	=> static::getName($user),
    		'city'	=> \App\Helpers\CityFromIp::get( request()->ip() ),
    		'url'	=> $lesson->link(),
    		'body'	=> "Ukończył/a lekcję: ".$lesson->title,
    		'user_id' => $user->id,
    		'is_registered' => true,
    	]);
    }

    /**
     * Tworzy nowy proof typu "ukończono lekcję"
     */
    public static function createFinishedCourse(\App\User $user, \App\Course $course){
    	return static::create([
    		'name'	=> static::getName($user),
    		'city'	=> \App\Helpers\CityFromIp::get( request()->ip() ),
    		'url'	=> $course->link(),
    		'body'	=> "Ukończył/a kurs: ".$course->title,
    		'user_id' => $user->id,
    		'is_registered' => true,
    	]);
    }

    /**
     * Tworzy nowy proof typu "ukończono lekcję"
     */
    public static function createFinishedQuiz(\App\User $user, \App\Quiz $quiz){
    	return static::create([
    		'name'	=> static::getName($user),
    		'city'	=> \App\Helpers\CityFromIp::get( request()->ip() ),
    		'url'	=> $quiz->course->link(),
    		'body'	=> "Ukończył/a test: ".$quiz->name,
    		'user_id' => $user->id,
    		'is_registered' => true,
    	]);
    }

    /**
     * Zwraca samo imię (pierwszy człon nazwy użytkownika)
     */
    protected static function getName($user){
    	return explode(' ', $user->name)[0];
    }

    /**
     * Następny proof dla zarejestrowanego użytkownika
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public static function getNextForUser( $user ){

        // if( $user->last_proof_at && $user->last_proof_at->diffInMinutes() < 10 ){
        //     return null;
        // }

        $proof = static::where('user_id', '!=', $user->id)
            ->where('id', '>', $user->last_proof_id ?? 0)
            ->where('is_registered', true)
            ->orderBy('id', 'asc')
            ->first();

        if($proof){
            $user->update([
                'last_proof_id' => $proof->id,
                'last_proof_at' => \Carbon\Carbon::now(),
            ]);
        }

        return $proof;
    }

    /**
     * Następny proof dla niezarejestrowanego
     * @param  [type] $last_proof_id [description]
     * @return [type]                [description]
     */
    public static function getNextUnregistered( $last_proof_id ){
        return $proof = static::where('is_registered', false)
            ->where('id', '>', $last_proof_id)
            ->orderBy('id', 'asc')
            ->first();
    }

}
