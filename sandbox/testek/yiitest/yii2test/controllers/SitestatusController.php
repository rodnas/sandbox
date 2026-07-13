<?php

namespace app\controllers;

use Yii;
use app\models\Country;
use app\models\CountrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class SitestatusController extends Controller
{
    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        $siteStatus = \Yii::$app;
        $siteStatus->db->password = "xxxxxxxx";
        $counter = 0;
        $log = \Yii::$app->log;

//        $counter = $this->listSiteStatus($log,$counter);
//  die();
        return $this->render('index', [
            'siteStatus' => $siteStatus,
        ]);
    }

    public function listSiteStatus($listStatusArray,$counter) {
        echo "---- új Szint ----<br>";
        foreach ($listStatusArray as $key => $value){
            if (is_object($key) || is_object($value)) {
//                echo "$key : $value<br>";
echo "object<br>";
               $counter = $this->listSiteStatus($value,$counter);
            } else if (is_array($value) || is_array($value)) {
//                echo "$key : $value<br>";
echo "array<br>";
                $counter = $this->listSiteStatus($value,$counter);
            } else {
                echo "$key : $value<br>";
            }
            if ($counter > 1000) {
                exit;
            }
            echo 'Counter: '.$counter.'<br>';
            $counter++;
        }
        return $counter;
    }

}
