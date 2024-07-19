@php
    use EightyNine\Reports\ReportsManager;

    $reportGroups = collect(reports()->getReports())
        ->map(
            fn($report) => [
                'report' => app($report),
                'group' => app($report)->getGroup(),
                'heading' => app($report)->getHeading(),
                'subHeading' => app($report)->getSubheading(),
                'icon' => app($report)->getIcon(),
                'iconSize' => app($report)->getIconSize(),
                'iconColor' => app($report)->getIconColor(),
                'url' => app($report)->getUrl(),
                'shouldOpenInNewTab' => app($report)->getShouldOpenInNewTab(), // Add this line
            ],
        )
        ->sortBy('group')
        ->groupBy('group');
@endphp
<x-filament-panels::page>
    @foreach ($reportGroups as $groupName => $reportGroup)
        <x-filament::fieldset label="{{ $groupName }}">
            <x-filament::grid default="3" class="gap-4">
                @foreach ($reportGroup as $report)
                    <x-filament::grid.column>
                        <a
                            {{ \Filament\Support\generate_href_html($report['url'], $report['shouldOpenInNewTab']) }}>
                            <div class="hover:cursor-pointer hover:shadow-lg hover:rounded-2xl">

                                <x-filament::section class="h-28">
                                    <div class="flex gap-4 items-center h-full">
                                        @isset($report['icon'])
                                            <x-filament::icon :icon="$report['icon']" class="w-{{ $report['iconSize'] }} h-{{ $report['iconSize'] }} p-0 m-0 text-{{ $report['iconColor'] }}" />
                                        @endisset
                                        <div class="flex flex-col">
                                            @isset($report['heading'])
                                                <p class="text-md font-bold">{{ $report['heading'] }}</p>
                                            @endisset
                                            @isset($report['subHeading'])
                                                <p class="text-sm opacity-70">{{ $report['subHeading'] }}</p>
                                            @endisset
                                        </div>
                                    </div>
                                </x-filament::section>
                            </div>
                        </a>
                    </x-filament::grid.column>
                @endforeach
            </x-filament::grid>
        </x-filament::fieldset>
    @endforeach
</x-filament-panels::page>
