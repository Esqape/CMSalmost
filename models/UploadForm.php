<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    public $vidfile;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file','extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
            [['vidfile'], 'file','extensions' => 'mp4', 'mimeTypes' => 'video/mp4', 'maxSize' => 150 * 1024 *1024, 'tooBig' => 'Limit is 150MB'],

        ];
    }
}

?>

