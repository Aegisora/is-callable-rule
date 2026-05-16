# Aegisora Is Callable Rule

![Code Coverage Badge](./badge.svg)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
![PHPStan Badge](https://img.shields.io/badge/PHPStan-level%209-brightgreen.svg?style=flat)

Is Callable Rule provides a simple and strict **callable validation** for the Aegisora ecosystem.

The package is built on top of `aegisora/rule-contract` and follows its validation architecture, ensuring predictable and safe behavior.

---

## ✨ Features

- 🔹 Minimalistic implementation with no extra dependencies
- 🔹 Strict callable validation using PHP native `is_callable`
- 🔹 Supports anonymous functions (`Closure`)
- 🔹 Fully compatible with Aegisora validation pipeline
- 🔹 Clear `Context → Result` flow
- 🔹 No raw booleans — only structured `Result`
- 🔹 Safe execution via base `Rule` abstraction
- 🔹 Convenient static factory method (`create`)
- 🔹 Lightweight and predictable behavior

---

## 📦 Installation

```shell
composer require aegisora/is-callable-rule
```

---

## 🚀 Core Concept

This package performs callable validation:

- accepts a value via `Context`
- checks whether the value is callable
- returns a standardized `Result`

Supported values:

```php
function () {}
static function () {}
'trim'
[$object, 'method']
[SomeClass::class, 'method']
```

Unsupported values:

```php
null
true
123
'not_existing_function'
new stdClass()
```

---

## 🏗️ Basic Usage

### ✅ Validate callable value

```php
use Aegisora\Rules\IsCallableRule;
use Aegisora\RuleContract\Models\Context;

$result = IsCallableRule::create()->validate(
    Context::create(function () {
        return true;
    })
);

if ($result->isValid()) {
    // value is callable
} else {
    // value is not callable
}
```

### ❌ Invalid value example

```php
use Aegisora\Rules\IsCallableRule;
use Aegisora\RuleContract\Models\Context;

$result = IsCallableRule::create()->validate(
    Context::create('not-callable')
);

if ($result->isValid()) {
    // will not happen
} else {
    // validation failed
}
```

---

## ⚖️ License

This package is open-source and licensed under the MIT License. See the LICENSE for details.

---

## 🌱 Contributing

Contributions are welcome and greatly appreciated!. See the CONTRIBUTING for details.

---

## 🌟 Support

If you find this project useful, please consider giving it a star on GitHub!

It helps the project grow and motivates further development.
