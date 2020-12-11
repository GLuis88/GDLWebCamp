<?php 
    require 'paypal/autoload.php';

    define('URL_SITIO', 'http://localhost/Proyecto');

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AUsBxpicgVOi78s1_34who0jYzSv2mojr6yNubV73tlv5wPfIHLpKPNE7W-N2CnHpUis50SNW1PsqJJM',
            'EDew2_wrUSl7cAh7E__UZT2TMny6CtEfQaNNt2NA8ddiC2gFaR7XS5W3wbkgA26D2udsrXIUihGLaTs2'
        )
    );
?>