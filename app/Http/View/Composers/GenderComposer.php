<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Repositories\UserRepository;

class GenderComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $choice = array();
        $data = [
            "key" => "0",
            "value" => "--- Select One ---"
        ];
        $data2 = [
            "key" => "male",
            "value" => "Male"
        ];
        $data3 = [
            "key" => "female",
            "value" => "Female"
        ];
        array_push($choice,$data);
        array_push($choice,$data2);
        array_push($choice,$data3);
        $view->with('genders', $choice);
    }
}