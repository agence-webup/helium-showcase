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
        return '#';
    }

    public function columns()
    {
        return [
            Column::name('name')
                ->label('Name')
                ->sortable()
                ->searchable(),

            Column::name('status')
                ->label('Status')
                ->sortable()
                ->searchable()
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
                ->format(function ($value) {
                    if ($value) {
                        return new HtmlString(Blade::render(
                            '<x-helium-ui::tag label="✔" modifier="green" />',
                        ));
                    }
                    return new HtmlString(Blade::render(
                        '<x-helium-ui::tag label="✘" modifier="red" />',

                    ));
                }),
        ];
    }
}
