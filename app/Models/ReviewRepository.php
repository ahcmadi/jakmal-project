<?php
namespace App\Models;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ReviewRepository  implements RepositoryInterface
{
    
    public function findByProduct(Product $product) : Product
    {
        $reviewRows = DB::table('review')->where('product_id',$product->getId())->get();
        $reviews = $this->buildReviews($reviewRows);
        $product->setReviews($reviews);
        return $product;
    }

    public function findByProducts(Array $products) : array
    {
      return [];
    }
    

    public function findById($id): Review
    {
        $reviewRow = DB::table('review')->find($id);
        return $this->buildReview($reviewRow);
    }
    
    public function getAll() : Array
    {
        // $result = [];
        $reviewRows = DB::table('review')->get();
        return $this->buildReviews($reviewRows);
        // foreach ($reviewRows as $key => $reviewRow) {
        //     $result[$key] = $this->buildReview($reviewRow);
        // }
        // return $result;
    }

    public function buildReviews($reviewRows): array
    {
      $result = [];
      foreach ($reviewRows as $key => $reviewRow) {
          $result[$key] = $this->buildReview($reviewRow);
      }
      return $result;
    }

    public function buildReview($reviewRow):Review
    {
        $result = new Review(0,0);

        if (!is_null($reviewRow)) {
            
            $result->SetId($reviewRow->id);
            $result->setProductId($reviewRow->product_id);
            $result->setRating($reviewRow->rating);
        }

        return $result;
        
    }
}

