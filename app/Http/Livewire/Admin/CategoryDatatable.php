<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Number;
use Webup\HeliumCore\Datatable\Column;
use Webup\HeliumCore\Datatable\Datatable;

class CategoryDatatable extends Datatable
{
    public array $clickableProperties = [
        'id',
    ];

    public function baseQuery()
    {
        return Category::query()
            ->with(['products'])
            ->withCount([
                'products',
                'availableProducts',
                'trashedProducts',
            ])
            ->withSum('products', 'price')
            ->withMax('products', 'price');
    }

    public function link($model)
    {
        return redirect()->to('#'.$model->id);
    }

    public function columns()
    {
        return [
            Column::select('name')
                ->label('Nom')
                ->sortable()
                ->searchable()
                ->classes('w-48'),

            Column::add('products_count')
                ->label('Nb Produits Total')
                ->sortable()
                ->classes(['w-6', 'text-right']),

            Column::add('product_repartition')
                ->columnClasses(['w-6'])
                ->classes(['text-right'])
                ->sortable('available_products_count')
                ->label('Répartition produits (dispos / supprimés)')
                ->format(function ($value, $category) {
                    return $category->available_products_count.' / '.$category->trashed_products_count;
                }),

            Column::add('products_sum_price')
                ->label('Total des produits (+ details en tooltip)')
                ->sortable()
                ->columnClasses(['w-44'])
                ->classes(['text-right'])
                ->format(function ($value, $category) {
                    $productPrices = $category->products->pluck('price')->map((function ($price) {
                        return Number::currency($price, 'EUR', 'fr_FR');
                    }))->join(' + ');

                    return new HtmlString(Blade::render(
                        '<div class="inline-flex ">
                            <span title="{{ $productPrices }}">{{ $value }}</span>
                            @if($value > 0)
                                <div  title="{{ $productPrices }}" class="w-5 ml-2 text-gray-400" >
                                    <x-tabler-info-square-rounded/>
                                </div>
                            @endif
                        </div>',
                        [
                            'productPrices' => $productPrices,
                            'value' => $value > 0 ? number_format($value, 2, ',', ' ').' €' : '-',

                        ]
                    ));

                }),

            Column::add('products_max_price')
                ->sortable()
                ->columnClasses(['w-44'])
                ->alignRight()
                ->label('Prix Produit le + chèr')
                ->format(fn ($value) => $value > 0 ? number_format($value, 2, ',', ' ').' €' : '-'),

            Column::select('created_at')
                ->label('Créée le')
                ->sortable()
                ->columnClasses(['w-44'])
                ->alignCenter()

                ->format(fn ($value) => $value->format('d/m/Y')),

            Column::raw('status as status')
                ->label('Statut')
                ->sortable()
                ->alignCenter()
                ->format(function ($value) {
                    return new HtmlString(Blade::render(
                        '<x-hui::tag label="{{ $label }}" modifier="{{ $color }}" />',
                        [
                            'label' => $value->label(),
                            'color' => $value->color(),
                        ]
                    ));
                }),

            Column::raw('highlighted as highlighted')
                ->label('Mis en avant')
                ->sortable()
                ->alignCenter()
                ->format(function ($value) {
                    $label = $value ? '✔' : '✘';
                    $modifier = $value ? 'green' : 'red';

                    return new HtmlString(Blade::render(sprintf(
                        '<x-hui::tag label="%s" modifier="%s" />',
                        $label, $modifier
                    )));
                }),
        ];
    }
}
