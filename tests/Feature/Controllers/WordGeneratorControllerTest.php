<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WordGeneratorControllerTest extends TestCase
{
    /** @test */
    public function it_show_form()
    {
        $response = $this->get('/');

        $response
            ->assertViewIs('form.index')
            ->assertSee('Introduzca una cadena de 12 caracteres')
            ->assertSee('Longitud')
            ->assertSee('Generar Palabras');
    }

    /** @test */
    public function it_show_generate_words()
    {
        $response = $this->post(route('generate'), [
            'string' => 'TJEUINGRTSDA',
            'length' => 7
        ]);

        $response
            ->assertOk()
            ->assertSee('turista')
            ->assertSee('negrita')
            ->assertSee('gánster')
        ;
    }
}
