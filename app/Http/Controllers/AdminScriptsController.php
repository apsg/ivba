<?php

namespace App\Http\Controllers;

use App\Script;
use Illuminate\Http\Request;

class AdminScriptsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Pokaż widok skryptów.
     * @return [type] [description]
     */
    public function index()
    {
        $scripts = \App\Script::all();

        return view('admin.scripts.index')->with(compact('scripts'));
    }

    /**
     * Zapisz nowy skrypt w bazie.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' 	=> 'required',
            'script' 	=> 'required',
        ]);

        Script::create($request->all());

        flash('Dodano!');

        return back();
    }

    /**
     * Pokaż ekran edycji skryptu.
     * @param  Script $script [description]
     * @return [type]         [description]
     */
    public function edit(Script $script)
    {
        return view('admin.scripts.edit')->with(compact('script'));
    }

    /**
     * Usuń skrypt.
     * @param  Script $script [description]
     * @return [type]         [description]
     */
    public function delete(Script $script)
    {
        $script->delete();
        flash('Usunięto!');

        return redirect('admin/scripts');
    }

    /**
     * Zapisz zmiany w skrypcie.
     * @param  Script  $script  [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function patch(Script $script, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'script' => 'required',
        ]);

        $script->update($request->all());

        flash('zapisane');

        return back();
    }
}
