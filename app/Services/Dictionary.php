<?php

namespace App\Services;


class Dictionary
{
    private ?string $filepath;

    public function getWordsWith($length): array
    {
        $words = file($this->path());
        $foundWords = [];

        foreach ($words as $word) {
            if (iconv_strlen(trim($word)) === $length) {
                $foundWords[] = trim($word);
            }
        }

        return $foundWords;
    }

    public function exists(): bool
    {
        return file_exists($this->path());
    }

    public function path(): string
    {
        return app_path(
            $this->filepath ??= 'dictionary/dictionary.txt'
        );
    }

    public function setPath(string $path = null)
    {
        $this->filepath = $path;
    }
}
