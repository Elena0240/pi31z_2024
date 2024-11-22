<?php

require_once('IFigure.php');

class King extends Figure {
    protected array $icon = ["\u{265A}", "\u{2654}"];

    public function canMove(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool {
        $row_diff = abs($to_row - $from_row);
        $col_diff = abs($to_col - $from_col);

        if ($row_diff <= 1 && $col_diff <= 1) {
            $target_item = $board->getItem($to_row, $to_col);
            if ($target_item === null || $target_item->color !== $this->color) {
                return true;
            }
        }

        return false;
    }
}