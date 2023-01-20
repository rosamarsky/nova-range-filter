# Laravel Nova Range Filter 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rosamarsky/nova-range-filter)](https://packagist.org/packages/rosamarsky/nova-range-filter)
[![Total Downloads](https://img.shields.io/packagist/dt/rosamarsky/nova-range-filter)](https://packagist.org/packages/rosamarsky/nova-range-filter)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)


A Laravel Nova filter for picking range between a min/max value. 
This package based on [vue-slider-component](https://www.npmjs.com/package/vue-slider-component).

![RangeFilter](https://raw.githubusercontent.com/rosamarsky/nova-range-filter/master/resources/img/table-screen.png)

#  Requirements
 - `php`: `>=8.1`
 - `laravel/nova`: `^4.0`

# Installation

You can install the package via composer:

```
composer require rosamarsky/nova-range-filter
```

## Usage

Use it as usual on the filters methods within your resource class:

```php
use Rosamarsky\RangeFilter\RangeFilter;
use App\Models\Invoice as InvoiceModel;

class Invoice extends Resource
{
    public function filters(Request $request)
    {
        return [
            RangeFilter::make('Amount', 'amount', [
                'min' => floor(InvoiceModel::query()->min()),
                'max' => ceil(InvoiceModel::query()->max()),
                'interval' => 10,
            ]),
        ];
    }
}
```
> The interval value must be greater than 0 and can be divisible by (max - min).

You also can provide next options:
- `tooltip` - control tooltip display. Default `active`.
  - `none` - never display;
  - `always` - always display;
  - `hover` - display when the slider get hover;
  - `focus` - display when the slider has focus;
  - `active` - display when tooltip have both hover and focus.
- `minRange`, `maxRange` - minimum and maximum distance between sliders.
- `clickable` - allow changes to value by clicking. Default - `true`;
- `disabled` - enable/disable the component. Default - `true`;
- `label` - the postfix of displayed values for marks and tooltips.

## License

The MIT License (MIT). Please see [License File](https://raw.githubusercontent.com/rosamarsky/nova-range-filter/master/LICENSE) for more information.