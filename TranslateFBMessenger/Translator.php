
<?php
require 'vendor/autoload.php';
use Stichoza\GoogleTranslate\TranslateClient;

$tr = null; // new TranslateClient('en', 'ka');
class Translator {
    var $name;
    function __construct($fromLanguage,$toLanguage) {
        $this->tr = new TranslateClient($fromLanguage,$toLanguage);
        $this->tr->setUrlBase('http://translate.google.cn/translate_a/single');
        /*
            $tr = new TranslateClient(); // Default is from 'auto' to 'en'
            $tr->setSource('en'); // Translate from English
            $tr->setTarget('ka'); // Translate to Georgian
            $tr->setUrlBase('http://translate.google.cn/translate_a/single');
        */
    }
    function Translate($text){
        return $this->tr->translate('Hello World!');

    }
}

$translate = new Translator("en","ja");
echo $translate->translate("how are you?");