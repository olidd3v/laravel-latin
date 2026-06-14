<?php

namespace App\Filament\Widgets;

use App\Models\Activity;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActivityStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Kegiatan',
                Activity::count()
            ),

            Stat::make(
                'Draft',
                Activity::where('status', 'draft')->count()
            ),

            Stat::make(
                'Proses',
                Activity::where('status', 'process')->count()
            ),

            Stat::make(
                'Selesai',
                Activity::where('status', 'done')->count()
            ),
        ];
    }
}
