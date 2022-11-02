<?php
namespace Library\App\Sources;
class GenreSourceEntity extends SourceEntity {
  public function __construct(\PDO $db_connection){
    parent :: __construct($db_connection);
      $this->type = 'genres';
  }

  public function get(){
      return $this->getFromSource();
  }

  public function getList() {
    $dig = $this->db_connection->prepare('SELECT * FROM genres ORDER BY id DESC');
    $dig->execute();
    return $dig->fetchAll();
    }


}

?>