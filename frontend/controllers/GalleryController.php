<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 *
 * @author Igor
 */
class GalleryController extends Controller
{
   public function actionIndex()
   {
       return $this->render('index');
   }
}
