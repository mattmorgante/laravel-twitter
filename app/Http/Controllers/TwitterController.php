<?php

namespace App\Http\Controllers;

use App\Reach;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class TwitterController extends Controller
{

    public function start()
    {
        $input = Input::only('tweet');
        $tweetURL = $input['tweet'];
        $this->checkDuplication($tweetURL);
    }

    private function checkDuplication($tweetURL) {
        $twoHoursAgo = Carbon::now()->subHour(2);
        $existingReach = Reach::where('url', '=', $tweetURL)->orderBy('created_at', 'desc')->first();
        if (!is_null($existingReach) && ($existingReach->created_at->gt($twoHoursAgo))) {
            echo "the reach of this tweet is ".$existingReach->tweet_impact ." users -- retrieved from DB";
            die;
        } else {
            $this->calculateReach($tweetURL);
        }
    }

    private function calculateReach($tweetURL)
    {
        $userIds = $this->getUserIds($tweetURL);
        $reach = 0;
        foreach ($userIds as $user) {
            // get number of followers of this user
            $followers = \Twitter::getFollowersIds(['id' => $user]);
            // ToDo: use next cursor to get the next 5000 results, if necessary
            $userReach = count($followers->ids);
            $reach = $userReach + $reach;
        }
        $reach_of_tweet = new Reach();
        $reach_of_tweet->url = $tweetURL;
        $reach_of_tweet->tweet_impact = $reach;
        $reach_of_tweet->save();
        echo "the reach of this tweet is ".$reach ." users -- retrieved from Twitter";
        die;
    }

    private function getUserIds($tweetURL) {
        $tweetArray = explode('/status/', $tweetURL);
        $tweetId = (int)$tweetArray[1];

        $retweeters = \Twitter::getRters(['id' => $tweetId]);
        // ToDo: If more than 100 retweets, get the next set of retweeter ids
        return $retweeters->ids;
    }
}