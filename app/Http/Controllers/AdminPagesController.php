<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests\AdminPageRequest;

class AdminPagesController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    	$this->middleware('admin');
    }

    /**
     * Pokaż spis stron
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request){
    	$pages = \App\Page::all();
    	return view('admin.pages')->with(compact('pages'));
    }


    /**
     * Pokaż edycję strony
     * @param  Page   $page [description]
     * @return [type]       [description]
     */
    public function show(Page $page){
    	return view('admin.pages.page')->with(compact('page'));
    }

    /**
     * zaktualizuj stronę
     * @param  AdminPageRequest $request [description]
     * @return [type]                    [description]
     */
    public function update(Page $page, AdminPageRequest $request){
    	$page->update($request->only(['title', 'content', 'slug']));
    	return back();
    }

    /**
     * Pokaż formularz dodawania nowej strony
     * @return [type] [description]
     */
    public function create(){
    	return view('admin.pages.new');
    }

    /**
     * Utwórz nową stronę
     * @param  AdminPageRequest $request [description]
     * @return [type]                    [description]
     */
    public function store(AdminPageRequest $request){
    	$page = Page::create($request->only(['title', 'content', 'slug']));
    	return redirect('/admin/pages/'.$page->slug);
    }

}
