<?php

namespace App\Orchid\Screens;

use App\Models\Deal;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class DealEditScreen extends EditScreen
{

    public function getModelKey()
    {
        return 'deal';
    }

    public function query(Deal $model): array
    {
        $this->exists = $model->exists;

        if ($this->exists) {
            $this->name = 'Edit';
        }

        return [
            $this->getModelKey() => $model,
        ];
    }

    public function createOrUpdate(Deal $model, Request $request)
    {
        $data = $request->get($this->getModelKey());
        $model->fill($data)->save();

        $uploadedImage = $request->all()['deal']['image'] ?? null;

        if(!empty($uploadedImage)){
            $model->image = $uploadedImage->store('deal-images');
            $model->save();
        }
        Alert::info('Successfully Created');

        return redirect()->route('platform.'.$this->getModelKey().'.list');
    }

    public function layout(): array
    {
        $fields = [
            Input::make('deal.title')->required()
                ->title('Title'),
            DateTimer::make('deal.expires_at')
                ->title('Expires At'),
            CheckBox::make('deal.status')->value(0)->title('Is Active')->sendTrueOrFalse(),
            Input::make('deal.image')->type('file')
                ->title('Upload Image')
            ,
        ];

        if(auth()->user()->isAdmin()) {
            $fields[] = Relation::make('deal.vendor_id')
                ->title('Vendor')
                ->fromModel(Vendor::class, 'vendor_name')->required();
        }else{
            $fields[] = Input::make('deal.vendor_id')->hidden(true)->value(auth()->user()->shop->id);
        }

        return [
            Layout::rows($fields),
        ];
    }

    public function remove(Deal $model)
    {
        $model->delete();
        Alert::info('You have successfully deleted');

        return redirect()->route('platform.deal.list');
    }

}
