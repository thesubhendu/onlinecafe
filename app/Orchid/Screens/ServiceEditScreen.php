<?php

namespace App\Orchid\Screens;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;

class ServiceEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Add Service';

    public function rules(): array
    {
        return [
            'id'             => 'sometimes|integer|unique:posts',
            'content.*.name' => 'required|string',
            'content.*.body' => 'required|string',
        ];
    }

    /**
     * Query data.
     *
     * @param  Service  $service
     * @return array
     */
    public function query(Service $service): array
    {
        $this->exists = $service->exists;

        if ($this->exists) {
            $this->name = 'Edit Service';
        }

        return [
            'service' => $service,
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
            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),

            Button::make('Save')
                ->icon('plus')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

        ];
    }

    public function createOrUpdate(Service $model, Request $request)
    {
        $request->validate([
            'service.name' => [
                'required',
                Rule::unique(Service::class, 'name')->ignore($model),
            ],
        ]);

        $data = $request->get('service');
        $model->fill($data)->save();

        Alert::info('Saved Successfully');

        return redirect()->route('platform.service.list');
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('service.name')
                    ->title('Name')
            ])
        ];
    }

}
