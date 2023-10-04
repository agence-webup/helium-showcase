<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
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

    public function onRowClick($model)
    {
        return redirect()->to('#'.$model->id);
    }

    // public function addCustomFilters($customFilters)
    // {
    //     $this->query
    //         ->when($minCreatedAt = Arr::get($customFilters, 'minCreatedAt'), function ($query) use ($minCreatedAt) {
    //             return $query->where('created_at', '>=', $minCreatedAt);
    //         })
    //         ->when($maxCreatedAt = Arr::get($customFilters, 'maxCreatedAt'), function ($query) use ($maxCreatedAt) {
    //             return $query->where('created_at', '<=', $maxCreatedAt);
    //         })
    //         ->when($minHighestProductPrice = Arr::get($customFilters, 'minHighestProductPrice'), function ($query) use ($minHighestProductPrice) {
    //             return $query->having('products_max_price', '>=', $minHighestProductPrice);
    //         })
    //         ->when($maxHighestProductPrice = Arr::get($customFilters, 'maxHighestProductPrice'), function ($query) use ($maxHighestProductPrice) {
    //             return $query->having('products_max_price', '<=', $maxHighestProductPrice);
    //         });
    // }

    public function columns()
    {
        return [
            Column::select('name')
                ->label('Name')
                ->sortable()
                ->searchable()
                ->alignLeft(),

            Column::add('products_count')
                ->label('Nb Produits Total')
                ->sortable()
                ->columnClasses(['w-6'])
                ->classes(['text-right']),

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
                        return number_format($price, 2, ',', ' ').' €';
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
                ->label('Prix Produit le + chère')
                ->format(function ($value) {
                    if ($value > 0) {
                        return number_format($value, 2, ',', ' ').' €';
                    }

                    return '-';
                }),

            Column::select('created_at')
                ->label('Créée le')
                ->sortable()
                ->columnClasses(['w-44'])
                ->alignCenter()

                ->format(function ($value) {
                    return $value->format('d/m/Y');
                }),

            Column::select('status')
                ->label('Status')
                ->sortable()
                ->columnClasses(['w-24'])
                ->alignCenter()

                ->format(function ($value) {
                    return new HtmlString(Blade::render(
                        '<x-helium-ui::tag label="{{ $label }}" modifier="{{ $color }}" />',
                        [
                            'label' => $value->getLabel(),
                            'color' => $value->getColor(),
                        ]
                    ));
                }),

            Column::select('highlighted')
                ->label('Mise en avant')
                ->sortable()
                ->columnClasses(['w-24'])
                ->alignCenter()
                ->format(function ($value) {
                    if ($value) {
                        return new HtmlString(Blade::render(
                            '<x-tabler-star class="w-5 text-yellow-600 inline" />',
                        ));
                    }

                    return '';
                }),
        ];
    }
}
