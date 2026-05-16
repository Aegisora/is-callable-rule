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

## ⚖️ License

This package is open-source and licensed under the MIT License. See the LICENSE for details.

---

## 🌱 Contributing

Contributions are welcome and greatly appreciated!. See the CONTRIBUTING for details.

---

## 🌟 Support

If you find this project useful, please consider giving it a star on GitHub!

It helps the project grow and motivates further development.
