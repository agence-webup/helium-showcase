<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Webup\HeliumCore\Datatable\Column;
use Webup\HeliumCore\Datatable\Datatable;

class CategoryDatatable extends Datatable
{
    public function baseQuery()
    {
        return Category::query()
            ->withCount([
                'products',
                'availableProducts',
                'trashedProducts',
            ])
            ->withMax('products', 'price')
            ->withMax('products', 'price');
    }

    public function link($category)
    {
        return '#'.$category->id;
    }

    public function columns()
    {
        return [
            Column::name('name')
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
                ->label('Répartition produits (dispos / supprimés)')
                ->format(function ($value, $category) {
                    return $category->available_products_count.' / '.$category->trashed_products_count;
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

            Column::name('created_at')
                ->label('Créée le')
                ->sortable()
                ->columnClasses(['w-44'])
                ->alignCenter()
                ->format(function ($value) {
                    return $value->format('d/m/Y');
                }),

            Column::name('status')
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

            Column::name('highlighted')
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
