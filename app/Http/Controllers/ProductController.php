<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Product;
use App\Product_detail;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index($id){
        $categories = Category::where('parent_id', 0)->get();
        $product = Product::findOrFail($id);
        $thumbnails = Photo::where('product_id', $id)->where('is_cover', 0)->orderBy('id', 'desc')->take(4)->get();
        $category_of_product = $product->categories->pluck('id');
//        $related_products = Product::whereHas('categories', function($query) use($product, $category_of_product) {
//            $query->whereIn('categories.id', $category_of_product)->where('products.id', '<>', $product->id);
//        })->get();
        $reviews = Review::where('product_id', $id)->paginate(4);
        $review_qty = count($product->reviews);
        $query = DB::table('reviews')->select('reviews.rating', 'users.name', 'products.name AS product_name')
            ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
            ->leftJoin('products', 'products.id', '=', 'reviews.product_id')
            ->get();
        $collection = collect($query);
        $grouped = $collection->groupBy('name');
        $array = $grouped->toArray();
        $newArray = json_decode(json_encode($array), True);
        $new = [];
        $r = [];
        foreach($newArray as $key => $item){
            foreach($item as $a => $b){
                $newElement = $b['product_name'];
                $r[$newElement] = $b['rating'];
            }
            $new[$key] = $r;
            unset($r);
        }
        //echo $this->sim_pearson($new, 'Willard Brakus', 'Admin');
        //var_dump($this->get_recommendations($new, 'Admin'));
        $item_sim = $this->calculate_similar_items($new);
        //var_dump($this->get_recommended_items($new, $item_sim, Auth::user()->name));
//        var_dump($new);
//        var_dump($this->get_recommendations($new, Auth::user()->name));
        $books = $this->transform_prefs($new);
        //var_dump($this->top_matches($books, $product->name, 8));
        //var_dump(array_values($recommendations));
        $recommendations = [];
        if(Auth::check())
            $recommendations = $this->get_recommendations($new, Auth::user()->name);
        if(count($recommendations) != 0) {
            $related_products = Product::whereIn('name', array_keys($recommendations))->where('id', '<>', $product->id)->get();
//            foreach($recommendations as $key => $values){
//                $values = 'zz';
//                $related_products->map(function ($related_product, $values) {
//                    $related_product['recommend_value'] = $values;
//                    return $related_product;
//                });
//            }
        }
        else{
            $related_products = Product::whereHas('categories', function($query) use($product, $category_of_product) {
                $query->whereIn('categories.id', $category_of_product)->where('products.id', '<>', $product->id);
            })->get();
        }
        dd($related_products);
        return view('product', compact( 'categories', 'product', 'related_products', 'thumbnails', 'reviews', 'review_qty', 'avg_rating'));
    }
    private function sim_pearson($prefs,$person1,$person2) {
        //Get the list of shared movies between 2 persons
        $shared_items = array();
        foreach ($prefs[$person1] as $movie_person1 => $rating) {
            foreach ($prefs[$person2] as $movie_person2 => $rating) {
                if ($movie_person1 == $movie_person2) {
                    $shared_items[$movie_person1] = 1;
                }
            }
        }
        //Find the number of elements
        $n = count($shared_items);
        //Check if they have any shared items
        if ($n == 0) {
            $pearson_correlation = 0;
        }
        //Calculate the Pearson Correlation
        else {

            $sum1 = 0;
            $sum2 = 0;
            $sum1Sq = 0;
            $sum2Sq = 0;
            $pSum = 0;
            foreach($shared_items as $movie => $shared) {
                //Add up all the preferences
                $sum1 += $prefs[$person1][$movie];
                $sum2 += $prefs[$person2][$movie];

                //Sum up the squares
                $sum1Sq += pow($prefs[$person1][$movie],2);
                $sum2Sq += pow($prefs[$person2][$movie],2);

                //Sum up the products
                $pSum += $prefs[$person1][$movie] * $prefs[$person2][$movie];
            }
            //Calculate Pearson score
            $num = $pSum - (($sum1 * $sum2) / $n);
            $den = sqrt(($sum1Sq - (pow($sum1,2)/$n)) * ($sum2Sq - (pow($sum2,2)/$n)));

            //Avoid division by 0
            if ($den == 0) {
                $pearson_correlation = 0;
            }
            else {
                $pearson_correlation = $num/$den;
            }

        }

        return $pearson_correlation;
    }

    private function get_recommendations($prefs,$person) {
        //Create an array that holds the Total and SimSum for each movie
        $calc_array = array();
        //Loop through all person in the array
        foreach ($prefs as $other_person => $movies) {
            //Calculate the similarity score
            $sim = $this->sim_pearson($prefs, $person, $other_person);

            //Dont compare to yourself and ignore scores <= 0
            if ($person == $other_person || $sim <= 0) {
                continue;
            }

            //Loop though all the movies of the current critic
            foreach ($movies as $movie => $rating) {
                //Only score movies the person hasn't seen yet
                if (!array_key_exists($movie, $prefs[$person])) {

                    //Add the movie to the array if it doesn't exists already in the array
                    if (!array_key_exists($movie, $calc_array)) {
                        $calc_array[$movie] = array();
                        //Add default values
                        $calc_array[$movie]['Total'] = 0;
                        $calc_array[$movie]['SimSum'] = 0;
                    }

                    //Similarity * movie rating
                    $calc_array[$movie]['Total'] += $sim * $rating;
                    //Add to the total similarity
                    $calc_array[$movie]['SimSum'] += $sim;

                }
            }
        }
        //echo '<pre>', print_r($calc_array) ,'</pre>';

        //Create the normalized list
        $recommendations = array();
        foreach ($calc_array as $movies => $values) {
            $recommendations[$movies] = $calc_array[$movies]['Total']/$calc_array[$movies]['SimSum'];
        }

        //Sort the array so the highest score at the top
        asort($recommendations);
        $recommendations = array_reverse($recommendations);

        return $recommendations;
    }
    private function sim_euclidean($prefs,$person1,$person2) {
        //Get the list of shared movies between 2 persons
        $shared_items = array();
        foreach ($prefs[$person1] as $movie_person1 => $rating) {
            foreach ($prefs[$person2] as $movie_person2 => $rating) {
                if ($movie_person1 == $movie_person2) {
                    $shared_items[$movie_person1] = 1;
                }
            }
        }
        //Check if they have any shared items
        if (count($shared_items) == 0) {
            $euclidean_distance = 0;
        }
        //Calculate the Euclidean Distance
        else {
            //Add up the squares of all the differences
            $sum_of_squares = 0;
            foreach($shared_items as $movie => $shared) {
                $sum_of_squares += pow($prefs[$person1][$movie]-$prefs[$person2][$movie],2);
            }

            $euclidean_distance = 1/(1 + sqrt($sum_of_squares)); // sqrt is not in the book, but in the errata online
        }

        return $euclidean_distance;
    }
    private function top_matches($prefs,$person,$n,$sim_score='sim_pearson') {
        //Calculate the different Pearson Correlations and add them to an array
        $scores_array = array();
        foreach ($prefs as $other_person => $movies) {
            if ($person != $other_person) {
                $scores_array[$other_person] = $this->sim_pearson($prefs,$person,$other_person);
            }
        }

        //Sort the array so the highest score at the top
        asort($scores_array);
        $scores_array = array_reverse($scores_array);
        $scores_array = array_slice($scores_array,0,$n);

        return $scores_array;

    }
    private function transform_prefs($prefs) {
        $result = array();
        foreach ($prefs as $critic => $movies) {
            foreach ($movies as $movie => $rating) {
                //Add the movie to the array if it doesn't exists already in the array
                if (!array_key_exists($movie, $result)) {
                    $result[$movie] = array();
                }
                $result[$movie][$critic] = $rating;
            }
        }

        return $result;
    }
    private function calculate_similar_items($prefs,$n=10) {
        //Create a dictionary of items showing which other items they are most similar to
        $result = array();

        //Invert the preference matrix to be item-centric
        $item_prefs = $this->transform_prefs($prefs);

        $c = 0;

        foreach ($item_prefs as $item => $stuff) {
            //Status updated for large datasets
            $c += 1;
            if ($c % 100 == 0) {
                echo 'Still alive!';
            }
            //Find most similar items to this one
            $scores = $this->top_matches($item_prefs,$item,$n,'sim_euclidean');
            $result[$item] = $scores;
        }

        return $result;
    }
    private function get_recommended_items($prefs,$item_match,$user) {
        $user_ratings = $prefs[$user];
        //Create an array that holds the Total and SimSum for each movie
        $calc_array = array();

        //Loop over items (movies) rated by the user
        foreach ($user_ratings as $movie => $rating) {

            //Loop over movies similar to this movie
            foreach ($item_match[$movie] as $movie_sim => $rating_sim) {

                //Ignore if this user has already rated this item
                if (array_key_exists($movie_sim, $prefs[$user])) {
                    continue;
                }

                //Add the movie to the array if it doesn't exists already in the array
                if (!array_key_exists($movie_sim, $calc_array)) {
                    $calc_array[$movie_sim] = array();
                    //Add default values
                    $calc_array[$movie_sim]['Total'] = 0;
                    $calc_array[$movie_sim]['SimSum'] = 0;
                }

                //Similarity * movie rating
                $calc_array[$movie_sim]['Total'] += $rating * $rating_sim;
                //Add to the total similarity
                $calc_array[$movie_sim]['SimSum'] += $rating_sim;

            }
        }

        //Create the normalized list
        $recommendations = array();
        foreach ($calc_array as $movies => $values) {
            $recommendations[$movies] = $calc_array[$movies]['Total']/$calc_array[$movies]['SimSum'];
        }

        //Sort the array
        asort($recommendations);
        $recommendations = array_reverse($recommendations);

        return $recommendations;

    }
}
