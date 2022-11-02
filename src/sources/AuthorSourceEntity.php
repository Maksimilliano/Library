<?php
namespace Library\App\Sources;

class AuthorSourceEntity extends SourceEntity {
  public function __construct(\PDO $db_connection){
    parent :: __construct($db_connection);
      $this->type = 'authors';
  }
  public function get(){
      return $this->getFromSource();
  }

  public function getList() {
    $dig = $this->db_connection->prepare('SELECT * FROM authors ORDER BY id DESC');
    $dig->execute();
    return $dig->fetchAll();
    }



}













?>