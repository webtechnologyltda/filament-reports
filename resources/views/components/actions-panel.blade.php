<div class="w-96 fi-reports-action-panel">

    <div class="flex w-full">
        <div class="flex-grow">
            <p class="text-xl">@lang('filament-reports::actions-panel.filters')</p>
        </div>
        <x-filament::dropdown>
            <x-slot name="trigger">
                <x-filament::button>
                    @lang('filament-reports::actions-panel.export')
                </x-filament::button>
            </x-slot>

            <x-filament::dropdown.list>
                <x-filament::dropdown.list.item wire:click="exportToPdf">
                    @lang('filament-reports::actions-panel.to_pdf')
                </x-filament::dropdown.list.item>

                <x-filament::dropdown.list.item @click="$exportToExcel()">
                    @lang('filament-reports::actions-panel.to_excel')
                </x-filament::dropdown.list.item>

                <x-filament::dropdown.list.item @click="$printReport()">
                    @lang('filament-reports::actions-panel.print')
                </x-filament::dropdown.list.item>
            </x-filament::dropdown.list>
        </x-filament::dropdown>
    </div>
    <div>
        <x-filament-panels::form :wire:key="$this->getId() . '.forms.' . $this->getFormStatePath()"
            wire:submit="filter">
            {{ $this->filterForm }}

            <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
        </x-filament-panels::form>

    </div>
</div>
