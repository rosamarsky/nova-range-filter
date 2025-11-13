# Laravel Nova Range Filter 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rosamarsky/nova-range-filter)](https://packagist.org/packages/rosamarsky/nova-range-filter)
[![Total Downloads](https://img.shields.io/packagist/dt/rosamarsky/nova-range-filter)](https://packagist.org/packages/rosamarsky/nova-range-filter)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

A clean and simple **Laravel Nova filter** for selecting values between a minimum and maximum range.  
Built on top of [vue-slider-component](https://www.npmjs.com/package/vue-slider-component).

![RangeFilter](https://raw.githubusercontent.com/rosamarsky/nova-range-filter/master/resources/img/table-screen.png)

---

## ⚙️ Requirements
 - `php`: `>=8.0`
 - `laravel/nova`: `^4.0|^5.0`

---

## 📦 Installation

```bash
composer require rosamarsky/nova-range-filter
```

---

## 🚀 Usage

Register it inside your Nova resource as usual:

```php
use Rosamarsky\RangeFilter\RangeFilter;
use App\Models\Invoice;

class Invoice extends Resource
{
    public function filters(Request $request): array
    {
        return [
            RangeFilter::make('Amount', 'amount', [
                'min' => floor(Invoice::query()->min('amount')),
                'max' => ceil(Invoice::query()->max('amount')),
                'interval' => 10,
            ]),
        ];
    }
}
```
> ⚠️ The interval value must be greater than 0 and divide evenly into (max - min).

---

## 🧱 Available Options

| Option        | Description                                                        | Default   |
|---------------|--------------------------------------------------------------------|-----------|
| `tooltip`     | Tooltip display mode: `none`, `always`, `hover`, `focus`, `active` | `active`  |
| `minRange`    | Minimum distance between handles                                   | —         |
| `maxRange`    | Maximum distance between handles                                   | —         |
| `clickable`   | Allow changes by clicking on the slider                            | `true`    |
| `disabled`    | Disable the component                                              | `false`   |
| `label`       | Value postfix (e.g. `%`, `$`, `kg`)                                | —         |

---

## 📜 License

This package is open-sourced software licensed under the [MIT License](https://raw.githubusercontent.com/rosamarsky/nova-range-filter/master/LICENSE).