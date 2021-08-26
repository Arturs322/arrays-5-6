<?php

$brands = array(
    'bmw',
    'audi',
    'porsche',
    'lamborghini',
    'renault',
    'jaguar',
    'mercedes',
    'lexus',
    'mazda',
    'volvo',
    'volkswagen',
    'ford'
);

function getRandomBrand(array $brands): string
{
    return$brands[array_rand($brands)];
}

function getaRandomBrand(string $brands): array
{
    $hiddenBrand = [];
    for ($i = 0; $i < strlen($brands); $i++) {
        $brands[$i] = "_";
        $hiddenBrand[] = $brands[$i];
    }
    return $hiddenBrand;

}

$randomBrand = getRandomBrand($brands);
$hiddenBrand = getaRandomBrand($randomBrand);

$misses = [];
$endgame = false;
$gameIsRunning = true;

while ($gameIsRunning) {
    echo 'Guess The Brand!'.PHP_EOL;
    echo 'You can fail guessing only 3 letters' . PHP_EOL;
    echo 'Type in your guess: '.PHP_EOL;

    foreach ($hiddenBrand as $letter) {
        echo "$letter ";
    }
    echo PHP_EOL;

    echo 'Missed letters: ';
    foreach ($misses as $miss) {
        echo "$miss ";
    }
    echo PHP_EOL;

    if (in_array("_", $hiddenBrand)) {
        $guess = readline('Guess: ');
        if (strlen($guess) > 1 || !in_array($guess, range("a", "z"))) {
            echo 'Invalid input!' . PHP_EOL;
            continue;
        }

        $guessPos = strpos($randomBrand, $guess);

        if ($guessPos === false) {
            if (!in_array($guess, $misses)) {
                array_push($misses, $guess);
            }
            if (count($misses) === 3) {
                echo "You missed 3 letters. Right brand was $randomBrand \n" ;
                $endgame = true;
            }
        } else {
            $hiddenBrand[$guessPos] = $guess;
        }
    } else {
        echo 'GOOD JOB, YOU GUESSED THE WORD!' . PHP_EOL;
        $endgame = true;
    }

    if ($endgame === true) {
        $choice = readline("Just type \"more\" if you want to play again or \"exit\" to exit the game. ");
        switch ($choice) {
            case 'exit':
                $gameIsRunning = false;
                break;
            case 'more':
                $randomBrand = getRandomBrand($brands);
                $hiddenBrand = getaRandomBrand($randomBrand);
                $misses = [];
                $endgame = false;
                break;
            default:
                echo 'Invalid input!' . PHP_EOL;
                $gameIsRunning = false;
                break;
        }
    }
}
