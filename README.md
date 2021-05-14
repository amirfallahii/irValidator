
# Iranian Validator

A PHP Class for validate some Iranian values.

- National Code (کد ملی)
- National Id (شناسه ملی اشخاص حقوقی)
- Debit Card (شماره کارت بانکی)
- IBAN (شماره شبا)
- Postal Code (کد پستی)


## Usage/Examples

```php
require_once('IrValidator.php');
$validator = new IrValidator();
```

### Rules ###
- `nationalCode`

اعتبارسنجی کد ملی [(منبع)](http://www.aliarash.com/article/codemeli/codemeli.htm)
```php
$validator->nationalCode('');
```

- `nationalId`

اعتبارسنجی شناسه ملی اشخاص حقوقي [(منبع)](http://www.aliarash.com/article/shenasameli/shenasa_meli.htm)
```php
$validator->nationalId('');
```

- `debitCard`

اعتبارسنجی شماره کارت بانکی [(منبع)](http://www.aliarash.com/article/creditcart/credit-debit-cart.htm)
```php
$validator->debitCard('');
```

- `iban`

اعتبارسنجی شماره شبا بانکی [(منبع)](http://www.eshaghkousali.blogfa.com/post/46)
```php
$validator->iban('');
```

- `postalCode`

اعتبارسنجی کد پستی

```php
$validator->postalCode('');
```
## License

All contents of this package are licensed under the [MIT license.](https://choosealicense.com/licenses/mit/)