<?php
$distance = 20;
$minSpeed = 1;
$maxSpeed = 3;
$actionSpeed = 1;
$wallet = 1000;
$players = explode(' ', readline('Enter players: '));
$choice = readline('Enter player you are betting on: ');
$bet = (int)readline('Enter amount of money, you are betting: ');
$wallet -= $bet;
$track =[];
for($i = 0; $i < count($players); $i++) {
    $track[$i] = array_fill(0, $distance, '-');
    $track[$i][0] = $players[$i];
}

$finished = [];
while (count($finished) < count($players))
{
    system('clear');
    for($i = 0; $i < count($players); $i++) {
        $currentPosition = array_search($players[$i], $track[$i]);
        if ($currentPosition === false) continue;
        $step = rand($minSpeed, $maxSpeed);
        $nextPosition = $currentPosition + $step;

        if ($nextPosition > $distance) {
            $nextPosition = $distance;
        }
        if ( ! in_array($players[$i], $finished)) {
            $track[$i][$currentPosition + $step] = $players[$i];
            $track[$i][$currentPosition] = '-';
        }
        if ($nextPosition === $distance && ! in_array($players[$i], $finished)) {
            $finished[] = $players[$i];
        }
    }
    foreach ($track as $line)
        echo implode('', $line) . PHP_EOL;
    sleep($actionSpeed);
}

foreach ($finished as $place => $player) {
    $place = $place + 1;
    echo "$place - $player" . PHP_EOL;
}
for ($i = 0; $i < count($finished); $i++) {
    $finishedReverse = array_reverse($finished);
    if ($choice === $finishedReverse[$i]) {
        $reward = $bet * ($i + 1);
        if ($i + 1 >= (count($finished) / 2)) {
            $wallet += $reward;
        } else {
            $reward = 0;
        }
        echo "Your reward is $reward" . PHP_EOL;
        echo "Your wallet balance is $wallet" . PHP_EOL;
    }
}

