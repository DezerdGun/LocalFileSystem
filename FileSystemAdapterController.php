<?php

namespace app\components;

use app\models\FileModel;

class FileSystemAdapterController extends Controller{
  public function actionIndex()
  {
    $model = new FileModel();

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      $path = '/admin/uploads/.../BankFileExample.jpg';
      $adapter = Yii::$app->filesystem->getAdapter();
      if ($model->upload($adapter, $path)) {
        //here file will be upload successfully
        return $this->render('success');
      }
    }

    return $this->render('index', ['model' => $model]);
  }




//  метод getAdapter()
// прикладного компонента filesystem для получения соответствующего объекта адаптера на основе настроенного параметра $fsType.
}

