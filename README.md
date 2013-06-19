Edifice - Laravel 4 From Builder
=======


A Laravel 4 form builder package inspired from formtastic and using Foundation CSS framework.

Edifice use Laravel Syntax with some addition. The learning curve is not painful. You use richer Laravel syntax.

[![Build Status](https://travis-ci.org/LionArt/edifice.png?branch=master)](https://travis-ci.org/LionArt/edifice)

Compatibility
-------------

Edifice is compatible with Laravel 4.0.x

Version 1.0 RoadMap
-------------------

- [x] Implement Foundation CSS 4 From components.
- [x] Implement input form types.
- [x] Implement HTML 5 inputs( color, date... )
- [ ] Implement checkbox list and radio list.
- [ ] Implement fieldset.
- [ ] Implement select.
- [ ] Add auto transltion feature.
- [x] Handle validation error display.
- [ ] Implement MetroUI CSS 0.95 From components.
- [ ] Implement Bootstrap CSS 2 From components.
- [ ] Implement CSS Horus 1 From components.
- [ ] Implement Responsable CSS 1 From components.
- [ ] Implement Skeleton CSS 1 From components.

Installation
------------

Install configuration file :

php artisan config:publish lionart/edifice

In app.php Laravel confiuration file add this line to providers :

```php
    'Lionart\Edifice\EdificeServiceProvider'
```

And the line below to aliases :

```php
    'Edifice' => 'Lionart\Edifice\Support\Facades\Edifice'
```

Do not forget to load Foundation CSS & JavaScript files:
http://foundation.zurb.com/docs/ & http://foundation.zurb.com/docs/javascript.html

Creating an input with a label
------------------------------

```php
Edifice::text('first_name',
              'John Doe',
              array('label' => array
                       (
                            // Custom Edifice properties
                           'text' => 'First Name',
                           'align' => 'left | right',
                           'inline' => 'true | false',
                           'error' => 'Error message'
                           // HTML Attributes
                           'class' = 'red...',
                           'id' => 'label_id'
                       )
                   )
              );
```
