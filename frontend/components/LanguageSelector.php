<?php

namespace frontend\components;

use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{

    public $supportedLanguages = ['en-US', 'ru-RU'];

    /**
     * Load current language based on given cookie if any
     * @param yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $cookieLanguage = $app->request->cookies['language'];
        if (isset($cookieLanguage) && in_array($cookieLanguage, $this->supportedLanguages)) {
            $app->language = $app->request->cookies['language'];
        }
    }

}
