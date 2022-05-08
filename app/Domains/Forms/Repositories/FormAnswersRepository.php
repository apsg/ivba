<?php
namespace App\Domains\Forms\Repositories;

use App\Domains\Forms\Models\Form;
use App\Domains\Forms\Models\FormAnswer;
use App\User;
use Illuminate\Support\Collection;

class FormAnswersRepository
{
    public function forFormAndUser(Form $form, User $user) : Collection
    {
        return FormAnswer::where('user_id', $user->id)
            ->where('form_id', $form->id)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function store(Form $form, User $author, array $answers) : FormAnswer
    {
        return $form->answers()
            ->create([
                'user_id' => $author->id,
                'answers' => $answers,
            ]);
    }
}
