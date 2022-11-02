<?php
namespace Library\App\Sources;

class BookSourceEntity extends SourceEntity {
  public function __construct(\PDO $db_connection){
    parent :: __construct($db_connection);
       $this->type = 'books';
   }
   public function get(){
       return $this->getFromSource();
   }

   public function getList() {
    $dig = $this->db_connection->prepare('SELECT * FROM books ORDER BY id DESC');
    $dig->execute();
    return $dig->fetchAll();
    }


}

?>