<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index(Request $request, $locale = null)
    {
        // Tenta pegar o locale do cookie primeiro, depois do parâmetro
        if (!$locale) {
            $locale = $request->cookie('locale', 'pt_BR');
        }
        
        // Valida o locale
        if (!in_array($locale, ['pt_BR', 'en'])) {
            $locale = 'pt_BR';
        }
        
        // Define o locale da aplicação
        App::setLocale($locale);
        
        // Carrega os dados traduzidos
        $data = [
            'personal' => trans('cv.personal'),
            'sections' => trans('cv.sections'),
            'about' => trans('cv.about'),
            'experiences' => trans('cv.experiences'),
            'education' => trans('cv.education'),
            'skills' => trans('cv.skills'),
            'cta' => trans('cv.cta'),
            'footer' => trans('cv.footer'),
            'currentLocale' => $locale,
        ];

        return response()
            ->view('curriculum', $data)
            ->cookie('locale', $locale, 525600); // 1 ano
    }
    
    public function setLocale($locale)
    {
        if (in_array($locale, ['pt_BR', 'en'])) {
            return redirect()
                ->route('curriculum')
                ->cookie('locale', $locale, 525600); // 1 ano
        }
        
        return redirect()->route('curriculum');
    }
}

