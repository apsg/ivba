<?php
namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller
{
    public $redirects = [
        '/microsoft-excel-do-pobrania-za-darmo-po-polsku/' => 'http://blog.iexcel.pl/microsoft-excel-do-pobrania-za-darmo-po-polsku/',
        '/excel-usuwanie-znakow-z-tekstu/' => 'http://blog.iexcel.pl/excel-usuwanie-znakow-z-tekstu/',
        '/kursy/' => '/courses',
        '/wyszukiwanie-po-kilku-kryteriach/' => 'http://blog.iexcel.pl/wyszukiwanie-po-kilku-kryteriach/',
        '/kurs/darmowe/' => '/course/darmowe',
        '/jak-to-dziala/' => 'http://blog.iexcel.pl/jak-to-dziala/',
        '/sklep/' => '/buy_access',
        '/kurs/funkcje-2/' => '/course/funkcje',
        '/kurs/wizualizacja-danych/' => '/course/wizualizacja-danych',
        '/kurs/tabele-przestawne/' => '/course/tabele-przestawne',
        '/excel-jak-usunac-puste-wiersze/' => 'http://blog.iexcel.pl/excel-jak-usunac-puste-wiersze/',
        '/14777-2/' => 'http://blog.iexcel.pl/14777-2/',
        '/excel-i-funkcja-jezeli-kilka-warunkow/' => 'http://blog.iexcel.pl/excel-i-funkcja-jezeli-kilka-warunkow/',
        '/wyszukiwanie_tekstu/' => 'http://blog.iexcel.pl/wyszukiwanie_tekstu/',
        '/category/blog/' => 'http://blog.iexcel.pl',
        '/funkcje-zagniezdzone-jezeli/' => 'http://blog.iexcel.pl/funkcje-zagniezdzone-jezeli/',
        '/kurs/makra/' => '/course/makra',
        '/listy-rozwijane-2-poziomu/' => 'http://blog.iexcel.pl/listy-rozwijane-2-poziomu/',
        '/faktura-wzor-excel/' => 'http://blog.iexcel.pl/faktura-wzor-excel/',
        '/funkcja-polacz-teksty-czy-zlacz-teksty/' => 'http://blog.iexcel.pl/funkcja-polacz-teksty-czy-zlacz-teksty/',
        '/kontakt/' => 'http://blog.iexcel.pl/kontakt/',
        '/aktywacja-kuponu/' => 'http://blog.iexcel.pl/aktywacja-kuponu/',
        '/dynamiczny-wykres/' => 'http://blog.iexcel.pl/dynamiczny-wykres/',
        '/excel-funkcje-tekstowe/' => 'http://blog.iexcel.pl/excel-funkcje-tekstowe/',
        '/kategoria-kursu/darmowe/' => '/course/darmowe',
        '/kategoria-kursu/funkcje/' => '/course/funkcje',
        '/kategoria-kursu/makra/' => '/course/makra',
        '/kategoria-kursu/tabele-przestawne/' => '/course/tabele-przestawne',
        '/konkurs/' => 'http://blog.iexcel.pl/konkurs/',
        '/laczenie-wierszy-w-1-komorke/' => 'http://blog.iexcel.pl/laczenie-wierszy-w-1-komorke/',
        '/zaawansowany-z-excela-2/' => 'http://blog.iexcel.pl/zaawansowany-z-excela-2/',
        '/ekstremalne-porady-1-6-sposobow-na-wyszukaj-pionowo/' => 'http://blog.iexcel.pl/ekstremalne-porady-1-6-sposobow-na-wyszukaj-pionowo/',
        '/excel-korepetycje-przez-skype/' => 'http://blog.iexcel.pl/excel-korepetycje-przez-skype/',
        '/jak-szybko-usunac-puste-komorki-by-zorganizowac-dane/' => 'http://blog.iexcel.pl/jak-szybko-usunac-puste-komorki-by-zorganizowac-dane/',
        '/kredyt-hipoteczny-analiza-z-wykorzystaniem-excela/' => 'http://blog.iexcel.pl/kredyt-hipoteczny-analiza-z-wykorzystaniem-excela/',
    ];

    /**
     * Pokaż stronę statyczną.
     * @param Page $page [description]
     * @return [type]       [description]
     */
    public function show($pagename, $subpage = null)
    {
        $page = Page::where('slug', $pagename)->first();
        if ($page) {
            return view('pages.single')->with(compact('page'));
        } else {
            if (isset($this->redirects['/' . $pagename . '/'])) {
                return redirect($this->redirects['/' . $pagename . '/'], 301);
            }

            if (isset($this->redirects['/' . $pagename . '/' . $subpage . '/'])) {
                return redirect($this->redirects['/' . $pagename . '/' . $subpage . '/'], 301);
            }

            flash('Nie znaleziono strony, której szukasz (' . $pagename . '/' . $subpage . ').');

            return redirect('/')->with(['msg' => 'Nie znaleziono strony, której szukasz (' . $pagename . ')']);
        }
    }
}
