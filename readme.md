# CEP Grátis
[![Build Status](https://travis-ci.org/MasterkeyInformatica/busca-cep.svg?branch=master)](https://travis-ci.org/MasterkeyInformatica/busca-cep)

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

Este pacote foi fortemente influenciado por [CepGratis](https://github.com/jansenfelipe/cep-gratis)
