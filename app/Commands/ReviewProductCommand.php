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
        
        $prodRepo = new ProductRepository();
        $reviewRepo = new ReviewRepository();
        
        $prodReviewservice = new ProductReviewService($prodRepo, $reviewRepo, "cacheid");
        $productReview = $prodReviewservice->getProductReview($productId);

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

    public function OldHandle()
    {
        $productId = $this->argument('productId');
        $this->info('Getting Data Review of product #'.$productId);
        
        $prodRepo = new ProductRepository();
        $reviewRepo = new ReviewRepository();
        
        $prodReviewservice = new ProductReviewService($prodRepo, $reviewRepo, "cacheid");

        $productReview = $prodReviewservice->getProductReview($productId);
        $isFromCached = $prodReviewservice->isFromCache();

        if ($isFromCached) {
            $this->info(">>>>>>>>>>> loading data from cache " );
        }

        $this->printProductReview($productReview);
        
    }

}
