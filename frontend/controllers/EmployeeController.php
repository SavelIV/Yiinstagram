<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Employee;

class EmployeeController extends Controller
{
    public function actionIndex()
    {
        $employee1 = new Employee();
        $employee1->firstName = 'Alex';
        $employee1->lastName = 'Smith';
        $employee1->middleName = 'John';
        $employee1->salary = 1000;
        
        echo $employee1['salary'];

        echo '<hr>';
        
        foreach ($employee1 as $attribute => $value){
            echo "$attribute: $value <br>";
        }
    }
    
    /*
     * Employee register example 
     */
    public function actionRegister()
    {
        $model = new Employee();
        $model ->scenario = Employee::SCENARIO_EMPLOYEE_REGISTER;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Registered!');
            return $this->refresh();
        }
        return $this->render('register',[
            'model' => $model,
        ]);
    }
    
    /*
     * Employee details update example
     */
    public function actionUpdate($id)
    {
        $model = Employee::findOne($id);
        $model->scenario = Employee::SCENARIO_EMPLOYEE_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                Yii::$app->session->setFlash('success', 'Updated!');
        }
        return $this->render('update', [
                    'model' => $model,
        ]);

    }

}
