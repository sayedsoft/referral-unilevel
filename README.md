# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sayedsoft/referral-unilevel.svg?style=flat-square)](https://packagist.org/packages/sayedsoft/referral-unilevel)
[![Total Downloads](https://img.shields.io/packagist/dt/sayedsoft/referral-unilevel.svg?style=flat-square)](https://packagist.org/packages/sayedsoft/referral-unilevel)
![GitHub Actions](https://github.com/sayedsoft/referral-unilevel/actions/workflows/main.yml/badge.svg)

Add referral system to user user table

## Installation

You can install the package via composer:

```bash
composer require sayedsoft/referral-unilevel
```

## Usage

```php
php artisan migrate
```



## To use it add code to your user model

```php
use Sayedsoft\ReferralUnilevel\Traits\Referral\UserReferral;


class User extends Authenticatable 
{
    use  UserReferral .... ;
```

## To set spondor any user 
```php
$sonpor_ref_code = 'ADMIN';
$user = User::find(1);
$user->initReferral('ADMIN');
```