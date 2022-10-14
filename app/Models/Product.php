<?php
namespace App\Models;

use App\Models\Review;

class Product  {

  protected int $id ;
  protected string $name ;
  protected int $price ;
  protected array $reviews = [] ;
  protected array $agragrate = [] ;

  public function __construct( int $id = 0,string $name = "", int $price = 0)
  {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
  }
  public function setId(int $value)
  {
    $this->id = $value;
  }
  public function setName(string $value)
  {
    $this->name = $value;
  }
  public function setPrice(int $value)
  {
    $this->price = $value;
  }
  public function setReviews(array $value)
  {
    $this->reviews = $value;
  }
  public function setAgragrate(array $value)
  {
    $this->agragrate= $value;
  }
  public function getId(): int
  {
    return $this->id;
  }
  public function getName(): string
  {
    return $this->name;
  }
  public function getPrice(): int
  {
    return $this->price;
  }
  public function getReviews(): array
  {
    return $this->reviews;
  }
  public function getAgragrate(): array
  {
    return $this->agragrate;
  }

  public function ToArray(): array
  {
    return [
      'id'=>$this->id,
      'name'=>$this->name,
      'price'=>$this->price,
      'reviews'=>$this->reviews,
    ];
  }

}

