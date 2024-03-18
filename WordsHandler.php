<?php

header("Content-Type: text/html; charset=utf-8");

$word = readline('Введите слово' . PHP_EOL);

class WordsHandler
{
    public function reverseWord($word): string
    {
        $chars = [',', '"', ':', "'"];
        $wordAsArr = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
        $reverse = strrev($word);
        $reverseArr = preg_split('//u', $reverse, -1, PREG_SPLIT_NO_EMPTY);
        $indexesOfUpperChar = [];

        for ($i = 0; $i < count($reverseArr); $i++) {
            if (mb_strtolower($reverseArr[$i], "UTF-8") != $reverseArr[$i]) {
                $indexOfUpperChar = array_search($reverseArr[$i], $wordAsArr);
                $indexesOfUpperChar[] = $indexOfUpperChar;
                $reverseArr[$i] = mb_strtolower($reverseArr[$i]);
            }
        }

        foreach ($chars as $char) {
            if (in_array($char, $reverseArr)) {
                $indexOfMark = array_search($char, $wordAsArr);
                $reverseArr = array_diff($reverseArr, ["$char"]);
                array_splice($reverseArr, $indexOfMark, 0, $char);
            }
        }

        for ($i = 0; $i < count($indexesOfUpperChar); $i++) {
            $reverseArr[$indexesOfUpperChar[$i]] = mb_strtoupper($reverseArr[$indexesOfUpperChar[$i]]);
        }

        return implode('', $reverseArr);
    }
}

$reverseWord = new WordsHandler();

$reverseWord->reverseWord($word);
