<?php
namespace App\Models;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository  implements RepositoryInterface
{

    public function findById($id): Product
    {
        
        $productRow = DB::table('product')->find($id);
        return $this->buildProduct($productRow);
        
    }
    
    public function getAll() : Array
    {
        $result = [];
        $productRows = DB::table('product')->get();
        foreach ($productRows as $key => $productRow) {
            $result[$key] = $this->buildProduct($productRow); 
        }
        return $result;
    }

    public function buildProduct($productRow):Product
    {
        $result = new Product();

        if (!is_null($productRow)) {
            
            $result->SetId($productRow->id); 
            $result->SetName($productRow->name); 
            $result->SetPrice($productRow->price); 
        }

        return $result;
        
    }

}

