<?php

namespace Tests\Feature\Services;

use App\Services\Dictionary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DictionaryTest extends TestCase
{
    /** @test */
    public function it_should_return_an_instance()
    {
        $dictionary = new Dictionary();

        $this->assertInstanceOf(Dictionary::class, $dictionary);
    }

    /** @test */
    public function it_should_returns_an_empty_array_if_not_words_founds()
    {
        $length = 100;

        $dictionary = new Dictionary();
        $words = $dictionary->getWordsWith($length);

        $this->assertCount(0, $words);
    }

    /** @test */
    public function it_should_get_words_of_a_specific_length()
    {
        $length = 7;

        $dictionary = new Dictionary();
        $words = $dictionary->getWordsWith($length);

        foreach ($words as $word) {
            $this->assertEquals(7, iconv_strlen($word));
        }
    }

    /** @test */
    public function it_check_if_dictionary_file_exists()
    {
        $dictionary = new Dictionary();

        $this->assertTrue($dictionary->exists());

        $dictionary->setPath('fail/path');

        $this->assertFalse($dictionary->exists());
    }
}
