<?php

namespace App\Commands;

use App\Models\ProductRepository;
use App\Models\ReviewRepository;
use App\Services\ProductReviewService;
use LaravelZero\Framework\Commands\Command;

class ReviewSummaryCommand extends Command
{
    use traitCommandPrint;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'review:summary';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Summary list of review';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Getting Data Summary list of product review.');
        
        $prodRepo = new ProductRepository();
        $reviewRepo = new ReviewRepository();

        $prodReviewservice = new ProductReviewService($prodRepo, $reviewRepo, "cacheid");
        /* $prodReviewservice->findByProduct(Product $product) */
        $productsReviews = $prodReviewservice->getReviewSummary();
        $isFromCached = $prodReviewservice->isFromCache();
        if ($isFromCached) {
            $this->info(">>>>>>>>>>> loading data from cache " );
        }
        foreach ($productsReviews as $key => $productReview) {
            $this->printProductReview($productReview);
        }
    }
}
