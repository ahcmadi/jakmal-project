<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductRepository;
use App\Models\ReviewRepository;
use Illuminate\Support\Facades\Cache;

class ProductReviewService
{
    protected ProductRepository $product_repo;
    protected ReviewRepository $review_repo;
    protected $cache;
    protected $trace_rows = false;
    protected $from_cache = false;

    public function __construct(ProductRepository $product_repo, ReviewRepository $review_repo, $cache)
    {
        $this->product_repo = $product_repo;
        $this->review_repo = $review_repo;
        $this->cache = $cache;
    }
    public function isFromCache():bool
    {
        return $this->from_cache;
    }
    public function setTraceRow(bool $yes = true)
    {
        $this->trace_rows = $yes;
        return $this;
    }

    public function getProduct():Product
    {
            return new Product(0,0);
    }

    public function getReviewSummary():array
    {
        $products = $this->product_repo->getAll();
        $result = $this->calculateProductsReview($products);
        return $result;
    }

    public function getProductReview(int $id):Product
    {
        $product = $this->product_repo->findById($id);
        $productReview = $this->review_repo->findByProduct($product);
        return $this->calculateProductReview($productReview);

    }

    private function calculateProductsReview(array $products ):array
    {
        $results = [];
        foreach ($products as $key => $product) {
            $results[$key] = $this->calculateProductReview( $product);
        }
        return $results;
    }

    protected function calculateProductReview(Product $product): Product
    {
        $cached = Cache::get($product->getId());
        if (!is_null($cached)) {
            $this->from_cache = true;
            return $cached;
        }
        $this->getReviewsOfproduct($product);
        $reviewsProduct = $product->getReviews();

        $review_value = array_map(function ($d)
        {
            return $d->getRating();
        }, $reviewsProduct);

         $product->setAgragrate(
            [
                "count"=> count($product->getReviews()),
                "avg"=> $this->getAvg($review_value),
                "count_each_review"=> $this->getCountEachView($reviewsProduct),
            ]
         );
        Cache::put($product->getId(), $product);
         return $product;
    }

    protected function getReviewsOfproduct(Product $product) : Product
    {
        return $this->review_repo->findByProduct($product);
    }

    protected function getAvg($review_value)
    {
        return round(array_sum($review_value)/count($review_value), 2, PHP_ROUND_HALF_EVEN );
    }

    public function getCountEachView($reviewsProduct)
    {
        $result = [];
        foreach ($reviewsProduct as $key => $review) {
            if (!isset($result[$review->getRating()])) {
                $result[$review->getRating()] = [
                    "count"=>0,
                    "rows"=> []
                ];
            }
            $result[$review->getRating()]["count"] = $result[$review->getRating()]["count"]+1;
            if ($this->trace_rows) {
                $result[$review->getRating()]["rows"][] =$review;
            }
        }

        return $result;
    }

}
