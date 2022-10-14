<?php

namespace App\Commands;

use App\Models\ProductRepository;
use App\Models\ReviewRepository;
use App\Services\ProductReviewService;
use LaravelZero\Framework\Commands\Command;

class ReviewProductCommand extends Command
{
    use traitCommandPrint;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'review:product {productId : Id for product}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List review of product';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $productId = $this->argument('productId');
        $this->info('Getting Data Review of product #'.$productId);
        
        $prodRepo = new ProductRepository();
        $reviewRepo = new ReviewRepository();
        
        $prodReviewservice = new ProductReviewService($prodRepo, $reviewRepo, "cacheid");

        $productReview = $prodReviewservice->getProductReview($productId);
        // $this->info('Product Id'."#".$productReview->getId());
        // $this->info("Name \t: ".$productReview->getName()."\t Price \t: ".$productReview->getPrice() );
        // $aggregrate = $productReview->getAgragrate();
        // $this->info("Count \t: ".$aggregrate['count']."\t\t Avg\t: ".$aggregrate['avg'] );
        // $each_view = $aggregrate['count_each_review'];
        // foreach ($each_view as $view => $value) {
        //     $this->info("Rate #".$view." : ".$value['count']." rows" );
        // }
        $isFromCached = $prodReviewservice->isFromCache();
        if ($isFromCached) {
            $this->info(">>>>>>>>>>> loading data from cache " );
        }
        $this->printProductReview($productReview);
        
    }
}
