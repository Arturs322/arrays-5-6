<?php
$board =[[" "," "," "],
    [" "," "," "],
    [" "," "," "]];

function display_board(array $board)
{
    echo" {$board[0][0]} | {$board[0][1]} | {$board[0][2]} \n";
    echo "---+---+--- \n";
    echo" {$board[1][0]} | {$board[1][1]} | {$board[1][2]} \n";
    echo "---+---+--- \n";
    echo" {$board[2][0]} | {$board[2][1]} | {$board[2][2]} \n";

}
$isOccupied=function(int $row,int $column)use ($board):bool
{
    return $board[$row][$column]!==" ";
};

$isTie =function ()use (&$board):bool
{
    for ($r=0;$r<3;$r++){
        for($c=0;$c<3;$c++)
        {
            if ($board[$r][$c] ===" "){
                return false;
            }
        }
    }
    return true;
};


display_board($board);

$gameIsGoing =true;
$turn =1;

$playerX ='X';
$playerO ='O';
$currentPlayer =$playerX;

while ($gameIsGoing){
    $input=readline("'{$currentPlayer},choose your location (roe,column):");

    $input = explode(" ",$input);
    if(count($input)!== 2){
        echo "invalid input \n";
        continue;
    }

    [$row,$column]= $input;
    $validInput =[0,1,2];

    $row =is_numeric($row) ? (int) $row :$row;
    $column =is_numeric($column) ? (int) $column:$column;

    if(!in_array($row,$validInput,true)||!in_array($column,$validInput,true))
    {
        echo "Invalid input \n";
        continue;
    }


    if($isOccupied($row,$column)){
        echo "That slot is taken!\n";
        continue;
    }

    $board[$row][$column]=$currentPlayer;


    display_board($board);
    for ($i =0;$i<3;$i++){
        if($board[$i][0]==$currentPlayer&&$board[$i][1]==$currentPlayer&&$board[$i][2]==$currentPlayer){
            echo "the winner is {$currentPlayer}!\n";
            exit;
        }
    }
    for ($i=0;$i<3;$i++){
        if ($board[0][$i]==$currentPlayer && $board[1][$i]==$currentPlayer&&$board[2][$i]==$currentPlayer){
            echo "the winner is '{$currentPlayer}! \n";
            exit;
        }
    }


    if($board[0][0]==$currentPlayer&&$board[1][1]==$currentPlayer && $board[2][2]==$currentPlayer){
        echo "the winner is '{$currentPlayer}! \n";
        exit;
    }

    if($board[0][2]==$currentPlayer&&$board[1][1]==$currentPlayer && $board[2][0]==$currentPlayer){
        echo "the winner is '{$currentPlayer}! \n";
        exit;
    }

    if ($isTie()){
        $gameIsGoing =false;
        echo "THe game is a tie. \n";
    }

    $currentPlayer = $currentPlayer === $playerX ? $playerO : $playerX;
}