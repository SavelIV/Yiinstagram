<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * File storage component
 *
 * @author admin
 */
class Storage extends Component implements StorageInterface
{

    private $fileName;

    /**
     * Save given UploadedFile instance to disk
     * @param UploadedFile $file
     * @return string|null
     */
    public function saveUploadedFile(UploadedFile $file)
    {
        $path = $this->preparePath($file);

        if ($path && $file->saveAs($path)) {
            return $this->fileName;
        }
    }

    /**
     * Prepare path to save uploaded file
     * @param UploadedFile $file
     * @return string|null
     */
    protected function preparePath(UploadedFile $file)
    {
        $this->fileName = $this->getFileName($file);  
        //     0c/a9/277f91e40054767f69afeb0426711ca0fddd.jpg

        $path = $this->getStoragePath() . $this->fileName;  
        //     /var/www/project/frontend/web/uploads/0c/a9/277f91e40054767f69afeb0426711ca0fddd.jpg

        $path = FileHelper::normalizePath($path);
        if (FileHelper::createDirectory(dirname($path))) {
            return $path;
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function getFilename(UploadedFile $file)
    {
        // $file->tempname   -   /tmp/qio93kf

        $hash = sha1_file($file->tempName); // 0ca9277f91e40054767f69afeb0426711ca0fddd
        
        $name = substr_replace($hash, '/', 2, 0);
        $name = substr_replace($name, '/', 5, 0);  // 0c/a9/277f91e40054767f69afeb0426711ca0fddd
        return $name . '.' . $file->extension;  // 0c/a9/277f91e40054767f69afeb0426711ca0fddd.jpg
    }

    /**
     * @return string
     */
    protected function getStoragePath()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']);
    }

    /**
     * @param string $filename
     * @return string
     */
    public function getFile(string $filename)
    {
        return Yii::$app->params['storageUri'].$filename;
    }

    /**
     * Delete picture from disc.
     * @param string $filename
     * @return bool
     */
    public function deleteFile(string $filename)
    {
        $deletedFile = FileHelper::normalizePath($this->getStoragePath() . $filename);
        if (file_exists($deletedFile)) {

            unlink($deletedFile);

            if ($this->isDirEmpty(dirname($deletedFile))) {
                rmdir(dirname($deletedFile));
                if ($this->isDirEmpty(dirname($deletedFile, 2))) {
                    rmdir(dirname($deletedFile, 2));
                }
            }
            return true;
        }
        return true;
    }

    /**
     * Check if a directory is empty
     *
     * @param string $dirname
     * @return bool
     */
    function isDirEmpty($dirname)
    {
        foreach (scandir($dirname) as $file) {
            if (!in_array($file, array('.', '..'))) return false;
        }
        return true;
    }

}
