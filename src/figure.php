<?php
require_once('./color.php');


interface IFigure {
    public function __construct(Color $color);
    public function getColor(): Color;
    public function getIcon(): string;
}

abstract class Figure implements IFigure {
    private Color $color;
    protected string $icon;

    public function __construct(Color $color){
        $this->color = $color;
    }

    public function getColor(): Color {
        return $this->color;
    }

    public function getIcon(): string {
        $prefix = $this->color === Color::Black ? 'b' : 'w';
        return $prefix . $this->icon;
    }

}