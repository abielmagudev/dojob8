<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobProductUpdateRequest;
use App\Models\Job;

class JobProductController extends Controller
{
    public function __invoke(JobProductUpdateRequest $request, Job $job)
    {
        $products_id = $request->input('products', []);

        $products_id_count = count($products_id);

        if( $products_id_count ) {
            $job->products()->syncWithoutDetaching($products_id);
        } else {
            $job->products()->detach();
        }

        return redirect()->route('jobs.show', $job)->with('success', "<b>{$products_id_count}</b> products saved");
    }
}
