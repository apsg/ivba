<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    
    /**
     * Typy pytań, jakie możemy mieć w systemie
     */
    // Jednokrotny wybór
    const SINGLE = 1;
    // Wielokrotny wybór
    const MULTIPLE = 2;
    // Otwarte
    const OPEN = 3;

    /**
     * Do którego testu należy to pytanie
     * @return [type] [description]
     */
    public function quiz(){
    	return $this->belongsTo(\App\Quiz::class);
    }

    /**
     * Odpowiedzi do tego pytania
     * @return [type] [description]
     */
    public function options(){
    	return $this->hasMany(\App\QuestionOption::class);
    }

    /**
     * Zwraca nazwę dla poszczególnych typów
     * @return [type] [description]
     */
    public function getTypeNameAttribute(){
        switch ($this->type) {
            case static::SINGLE:
                return "Jednokrotny wybór";
                break;
            case static::MULTIPLE:
                return "Wielokrotny wybór";
                break;
            case static::OPEN:
                return "Pytanie otwarte";
                break;
        }
    }

    /**
     * Sprawdza, czy pytanie jest poprawne
     * @return boolean [description]
     */
    public function isValid(){

        if(empty($this->content))
            return false;

        switch ($this->type) {
            case static::SINGLE:
            case static::MULTIPLE:
                return $this->options()->where('is_correct', true)->count() > 0;
                break;
            case static::OPEN:
                return !empty($this->answer);
                break;
            default:
                return false;
        }
    }

    /**
     * Sprawdza, czy podana odpowiedź jest prawidłowa
     * @param  [type] $answer [description]
     * @return [type]         [description]
     */
    public function check( $answer ){

        switch ($this->type) {
            case static::SINGLE:{
                $correct = $this->options()
                    ->where('is_correct')
                    ->get()->pluck('id')
                    ->toArray();
                return in_array($answer, $correct);
                break;
            }
            case static::MULTIPLE: {
                $correct = $this->options()
                    ->where('is_correct')
                    ->get()->pluck('id')
                    ->toArray();
                return empty( array_diff($correct, $answer) );
                break;
            }
            case static::OPEN:
                return strtolower($answer) == strtolower($this->answer);
                break;
        }

        return false;

    }

}
