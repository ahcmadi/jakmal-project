<?php

namespace App\Models;

use App\Services\Review;

interface ProductBluePrint {
    // public function someMethod1();
    // public function someMethod2($name, $color);
    // public function someMethod3() : string;
  }

class ZeProduct  implements ProductBluePrint
{

  protected static Product $instance ;
  protected $list_products = [];

  protected bool $whare_house = false;
  
  protected int $id ;
  protected string $name ;
  protected int $price ;
  protected array $reviews = [] ;

  public function __construct( bool $whare_house = false, int $id = 0,string $name = "where_house", int $price = 0)
  {
    $this->whare_house = $whare_house;
    $this->id = $id;
    $this->name = $name;
    $this->name = $name;
  }

  // public static function InitProducts($rows = [])
  // {
  //   Product::$instance = Product::$instance ?? new Product(true);
  //   foreach ($rows as $key => $row) {
  //     Product::$instance->list_products[] = new Product(false, $row["id"], $row["name"], $row["price"] );
  //   }
  // } 

  // public function setReviews($data = [])
  // {
  //   foreach ($data as $key => $value) {
  //     $this->makeReview($value);
  //   }
  // }
  // public function makeReview($row = [])
  // {
    
  // }

}

