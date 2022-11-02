<?php
namespace Library\App\Sources;
abstract class SourceEntity {
  protected \PDO $db_connection; 
   public function __construct(\PDO $db_connection){
    $this->db_connection = $db_connection;
   }
  protected function getFromSource () {
      $bigDataJSON = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/storage/{$this->type}.json");
      $bigData = json_decode($bigDataJSON, true);
      return $bigData;
  }
  public abstract function get();

  protected string $type;

   public abstract function getList();

  }

  





?>