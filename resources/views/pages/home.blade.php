@extends('hui::layout.admin')

@section('css')
    @livewireStyles
@endsection

@section('js')
    @livewireScripts
@endsection

@section('topbar')
    <x-hui::layout.topbar>
        <x-slot:title>Ici un titre</x-slot:title>
        <x-slot:actions>
            <x-hui::button href="#"
                           label="Primary"
                           icon="tabler-cloud-upload" />
            <x-hui::button href="#"
                           label="Secondary"
                           modifier="secondary"
                           icon="tabler-key" />
            <x-hui::dropdown>
                <x-hui::dropdown.item href="#"
                                      label="Action 1" />
                <x-hui::dropdown.item label="Action 2" />
                <x-hui::dropdown.item label="Action 3" />
            </x-hui::dropdown>
        </x-slot:actions>
    </x-hui::layout.topbar>
@endsection
@section('content')
    <x-hui::filters>
        <x-hui::filters.item label="All"
                             filter="all" />
        <x-hui::filters.item label="Stats"
                             filter="ui1" />
        <x-hui::filters.item label="Misc"
                             filter="ui2" />
        <x-hui::filters.item label="Forms"
                             filter="ui3" />
        <x-hui::filters.item label="Datatable"
                             filter="ui4" />
    </x-hui::filters>
    <div data-helium-filter-target="ui1">
        <div class="grid grid-cols-4 gap-5">
            <x-hui::stats title="Titre 1"
                          value="Valeur 1" />
            <x-hui::stats title="Titre 2"
                          value="Valeur 2" />
            <x-hui::stats title="Titre 3"
                          value="Valeur 3" />
            <x-hui::stats title="Titre 4"
                          value="Valeur 4" />
        </div>
    </div>
    <div data-helium-filter-target="ui2">
        <div class="grid grid-cols-3 gap-5">
            <x-hui::box>
                <x-slot:title>Tags</x-slot:title>
                <x-hui::tag label="gray"
                            modifier="gray" />
                <x-hui::tag label="red"
                            modifier="red" />
                <x-hui::tag label="yellow"
                            modifier="yellow" />
                <x-hui::tag label="green"
                            modifier="green" />
                <x-hui::tag label="blue"
                            modifier="blue" />
                <x-hui::tag label="indigo"
                            modifier="indigo" />
                <x-hui::tag label="purple"
                            modifier="purple" />
                <x-hui::tag label="pink"
                            modifier="pink" />
                <x-hui::tag label="orange"
                            modifier="orange" />
            </x-hui::box>
            <x-hui::box>
                <x-slot:title>
                    Dots
                </x-slot:title>
                <x-hui::dot modifier="gray" />
                <x-hui::dot modifier="red" />
                <x-hui::dot modifier="yellow" />
                <x-hui::dot modifier="green" />
                <x-hui::dot modifier="blue" />
                <x-hui::dot modifier="indigo" />
                <x-hui::dot modifier="purple" />
                <x-hui::dot modifier="pink" />
                <x-hui::dot modifier="orange" />
            </x-hui::box>
            <x-hui::box>
                <x-slot:title>Notifications</x-slot:title>
                <x-hui::button label="Success"
                               modifier="ghost"
                               onclick="Helium.notif.success('Wubalubadubdub')" />
                <x-hui::button label="Error"
                               modifier="ghost"
                               onclick="Helium.notif.error('Wubalubadubdub')" />
                <x-hui::button label="Warning"
                               modifier="ghost"
                               onclick="Helium.notif.open({type:'warning', message: 'Wubalubadubdub' })" />
                <x-hui::button label="Info"
                               modifier="ghost"
                               onclick="Helium.notif.open({type:'info', message: 'Wubalubadubdub' })" />
            </x-hui::box>
        </div>
    </div>
    <div data-helium-filter-target="ui3">
        <x-hui::box>
            <x-slot:title>Forms</x-slot:title>
            <form method="POST"
                  action="/test">
                @csrf
                <div class="space-y-4">
                    <x-hui::form.input name="firstname"
                                       label="Firstname"
                                       type="text"
                                       class="max-w-md" />
                    <x-hui::form.input name="email"
                                       label="Email"
                                       type="email"
                                       info="Additional information on this field."
                                       class="max-w-md" />
                    <x-hui::form.textarea name="description"
                                          label="Description"
                                          info="Additional information on this field."
                                          class="max-w-lg"
                                          rows="5" />
                </div>

                <div class="mb-3 mt-3 grid grid-cols-3 gap-5">
                    <x-hui::form.input name="input_1"
                                       label="Password"
                                       type="password" />
                    <x-hui::form.input name="input_2"
                                       label="Number"
                                       type="number" />
                    <x-hui::form.input name="input_3"
                                       label="Date"
                                       type="date" />
                </div>

                <div class="flex max-w-md items-end gap-4">
                    <x-hui::form.input name="input_4"
                                       label="Start"
                                       type="date"
                                       class="h-10" />
                    <x-hui::form.input name="input_5"
                                       label="End"
                                       type="date"
                                       class="h-10" />
                    <x-hui::button label="Delete"
                                   icon="tabler-trash"
                                   modifier="danger"
                                   class="h-10" />
                </div>

                <x-hui::divider />

                <div class="mb-5 mt-3">
                    <x-hui::form.checkbox name="checkbox"
                                          label="Checkboxes">
                        <x-hui::form.checkbox.item name="checkbox[]"
                                                   value="checkbox_1"
                                                   label="label 1" />
                        <x-hui::form.checkbox.item name="checkbox[]"
                                                   value="checkbox_2"
                                                   label="label 2" />
                        <x-hui::form.checkbox.item name="checkbox[]"
                                                   value="checkbox_3"
                                                   label="label 3" />
                        <x-hui::form.checkbox.item name="checkbox[]"
                                                   value="checkbox_4"
                                                   label="label 4" />
                    </x-hui::form.checkbox>
                </div>

                <div>
                    <x-hui::button label="Test errors"
                                   type="submit" />
                </div>
            </form>
        </x-hui::box>
    </div>

    <div data-helium-filter-target="ui4">
        <x-hui::box>
            <x-slot:title>Datatable</x-slot:title>
            <livewire:admin.category-datatable sharedKey="category-datatable"
                                               paginationSize=10
                                               queryPrefix="c" />
            {{-- <livewire:category-sidebar sharedKey="category-datatable" /> --}}
        </x-hui::box>
    </div>
@endsection
