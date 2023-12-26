<?php

namespace App\Enums;
 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Ramsey\Uuid\Type\Integer;

enum AvailabilityStatus: int implements HasLabel, HasColor, HasIcon
{
    case NOT_FOR_SALE = -1;
    case SOLD = 0;
    case FOR_SALE = 1;
 
    public function getLabel(): ?string
    {
        return match ($this) {
            self::NOT_FOR_SALE => 'not for sale',
            self::SOLD => 'sold',
            self::FOR_SALE => 'for sale',
        };
    }
 
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NOT_FOR_SALE => 'gray',
            self::SOLD => 'success',
            self::FOR_SALE => 'info',
        };
    }
 
    public function getIcon(): ?string
    {
        return match ($this) {
            self::NOT_FOR_SALE => 'heroicon-s-eye-slash',
            self::SOLD => 'heroicon-s-currency-yen',
            self::FOR_SALE => 'heroicon-s-eye',
        };
    }
}