<?php

namespace App\Orchid\Screens;

use App\Models\Service;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ServiceListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Services';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'services' => Service::filters()->latest()->paginate(50)
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.service.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::table('services', [
                TD::make('id'),
                TD::make('name'),
                TD::make('Action')->render(function ($service) {
                    return Group::make([
                        Link::make('Edit')->icon('pencil')->route('platform.service.edit', $service),
                        Button::make('Remove')
                            ->icon('trash')
                            ->method('remove', [$service->id])
                            ->with($service)
                    ]);
                }),
            ]),
        ];
    }

    public function remove(Service $service)
    {
        $service->delete();
        Toast::info(__('Service was removed'));
    }

}
