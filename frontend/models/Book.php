<?php


namespace frontend\models;
use Yii;
use yii\db\ActiveRecord;

/**
 *
 * @author Igor
 */
class Book extends ActiveRecord
{
  public static function tableName()
  {
    return '{{book}}'; 
  }
  
  
  public function rules()
  {
    return [
        [['name', 'publisher_id', 'isbn'], 'required'],
        [['date_published'], 'date', 'format' => 'php:Y-m-d'],
    ]; 
  }
  
  
  public function getDatePublished()
  {
    return ($this->date_published) ? Yii::$app->formatter->asDate($this->date_published) : "Дата не указана.";
  }
  
  public function getPublisher()
  {
    return $this->hasOne(Publisher::className(), ['id' => 'publisher_id'])->one(); 
  }
  
  public function getPublisherName()
  {
            if ($publisher = $this->getPublisher()) {
                return $publisher->name;
            } 
            return "не указан.";
  }
  
  public function getBookToAuthorRelations() 
  {
        return $this->hasMany(BookToAuthor::className(), ['book_id' => 'id']);
  }

  public function getAuthors() 
  {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])->via('bookToAuthorRelations')->all();
  }
  
 

}
