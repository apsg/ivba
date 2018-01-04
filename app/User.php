<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 
        'password', 
        'full_access_expires', 
        'last_proof_at', 
        'last_proof_id',
        'days_bought',
        'expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'full_access_expires' => 'datetime',
        'unsubscribed_at'   => 'datetime',
        'last_proof_at'     => 'datetime',
        'expires_at'        => 'datetime',
    ];

    protected $events = [
        'created' => \App\Events\UserRegistered::class,
    ];

    /**
     * Kursy rozpoczęte przez tego użytkownika
     * @return [type] [description]
     */
    public function courses(){
        return $this->belongsToMany(\App\Course::class)
            ->withPivot('finished_at')
            ->withTimestamps();
    }

    /**
     * Lekcje rozpoczęte przez tego użytkownika
     * @return [type] [description]
     */
    public function lessons(){
        return $this->belongsToMany(\App\Lesson::class)
            ->withPivot('finished_at')
            ->withTimestamps();
    }

    /**
     * Testy tego użytkownika
     * @return [type] [description]
     */
    public function quizzes(){
        return $this->belongsToMany(\App\Quiz::class)
            ->withPivot('finished_date', 'points', 'is_pass')
            ->withTimestamps();
    }

    /**
     * Odpowiedzi tego użytkownika
     * @return [type] [description]
     */
    public function answers(){
        return $this->hasMany(\App\Answer::class);
    }

    /**
     * Zamówienia tego użytkownika
     * @return [type] [description]
     */
    public function orders(){
        return $this->hasMany(\App\Order::class);
    }

    /**
     * Emaile wysyłane do tego użytkownika
     * @return [type] [description]
     */
    public function emails(){
        return $this->morphMany(\App\Email::class, 'to');
    }

    /**
     * Ostatni wysłany proof
     * @return [type] [description]
     */
    public function last_proof(){
        return $this->belongsTo(\App\Proof::class, 'last_proof_id');
    }

    /**
     * Zwraca użytkowników, którzy nie wypisali się z maili typu Followup
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeFollowups($query){
        return $query->whereNull('unsubscribed_at');
    }

    /**
     * Opłacone zamówienia tego użytkownika
     * @return [type] [description]
     */
    public function confirmedOrders(){
        return $this->orders()
            ->whereNotNull('confirmed_at')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Zwraca aktywne zamówienie lub tworzy nowe
     * @return App\Order [description]
     */
    public function getCurrentOrder(){
        if( $order =  $this->orders()
            ->whereNull('confirmed_at')
            ->whereNull('payu_order_id')
            ->first() ){
            return $order;
        }else{
            $order = new \App\Order;
            $order->user()->associate($this);
            $order->save();
            return $order->fresh();
        }
    }

    /**
     * Zwraca URL do gravatara danego użytkownika
     * @return [type] [description]
     */
    public function gravatarUrl(){
        return "https://www.gravatar.com/avatar/".md5($this->email);
    }

    /**
     * Czy dany użytkownik ma aktywny pełen dostęp?
     * @return boolean [description]
     */
    public function hasFullAccess(){
        return $this->full_access_expires && $this->full_access_expires->isFuture();
    }

    /**
     * Czy dany użytkownik rozpoczął tę lekcję?
     * @param  [type]  $lesson_id [description]
     * @return boolean            [description]
     */
    public function hasStartedLesson($lesson_id){
        return $this->lessons()->where('lesson_id', $lesson_id)->exists();
    }

    /**
     * Czy dany użytkownik rozpoczął ten kurs?
     * @param  [type]  $course_id [description]
     * @return boolean            [description]
     */
    public function hasStartedCourse($course_id){
        return $this->courses()->where('course_id', $course_id)->exists();
    }

    /**
     * Czy użytkownik już rozpoczął ten kurs?
     * @param  [type]  $quiz_id [description]
     * @return boolean          [description]
     */
    public function hasStartedQuiz($quiz_id){
        return $this->quizzes()->where('quiz_id', $quiz_id)->exists();
    }

    /**
     * Czy dany użytkownik zakończył tę lekcję?
     * @param  [type]  $lesson_id [description]
     * @return boolean            [description]
     */
    public function hasFinishedLesson($lesson_id){
        return $this->lessons()
            ->where('lesson_id', $lesson_id)
            ->whereNotNull('finished_at')
            ->exists();
    }

    /**
     * Czy dany użytkownik ukończył ten kurs?
     * @param  [type]  $course_id [description]
     * @return boolean            [description]
     */
    public function hasFinishedCourse($course_id){
        return $this->courses()
            ->where('course_id', $course_id)
            ->whereNotNull('finished_at')
            ->exists();
    }

    /**
     * Czy użytkownik ukończył wszystkie lekcje z danego kursu.
     * @param  [type]  $course_id [description]
     * @return boolean            [description]
     */
    public function hasFinishedAllLessons($course_id){
        $lesson_ids = \App\Course::findOrFail($course_id)->lessons->pluck('id');

        foreach ($lesson_ids as $lesson_id) {
            if( ! $this->hasFinishedLesson($lesson_id) )
                return false;
        }

        return true;
    }

    /**
     * Czy dany użytkownik ukończył ten test?
     * @param  [type]  $quiz_id [description]
     * @return boolean          [description]
     */
    public function hasFinishedQuiz( $quiz_id ){
        return $this->quizzes()
            ->where('quiz_id', $quiz_id)
            ->whereNotNull('finished_date')
            ->exists();
    }

    /**
     * Czy użytkownik ukończył wszystkie testy w danym kursie
     * @param  [type]  $course_id [description]
     * @return boolean            [description]
     */
    public function hasFinishedAllQuizzes( $course_id ){
        $quiz_ids = \App\Quiz::where('course_id', $course_id)->get()->pluck('id');

        foreach ($quiz_ids as  $quiz_id) {
            if( ! $this->hasFinishedQuiz($quiz_id) ){
                return false;
            }
        }

        return true;
    }

    /**
     * Czy użytkownik zdał ten test?
     * @param  [type]  $quiz_id [description]
     * @return boolean          [description]
     */
    public function hasPassedQuiz( $quiz_id ){
        return $this->quizzes()
            ->where('quiz_id', $quiz_id)
            ->whereNotNull('finished_date')
            ->where('is_pass', true)
            ->exists();
    }

    /**
     * Czy użytkownik zdał wszystkie testy przypisane do tego kursu?
     * @param  [type]  $course_id [description]
     * @return boolean            [description]
     */
    public function hasPassedAllQuizzes( $course_id ){
        $quiz_ids = \App\Quiz::where('course_id', $course_id)->get()->pluck('id');

        foreach ($quiz_ids as  $quiz_id) {
            if( ! $this->hasPassedQuiz($quiz_id) ){
                return false;
            }
        }

        return true;
    }

    /**
     * Czy użytkownik ukończył pozytywnie ten kurs?
     * @param  [type]  $course_id [description]
     * @return boolean            [description]
     */
    public function hasPassedCourse( $course_id ){
        return $this->hasFinishedAllLessons( $course_id )
            && $this->hasPassedAllQuizzes( $course_id );
    }

    /**
     * Aktualizuje pełen dostęp o określoną liczbę dni dostępu
     * @param  [type] $days [description]
     * @return [type]       [description]
     */
    public function updateFullAccess($days){
        if(empty($this->full_access_expires) || $this->full_access_expires->isPast() ){
            $this->full_access_expires = \Carbon\Carbon::now()->addDays($days);
            $this->save();
        }else{
            $this->full_access_expires = $this->full_access_expires->addDays($days);
            $this->save();
        }
        return $this;
    }

    /**
     * Czy można dodać kolejny pełen dostęp do tego konta?
     * @return [type] [description]
     */
    public function canAddFullAccess(){
        
        if(is_null($this->full_access_expires) || $this->full_access_expires->isPast())
            return true;

        if($this->full_access_expires->isFuture() && $this->full_access_expires->diffInDays() < 365)
            return true;

        return false;

    }

    /**
     * Usuń użytkownika
     * @return [type] [description]
     */
    public function deleteLink(){
        return url('/admin/user/'.$this->id.'/delete');
    }

    /**
     * Link do wysyłania wygenerowanego nowego hasła
     * @return [type] [description]
     */
    public function sendPasswordLink(){ 
        return url('/admin/user/'.$this->id.'/send_password');
    }

    /**
     * Pokaż podgląd/edycję użytkownika
     * @return [type] [description]
     */
    public function editLink(){
        return url('/admin/user/'.$this->id);
    }

    /**
     * Wypisuje użytkownika z otrzymywania powiadomień automatycznych.
     * @return [type] [description]
     */
    public function unsubscribe(){
        $this->unsubscribed_at = \Carbon\Carbon::now();
        $this->emails->each->delete();
        flash('Nie będziesz już otrzymywać powiadomień automatycznych');
    }

    /**
     * Nadpisana wiadomość z resetem hasła.
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\PasswordReset($token));
    }
}
