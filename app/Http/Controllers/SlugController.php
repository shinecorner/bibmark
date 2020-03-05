<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slug;
use App\Models\Charity;
use App\Models\Sponsor;



class SlugController extends Controller
{
    /**
     * Get all of the donations for the charity.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request, Slug $slug)
    {        
        if($slug->slugable_type == 'App\Models\Sponsor'){     
            $sponsor = Sponsor::find($slug->slugable_id);
            if($sponsor){
                return view('front.index-sponsor', [
                    'sponsor' => $sponsor,
                ]);
            }
            else{
                abort(404);
            }      
        }
        elseif($slug->slugable_type == 'App\Models\Charity'){
            $charity = Charity::find($slug->slugable_id);
            if($charity){
                return view('front.index-charity', [
                    'charity' => $charity,
                ]);
            }
            else{
                abort(404);
            }
            
        }        
        else{
            abort(404);
        }
    }    
}
