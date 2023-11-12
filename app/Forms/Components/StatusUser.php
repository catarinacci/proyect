<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class StatusUser extends Component
{
    protected string $view = 'forms.components.status-user';

    protected array $items = [];

    public static function make(): static
    {
        return new static();
    }

    public function items(array $items): static
    {
        $this->items = $items;
        
        return $this;
    }


    public function getItems(): array
    {
        return $this->items;
    }
}
