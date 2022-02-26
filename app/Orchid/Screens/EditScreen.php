<?php

namespace App\Orchid\Screens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

abstract class EditScreen extends Screen
{
    public $name = 'Create';
    public bool $exists = false;
    abstract public function getModelKey();

    public function commandBar(): array
    {
        return [
            Button::make('Add')
                  ->icon('pencil')
                  ->method('createOrUpdate')
                  ->canSee(! $this->exists),

            Button::make('Update')
                  ->icon('note')
                  ->method('createOrUpdate')
                  ->canSee($this->exists),

            Button::make('Remove')
                  ->icon('trash')
                  ->method('remove')
                  ->canSee($this->exists),
        ];
    }


}
