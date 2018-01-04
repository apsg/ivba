<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminEditablesController extends Controller
{
    public function __construct(){

    	$this->middleware('auth');
    	$this->middleware('admin');
    }

    /**
     * Aktualizuje pole editable
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Request $request){

    	$this->validate($request, [
    		'model'	=> 'required',
    		'id'	=> 'required|integer',
    		'field' => 'required',
    		'value' => 'present',
    	]);


    	$model = '\App\\'.$request->model;

    	$item = $model::findOrFail($request->id);

    	$item->update([
    		$request->field => $request->value
    	]);

    	if($request->model == 'Course' && $request->field == 'delay'){
    		\App\Course::reorder();
    	}

    	return response()->json('ok');
    }
}
