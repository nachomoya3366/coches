<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Transacciones;
use Illuminate\Support\Facades\DB;

class Beneficio extends ChartWidget
{
    protected ?string $heading = 'Beneficio';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Transacciones::orderBy('fecha')->get();

        $labels = [];
        $beneficioAcumulado = [];
        $total = 0;

        foreach ($data as $item) {

            $labels[] = $item->fecha;

            if ($item->accion === 'venta') {
                $total += $item->precio;
            } else {
                $total -= $item->precio;
            }

            $beneficioAcumulado[] = $total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Beneficio acumulado',
                    'data' => $beneficioAcumulado,
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'ticks' => [
                        'autoSkip' => true,
                        'maxRotation' => 0,
                        'minRotation' => 0,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';  
    }
}
