<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobProductAjaxController extends Controller
{
    public function __invoke(Job $job)
    {
        return $job->products;
        
        return $job->products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'measurement_unit' => $product->measurement_unit,
            ];
        });
    }
}
