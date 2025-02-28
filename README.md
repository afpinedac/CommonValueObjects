# CommonValueObjects

**CommonValueObjects** is a PHP package that provides a collection of reusable Value Objects for common data types, ensuring immutability, validation, and consistency in your applications.

---

## 📌 Installation

Install the package via Composer:

```bash
composer require afpinedac/common-value-objects
```

---

## 🚀 Features

- ✅ Immutable Value Objects for safer data handling.
- ✅ Strict Validation to prevent invalid values.
- ✅ PSR-4 Autoloading for seamless integration.
- ✅ Compatible with PHP 8+.

---

## 📂 Available Value Objects

| **Class**       | **Description**                              |
|------------------|----------------------------------------------|
| **Percentage**   | Represents a percentage value (e.g., 25%)   |
| **Latitude**     | Represents a valid latitude coordinate       |
| **Money**        | Handles monetary values with currency        |
| **EmailAddress** | Validates and encapsulates an email address  |
| **FullName**     | Stores and validates a person's full name    |

---

## 🛠 Usage

### Example: Using `Percentage`

```php
use Afpinedac\CommonValueObjects\ValueObjects\Numeric\Percentage;

$percentage = new Percentage(0.25);
echo $percentage->getFormatted(); // Output: 25.00%
```

### Example: Using `Latitude`

```php
use Afpinedac\CommonValueObjects\ValueObjects\Geographic\Latitude;

$latitude = new Latitude(40.7128);
echo $latitude; // Output: 40.7128
```

---

## ✅ Running Tests

This package uses **PestPHP** for testing. To run tests, use:

```bash
vendor/bin/pest
```

---

## 📜 License

This package is released under the **MIT License**.

---

## 🤝 Contributing

Contributions are welcome! Feel free to submit pull requests or open issues on GitHub.

---

## 📬 Contact

For questions or feature requests, contact **[Your Name]** at **your.email@example.com**.

---

🚀 Start using `CommonValueObjects` today to improve data consistency in your PHP projects!