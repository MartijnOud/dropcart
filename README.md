# Dropcart V1
## THIS VERSION IS DEPRECATED

**Please check the website [Dropcart](https://dropcart.nl) or our new and improved version 3 on [GitHub](https://github.com/dropcart/webshop-frontend)**

---------

## What?
Dropcart is a new ecommerce platform. Dropcart is perfect for dropshipment: no need to carry your own product stock and instead focus on attracting new customers. Dropcart focuses on smart, automatic, API integrations and an easy to use system. Stock, prices and product descriptions are all read from an API and are easily customizable. New orders are automatically send to the supplier for further processing.

## Why?
Setting up a dropshipment store is very cumbersome. It requires coding knowledge for implementing an awkward XML feed, new orders need to manually be placed and product specifications are usually very limited. It gets even worse when you have more than one supplier. Dropcart hopes to fix this.

## How?
There is two sides to Dropcart; the shop owners and the suppliers. The code you are looking at right now is to connect with our API's — both reading and writing. We build these by reading feeds from the suppliers.

# Installation instructions
Download the latest *stable* release from [Github](https://github.com/dropcart/dropcart/releases).

## Requirements
(this list is incomplete)

- PHP Version: **5.3.+**
- PHP [cURL](http://php.net/manual/en/book.curl.php)
- MySQL (+ a way to import an SQL file)

## Integrations

Dropcart integrates with some third parties:

- Mollie Payment Provider (iDeal, Credit card etc)
- Postcode.nl postcode checker (will also complete address information)

## Installation
- Unzip the .zip file (or git pull)
- Create a new database and save the credentials
- Insert the database found in */_upgrade/database-initial-install.sql*
- Enter your database credentials in the file *includes/php/dc_connect.php*
- Upload everything to FTP server
    - You might need to set the folder `/images/logo` to file permission `777` so image uploading works properly
    - Check if the .htaccess is copied correctly, otherwise the website will not work
- Navigate to *yourwebsite.com/beheer* and login with username: *admin*, password: *inktweb*
- In the *Settings* menu add the required information (including your *api_key*)
- Navigate to *yourwebsite.com* and test if everything works

### Customization after installation
- In the CMS delete the default `admin` account and add your own
- In the CMS customize your emails / add logos
- Change the default images in the `/images` folder
- Setup a cronjob for `/cronjobs/dc_orderstatus.php`. This checks the order status from the supplier and updates the customer (e.g. if the order is shipped). Min: daily. Recommended: hourly.

