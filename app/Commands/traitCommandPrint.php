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
}