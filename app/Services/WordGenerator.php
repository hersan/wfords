<?php

namespace App\Services;

class WordGenerator
{
    private string $string;
    private int $length;
    private object $dictionary;
    private array $lettersFound = [];

    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function wordsFrom(string $string): WordGenerator
    {
        $this->string = $string;

        return $this;
    }

    public function withLength(int $length): WordGenerator
    {
        $this->length = $length;

        return $this;
    }

    public function getWords(): array
    {
        $foundWords = [];
        $dictionaryWords = $this->getDictionaryWords();

        foreach ($dictionaryWords as $word){
            $letters = $this->getLettersFromString();
            $chars = $this->wordToChars($word);

            $this->checkLettersInWord($chars, $letters);

            if($this->isValidWord()){
                $foundWords[] = $word;
            }
        }

        return $foundWords;
    }

    private function getLettersFromString(): array
    {
        return str_split(strtolower($this->string));
    }


    private function wordToChars(string $word) : array
    {
        return str_split(
            strtolower(str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $word))
        );
    }

    private function getDictionaryWords(): array
    {
        return $this->dictionary->getWordsWith($this->length);
    }

    private function isValidWord(): int
    {
        return count($this->lettersFound);
    }

    /**
     * @param array $chars
     * @param array $letters
     */
    private function checkLettersInWord(array $chars, array $letters): void
    {
        foreach ($chars as $char) {
            if (($key = array_search($char, $letters)) !== false) {
                $this->lettersFound[] = $key;
                unset($letters[$key]);
            }
        }
    }
}
