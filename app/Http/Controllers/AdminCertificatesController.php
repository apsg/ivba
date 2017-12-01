<?php

namespace App\Http\Controllers;

use App\Certificate;
use Illuminate\Http\Request;

class AdminCertificatesController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }

    /**
     * Pokaż spis certyfikatów
     * @return [type] [description]
     */
    public function index(){
    	$certificates = Certificate::with('course')->get();

    	$ids = $certificates->pluck('course_id');

    	$courses = \App\Course::whereNotIn('id', $ids)->get();

    	return view('admin.certificates.index')->with(compact('certificates', 'courses'));
    }

    /**
     * Zapisz certyfikat w bazie
     * @param  Request $requeust [description]
     * @return [type]            [description]
     */
    public function store(Request $request){
    	$this->validate($request, [
    		'course_id'	=> 'required|exists:courses,id',
    		'title'		=> 'required',
    	]);

    	Certificate::create( $request->all() );

    	flash('Utworzono');
    	return back();
    }

    /**
     * Usuń certyfikat
     * @param  Certificate $certificate [description]
     * @return [type]                   [description]
     */
    public function delete(Certificate $certificate){
    	$certificate->delete();

    	flash('Usunięto poprawnie');
    	return back();
    }
}
