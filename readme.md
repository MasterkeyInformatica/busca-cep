BuscaCep
====================
[![Build Status](https://travis-ci.org/MasterkeyInformatica/busca-cep.svg?branch=master)](https://travis-ci.org/MasterkeyInformatica/busca-cep)
[![Latest Stable Version](https://poser.pugx.org/masterkey/busca-cep/v/stable)](https://packagist.org/packages/masterkey/busca-cep)
[![Total Downloads](https://poser.pugx.org/masterkey/busca-cep/downloads)](https://packagist.org/packages/masterkey/busca-cep)
[![Latest Unstable Version](https://poser.pugx.org/masterkey/busca-cep/v/unstable)](https://packagist.org/packages/masterkey/busca-cep) [![License](https://poser.pugx.org/masterkey/busca-cep/license)](https://packagist.org/packages/masterkey/busca-cep)

Realiza busca de endereços no site dos correios utilizando um CEP

### Como utilizar

Adicione a library

```sh
$ composer require masterkey/busca-cep
```

Adicione o autoload.php do composer no seu arquivo PHP.

```php
require_once 'vendor/autoload.php';  
```

Agora basta chamar o metodo estático consultar($cep)

```php
$endereco = Masterkey\Cep\BuscaCep::consultar('31030080');
```

Inspiração
---------

Este pacote foi fortemente influenciado por [CepGratis](https://github.com/jansenfelipe/cep-gratis)
