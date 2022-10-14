<?php

namespace App\Models;

class Review  
{
  protected int $id;
  protected int $product_id;
  protected int $rating;
  
  public function __construct(int $id, int $product_id, int $rating = 0)
  {
    $this->id = $id;
    $this->product_id = $product_id;
    $this->rating = $rating;
  }
  public function setId( int $value)
  {
    $this->id = $value;
  }
  public function setProductId( int $value)
  {
    $this->product_id = $value;
  }
  public function setRating( int $value)
  {
    $this->rating = $value;
  }
  public function getId():int
  {
    return $this->id;
  }
  public function getProductId():int
  {
    return $this->product_id;
  }
  public function getRating():int
  {
    return $this->rating;
  }
  public function ToArray(): array
  {
    return [
      'id'=>$this->id,
      'product_id'=>$this->product_id,
      'rating'=>$this->rating,
    ];
  }
}

