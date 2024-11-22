<?php

require_once('IFigure.php');

class Queen extends Figure {
    protected array $icon = ["\u{265B}", "\u{2655}"];

    public function canMove(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool {
    
        if (($to_row == $from_row) || ($to_col == $from_col)) {
            return $this->checkStraightLineMovement($from_row, $from_col, $to_row, $to_col, $board);
        }
        
    
        if (abs($to_row - $from_row) == abs($to_col - $from_col)) {
            return $this->checkDiagonalMovement($from_row, $from_col, $to_row, $to_col, $board);
        }
        
        return false;
    }
    
    private function checkStraightLineMovement(
        int $from_row,
        int $from_col,
        int $to_row,
        int $to_col,
        Board $board
    ): bool {
        $row_diff = $to_row - $from_row;
        $col_diff = $to_col - $from_col;
        
        if ($row_diff != 0) {
            $direction = $row_diff > 0 ? 1 : -1;
            for ($i = $from_row + $direction; $i != $to_row; $i += $direction) {
                if ($board->getItem($i, $from_col)) {
                    return false;
                }
            }
        } else {
            $direction = $col_diff > 0 ? 1 : -1;
            for ($j = $from_col + $direction; $j != $to_col; $j += $direction) {
                if ($board->getItem($from_row, $j)) {
                    return false;
                }
            }
        }
        
        return true;
    }
    
    private function checkDiagonalMovement(
        int $from_row,
        int $from_col,
        int $to_row,
        int $to_col,
        Board $board
    ): bool {
        $row_diff = $to_row - $from_row;
        $col_diff = $to_col - $from_col;
        
        $direction_row = $row_diff > 0 ? 1 : -1;
        $direction_col = $col_diff > 0 ? 1 : -1;
        
        for ($i = $from_row + $direction_row, $j = $from_col + $direction_col;
             $i != $to_row && $j != $to_col;
             $i += $direction_row, $j += $direction_col) {
            if ($board->getItem($i, $j)) {
                return false;
            }
        }
        
        return true;
    }
}