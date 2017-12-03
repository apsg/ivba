<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];

    /**
     * Kurs, do którego ten test jest przypisany
     * @return [type] [description]
     */
    public function course(){
    	return $this->belongsTo(\App\Course::class);
    }

    /**
     * Pytania przypisane do tego testu
     * @return [type] [description]
     */
    public function questions(){
    	return $this->hasMany(\App\Question::class)
            ->orderBy('position');
    }

    /**
     * Użytkownicy, którzy wzięli udział w tym teście
     * @return [type] [description]
     */
    public function users(){
        return $this->belongsToMany(\App\User::class)
            ->withPivot('finished_date', 'points', 'is_pass');
    }

    /**
     * Zwraca link do tego quizu
     * @param  \App\Course $course [description]
     * @return [type]              [description]
     */
    public function url(){
        return url('/learn/course/'.$this->course->slug.'/quiz/'.$this->id);
    }
    // Alias
    public function learnUrl(){
        return $this->url();
    }

    /**
     * Link rozpoczynania quizu
     * @return [type] [description]
     */
    public function startUrl(){
        return url('/learn/course/'.$this->course->slug.'/quiz/'.$this->id.'/start');
    }

    /**
     * Zwraca następne pytanie dla tego użytkownika (lub null, jeśli 
     * odpowiedział już na wszystkie pytania).
     * @return [type] [description]
     */
    public function nextQuestion( \App\User $user ){

        $ids = $user->answers->pluck('question_id');

        if( $this->is_random ) 
            return $this->questions()
                ->whereNotIn('id', $ids)
                ->inRandomOrder()
                ->first();
        else
            return $this->questions()
                ->whereNotIn('id', $ids)
                ->orderBy('position', 'asc')
                ->first();
    }

    /**
     * Zakończ kurs
     * @return [type] [description]
     */
    public function finish(){
        $question_ids = $this->questions->pluck('id');


        $points = \App\Answer::where('user_id', \Auth::user()->id)
            ->whereIn('question_id', $question_ids)
            ->sum('points');

        $percentage = 100 * $points / $this->max_points;

        $this->users()->updateExistingPivot( \Auth::user()->id , [
            'points'    => $points,
            'finished_date' => \Carbon\Carbon::now() ,
            'is_pass'   => $percentage >= $this->pass_threshold,
        ] );

    }

    /**
     * zwraca maksymalną liczbę punktów za ten test
     * @return [type] [description]
     */
    public function getMaxPointsAttribute(){
        return $this->questions()->sum('points');
    }

    /**
     * [userScore description]
     * @param  \App\User $user [description]
     * @return [type]          [description]
     */
    public function userScore(\App\User $user){
        return $this->users()
            ->where('user_id', $user->id)
            ->first()->pivot->points;
    }

}
