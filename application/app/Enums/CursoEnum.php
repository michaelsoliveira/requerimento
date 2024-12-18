<?php

namespace App\Enums;

enum TipoEnum : string {
    case Sistemas = 'sistemas';
    case Redes = 'Redes';
    case Engenharia = 'engenharia';

    public static function active(): array
    {
        return [
            self::Sistemas->value,
            self::Redes->value,
            self::Engenharia->value,
        ];
    }
}