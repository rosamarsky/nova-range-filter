<?php

namespace Rosamarsky\RangeFilter;

use Illuminate\Support\Arr;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class RangeFilter extends Filter
{
    public $component = 'range-filter';

    protected string $column;

    protected const DEFAULT_VALUES = [
        'min' => 0,
        'max' => 100,
        'interval' => 1,
        'clickable' => true,
        'tooltip' => 'active',
    ];

    public function __construct(string $title, string $column, array $options = [])
    {
        $this->name = $title;
        $this->column = $column;
        $this->withMeta(array_merge(
            static::DEFAULT_VALUES,
            Arr::only($options, [
                'min', 'max', 'interval',
                'minRange', 'maxRange',
                'tooltip', 'clickable',
                'disabled', 'label',
            ]),
        ));
    }

    public function apply(NovaRequest $request, $query, $value)
    {
        if (is_array($value)) {
            return $query->whereBetween($this->column, $value);
        }

        return $query->where($this->column, $value);
    }

    public function key()
    {
        return 'slider_for_' . $this->column;
    }
}
