<?php
require_once('color.php');
require_once('IFigure.php');
require_once('Pawn.php');

class Board {
    private Color $player = Color::White;

    private array $board = [];

    public function __construct() {
        for ($i = 0; $i < 8; $i += 1) {
            $this->board[] = [];
            for ($j = 0; $j < 8; $j += 1) {
                $this->board[$i][] = null;
            }
        }
        foreach ([1, 6] as $row) {
            for ($col = 0; $col < 8; $col += 1) {
                $this->setItem(
                    $row,
                    $col,
                    new Pawn(
                        $row === 6 ? Color::White : Color::Black
                    )
                );
            }
        }
    }

    public function getItem(int $row, int $col): IFigure | null {
        if (!$this->isCorrectCoordinate($row, $col)) {
            return null;
        }
        return $this->board[$row][$col];
    }

    private function isCorrectCoordinate(int $row, int $col): bool {
        return $row < 8 && $row >= 0 && $col < 8 && $col >= 0;
    }

    private function setItem(int $row, int $col, IFigure | null $item) : void {
        if ($this->isCorrectCoordinate($row, $col)) {
            $this->board[$row][$col] = $item;
        }
    }

    public function printBoard(): void {
        $line = implode('', [
            '   ',
            '+',
            str_repeat('----+', 8),
        ]) . PHP_EOL;
        echo $line;
        for ($i = 0; $i < 8; $i += 1) {
            echo 8 - $i;
            echo '  |';
            for ($j = 0; $j < 8; $j += 1) {
                echo ' ';
                $item = $this->getItem($i, $j);
                if ($item) {
                    echo $item->getIcon();
                } else {
                    echo '  ';
                }
                echo ' |';
            }
            echo PHP_EOL;
            echo $line;
        }
        echo '   ';
        for ($i = 0; $i < 8; $i += 1) {
            echo '   ';
            echo chr(ord('A') + $i);
            echo ' ';
        }
        echo PHP_EOL;
    }
}
   


   
