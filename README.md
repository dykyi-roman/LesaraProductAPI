# LesaraProductAPI

For my API I took as a basis my [no-framework-skeleton](https://github.com/dykyi-roman/no-framework-skeleton).

This is code is not for copy-paste and use. I tried to show how to organize code which will be a separation to layer.

API has a two action:

- /product/create, which takes product inf and places corresponding product

- /product/list, which takes two parameters (string) - `from` and `to` with format (Y-m-d H:i:s) as an input and returns URL of CSV file stored on AWS S3 with set of next fields (sku, name, price_eur, created_at)

## In Feature
* Add swagger documentation

## Test coverage
 * PhpUnit
 
## Code Style 
 * Phan
 * Codesniffer

## Installation
 + Clone the project
 + run composer install

## Author
[Dykyi Roman](https://www.linkedin.com/in/roman-dykyi-43428543/), e-mail: [mr.dukuy@gmail.com](mailto:mr.dukuy@gmail.com)

## License
The source code of this project is licensed under the [MIT license](https://opensource.org/licenses/mit-license.php).
