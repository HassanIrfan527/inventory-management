<?php

namespace App\Enums;

enum ProductView: string
{
    case Grid = 'grid';
    case List = 'list';
    case Compact = 'compact';
    case Gallery = 'gallery';
    case Kanban = 'kanban';

    public function icon(): string
    {
        return match ($this) {
            self::Grid => 'layout-grid',
            self::List => 'list',
            self::Compact => 'rows-4',
            self::Gallery => 'images',
            self::Kanban => 'square-kanban',
        };
    }
}
