<?php 
namespace App\Commands;

use App\Models\Product;

trait traitCommandPrint {

    public function printProductReview(Product $productReview) {

        $this->info('Product Id'."#".$productReview->getId());
        $this->info("Name \t: ".$productReview->getName()."\t Price \t: ".$productReview->getPrice() );
        $aggregrate = $productReview->getAgragrate();
        $this->info("Count \t: ".$aggregrate['count']."\t\t Avg\t: ".$aggregrate['avg'] );
        $each_view = $aggregrate['count_each_review'];
        foreach ($each_view as $view => $value) {
            $this->info("Rate #".$view." : ".$value['count']." rows" );
        }
        
        $this->info(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>" );

    }
    public function printProductReviewAsJson(Product $productReview) {

        $aggregrate = $productReview->getAgragrate();
        $each_view = $aggregrate['count_each_review'];
        
        $result = [
            'total_reviews'=> $aggregrate['count'],
            'average_ratings'=> round($aggregrate['avg'], 1),
        ];
        foreach ($each_view as $view => $value) {
            $result[$view.'_star'] = $value['count'];
        }
        krsort($result);
        $this->info(collect($result)->toJson());

    }
}