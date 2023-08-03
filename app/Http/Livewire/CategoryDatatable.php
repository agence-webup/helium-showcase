<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Webup\LaravelHeliumCore\Datatable\Column;
use Webup\LaravelHeliumCore\Datatable\Datatable;

class CategoryDatatable extends Datatable
{
    public function baseQuery()
    {
        return Category::query();
    }

    public function link($category)
    {
        return '#' . $category->id;
    }

    public function columns()
    {
        return [
            Column::name('name')
                ->label('Name')
                ->sortable()
                ->searchable()
                ->alignLeft(),

            Column::name('created_at')
                ->label('Créée le')
                ->sortable()
                ->searchable()
                ->alignCenter()
                ->format(function ($value) {
                    return $value->format('d/m/Y');
                }),

            Column::name('status')
                ->label('Status')
                ->sortable()
                ->searchable()
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
                ->label('highlighted')
                ->sortable()
                ->searchable()
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
