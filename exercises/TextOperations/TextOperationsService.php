<?php

declare(strict_types=1);

namespace Exercises\TextOperations;

final class TextOperationsService
{
    static function capitalizeSentences(string $inputText): string
    {
        $sentences = preg_split('/(?<=[.!?])\s+/', $inputText);

        foreach ($sentences as &$sentence) {
            $sentence = mb_strtoupper(mb_substr($sentence, 0, 1, 'UTF-8'), 'UTF-8') .
                mb_strtolower(mb_substr($sentence, 1, null, 'UTF-8'), 'UTF-8');
        }

        $outputText = implode(' ', $sentences);

        return $outputText;
    }

    static function removeExtraSpaces(string $inputText): string
    {
        return preg_replace('/\s+/', ' ', $inputText);
    }

    static function formatText(string $inputText): string
    {
        $sentences = preg_split('/([.!?])\s*/', $inputText, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        $formattedText = '';
        foreach ($sentences as $key => $sentence) {
            if ($key % 2 === 0) {
                $sentence = trim($sentence);
                if (!empty($sentence)) {
                    if (mb_strtolower(mb_substr($sentence, 0, 1)) === mb_substr($sentence, 0, 1)) {
                        $sentence = mb_strtoupper(mb_substr($sentence, 0, 1)) . mb_substr($sentence, 1);
                    }
                    if ($formattedText !== '') {
                        $formattedText .= ' ';
                    }
                    $formattedText .= $sentence;
                }
            } else {
                $formattedText .= $sentence;
            }
        }

        return $formattedText;
    }
}
