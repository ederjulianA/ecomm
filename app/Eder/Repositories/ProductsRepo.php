<?php namespace Eder\Repositories;

use Eder\Entities\Product;

 class ProductsRepo extends BaseRepo {

 	public function getModel()
    {
        return new Product;
    }


 	public function  getProIndex()
 	{
 		return Product::take(4)->orderBy('created_at', 'DESC')->get();
 	}


 }