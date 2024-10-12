# Installation

```bash
composer require medboubazine/moogold
```


# How it  works

```php
$user_id = "";
$partner_id = "";
$secret_key = "";

//
// Credentials
//
$credentials = new Credentials($user_id, $partner_id, $secret_key);
//
// Main instance
//
$moogold =  new Moogold($credentials);

$user = $moogold->user();
$products = $moogold->products();
$orders = $moogold->orders();

```

* User
   1. Balance

    ```php
    $user->balance();
    ```

* Products
    1. List

    ```php
        $products->list(int $categgory_id);
    ```

   2. Details

    ```php
        $products->details(int $product_id);
    ```

* Orders
    1. Create

    ```php
        $orders->create(int $type, string $external_id, string $offer_id, int $quantity);
    ```

    2. Details

    ```php
        $orders->details(int $id);
    ```

