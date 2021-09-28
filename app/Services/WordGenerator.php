<?php

namespace App\Services;

class WordGenerator
{
    private string $string;

    private int $length;

    private object $dictionary;

    private array $lettersFound = [];

    private array $foundWords = [];

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
        $this->findWordsFrom(
            $this->getDictionaryWords()
        );

        return $this->getFoundWords();
    }

    private function replaceSpecialChars(string $word) : string
    {
        return strtolower(str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $word));
    }

    private function getDictionaryWords(): array
    {
        return $this->dictionary->getWordsWith($this->length);
    }

    private function isValidWord(): int
    {
        return count($this->lettersFound);
    }

    private function findWordsFrom(array $dictionaryWords): void
    {
        foreach ($dictionaryWords as $word) {
            if(preg_match_all($this->getPattern(), $this->replaceSpecialChars($word), $matches)) {
                $this->addToFoundWords($word);
            }
        }
    }

    private function getFoundWords(): array
    {
        return $this->foundWords;
    }

    private function getPattern(): string
    {
        return "/^[" . strtolower($this->string) . "]+$/iU";
    }

    private function addToFoundWords($word)
    {
        $this->foundWords[] = $word;
    }
}
