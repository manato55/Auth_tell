<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Draft;
use Illuminate\Support\Facades\Auth; 


class HomeComposer
{
  
  public function compose(View $view) {
    
        $belonging = Auth::User()->dep.Auth::User()->sec.Auth::User()->team."\t".Auth::User()->name;
  
        $view->with('belonging',$belonging);
    
  }

}