@extends('helium-ui::layout.admin')
@section('topbar')
    <x-helium-ui::layout.topbar>
        <x-slot:title>Ici un titre</x-slot:title>
        <x-slot:actions>
            <x-helium-ui::button href="#" label="Primary" icon="tabler-cloud-upload" />
            <x-helium-ui::button href="#" label="Secondary" modifier="secondary" icon="tabler-key" />
            <x-helium-ui::dropdown>
                <x-helium-ui::dropdown.item href="#" label="Action 1" />
                <x-helium-ui::dropdown.item label="Action 2" />
                <x-helium-ui::dropdown.item label="Action 3" />
            </x-helium-ui::dropdown>
        </x-slot:actions>
    </x-helium-ui::layout.topbar>
@endsection
@section('content')
    <x-helium-ui::filters>
        <x-helium-ui::filters.item label="tab 1" />
        <x-helium-ui::filters.item label="tab 2" />
        <x-helium-ui::filters.item label="tab 3" />
        <x-helium-ui::filters.item label="tab 4" />
    </x-helium-ui::filters>
    <div class="grid grid-cols-4 gap-5">
        <x-helium-ui::stats title="Titre 1" value="Valeur 1" />
        <x-helium-ui::stats title="Titre 2" value="Valeur 2" />
        <x-helium-ui::stats title="Titre 3" value="Valeur 3" />
        <x-helium-ui::stats title="Titre 4" value="Valeur 4" />
    </div>
    <div class="grid grid-cols-2 gap-5">
        <x-helium-ui::box>
            <x-slot:title>Tags</x-slot:title>
            <x-helium-ui::tag label="gray" modifier="gray" />
            <x-helium-ui::tag label="red" modifier="red" />
            <x-helium-ui::tag label="yellow" modifier="yellow" />
            <x-helium-ui::tag label="green" modifier="green" />
            <x-helium-ui::tag label="blue" modifier="blue" />
            <x-helium-ui::tag label="indigo" modifier="indigo" />
            <x-helium-ui::tag label="purple" modifier="purple" />
            <x-helium-ui::tag label="pink" modifier="pink" />
            <x-helium-ui::tag label="orange" modifier="orange" />
        </x-helium-ui::box>
        <x-helium-ui::box>
            <x-slot:title>
                Test
            </x-slot:title>
            Ici un datatable
        </x-helium-ui::box>
    </div>

    <x-helium-ui::box>
        <x-slot:title>Notifications</x-slot:title>
        <x-helium-ui::button label="Success" modifier="ghost" onclick="Helium.notif.success('Wubalubadubdub')" />
        <x-helium-ui::button label="Error" modifier="ghost" onclick="Helium.notif.error('Wubalubadubdub')" />
        <x-helium-ui::button label="Warning" modifier="ghost" onclick="Helium.notif.open({type:'warning', message: 'Wubalubadubdub' })" />
        <x-helium-ui::button label="Info" modifier="ghost" onclick="Helium.notif.open({type:'info', message: 'Wubalubadubdub' })" />
    </x-helium-ui::box>

    <x-helium-ui::box>
        <x-slot:title>Forms</x-slot:title>
        <div class="f-group">
            <label for="lastname" class="">Label 1</label>
            <input type="text" id="lastname" name="lastname" class="">
        </div>

        <div class="f-group">
            <label for="label_2" class="">Label 2</label>
            <input type="text" id="lastname" name="lastname" class="">
        </div>

        <label class="mt-3 flex cursor-pointer items-center">
            <input type="checkbox" name="" checked="">
            <span class="ml-2">XL</span>
        </label>

    </x-helium-ui::box>

    <x-helium-ui::box>
        <x-slot:title>Datatable</x-slot:title>

    </x-helium-ui::box>
@endsection
