<?php

namespace App\Http\Controllers;

use App\Services\Dictionary;
use App\Services\WordGenerator;
use Illuminate\Http\Request;

class WordGeneratorController extends Controller
{
    public function form()
    {
        return view('form.index');
    }

    public function words(Request $request)
    {
        $validated = $request->validate([
            'string' => 'required|alpha|min:3|max:12',
            'length' => 'required|numeric|min:3|max:12'
        ]);

        $generator = new WordGenerator(
            new Dictionary
        );

        $words = $generator
            ->wordsFrom($validated['string'])
            ->withLength($validated['length'])
            ->getWords()
        ;

        return view('form.show', compact('words'));
    }
}
