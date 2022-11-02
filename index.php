<?php
require_once './vendor/autoload.php';
use Library\App\Sources\BookSourceEntity;
use Library\App\Sources\AuthorSourceEntity;
use Library\App\Sources\GenreSourceEntity;


// Исходные данные. Разрешено дополнять данными (новыми книгами)
/*$books = [
    [
        'id' => 1,
        'name' => 'Сияние',
        'author_id' => 1,
        'genre_id' => 1,
    ],
    [
        'id' => 2,
        'name' => 'Преступление и наказание',
        'author_id' => 2,
        'genre_id' => 2,
    ],
    [
        'id' => 3,
        'name' => 'Братство кольца',
        'author_id' => 3,
        'genre_id' => 3,

    ]


];

$authors = [
    [
        'id' => 1,
        'name' => 'Стивен Кинг',
    ],
    [
        'id' => 2,
        'name' => 'Ф. М. Достоевский',
    ],
    [
        'id' => 3,
        'name' => 'Джон Р.Р. Толкин',
    ]
];

$genres = [
    [
        'id' => 1,
        'name' => 'Ужасы'
    ],
    [
        'id' => 2,
        'name' => 'Классическая литература'
    ],
    [
        'id' => 3,
        'name' => 'Фэнтези'
    ]
];*/




/*
abstract class SourceEntity {
    protected function getFromSource () {
        $bigDataJSON = file_get_contents("sources/{$this->type}.json");
        $bigData = json_decode($bigDataJSON, true);
        return $bigData;
    }
    public abstract function get();

    protected string $type;
}

class BookSourceEntity extends SourceEntity {
   public function __construct(){
        $this->type = 'books';
    }
    public function get(){
        return $this->getFromSource();
    }
}

class AuthorSourceEntity extends SourceEntity {
    public function __construct(){
        $this->type = 'authors';
    }
    public function get(){
        return $this->getFromSource();
    }
}

class GenreSourceEntity extends SourceEntity {
    public function __construct(){
        $this->type = 'genres';
    }

    public function get(){
        return $this->getFromSource();
    }
}
*/



$servername = "localhost";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=$servername;dbname=lipdo", $username,$password);
    // Устанавливаем мод ошибки, мод исключения
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    

}catch(PDOException $e){
    echo $e->getMessage();
}




$bookSE = new BookSourceEntity($conn);
$books = $bookSE->getList();

$authorsSE = new AuthorSourceEntity($conn);
$authors = $authorsSE->getList();

$genresSE = new GenreSourceEntity($conn);
$genres = $genresSE->getList();

$conn = null;




// TODO: написать метод, который будет выдавать имена авторов для каждой книги, вместо id-шников
$getBookAuthor = function (array $book) use ($authors) {
    foreach ($authors as $author) {
        if ($author['id'] === $book['author_id']) {
            return $author['name'];
        }
    }
};
//  echo "$x = $val<br>";
// TODO: написать метод, который будет выдавать названия жанров для каждой книги, вместо id-шников
$getBookGenre = function (array $book) use ($genres) {
    foreach ($genres as $genre) {
        if ($genre['id'] === $book['author_id']) {
            return $genre['name'];
        }
    }
};


/*$books = array("Сияние",  "Преступление и наказание",  "Братство кольца");

$booksJSON = json_encode($books);
var_dump(json_decode($booksJSON));


$authors = array("Стивен Кинг", "Ф. М. Достоевский", "Джон Р.Р. Толкин");

$authorsJSON = json_encode($authors);
var_dump(json_decode($authorsJSON));


$genres = array("Ужасы", "Классическая литература", "Фэнтези");

$genresJSON = json_encode($genres);
var_dump(json_decode($genresJSON));

$booksJSON = '{ [0]=> string(12) "Сияние" [1]=> string(46) "Преступление и наказание" [2]=> string(29) "Братство кольца" }';
$booksArr = json_decode($booksJSON, true);
echo $booksArr[0];
echo $booksArr[1];
echo $booksArr[2];



*/










/*
CREATE TABLE authors (
  id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE genres (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE books (
  id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    author_id INT NULL,
    genre_id INT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (author_id) REFERENCES authors (id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres (id) ON DELETE CASCADE
);

*/
/*
echo "<pre>";
var_dump($books); die();
echo "</pre>";
*/
?>

<div>
    <ul>
        <?php foreach ($books as $book) : ?>
            <li id="book_<?= $book['id'] ?>">
                <div>Название книги: <?= $book['name'] ?></div>
                <div>Автор книги: <?= $getBookAuthor($book) ?></div>
                <div>Жанр книги: <?= $getBookGenre($book) ?></div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>