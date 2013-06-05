Edifice - Laravel 4 From Builder
=======

A Laravel 4 form builder package inspired from formtastic and using Foundation CSS framework.


Setup
=======

In app.php Laravel confiuration file add this line to providers :
    'Lionart\Edifice\EdificeServiceProvider'

And the line below to aliases :
    'Edifice'     => 'Lionart\Edifice\Support\Facades\Edifice'

Load Foundation CSS files and JavaScript : http://foundation.zurb.com/docs/ & http://foundation.zurb.com/docs/javascript.html

Creating an input with a label
=======

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