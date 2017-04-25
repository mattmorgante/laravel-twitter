# Tweet Reach
This application calculates the reach of a given Tweet. If the tweet's reach has already been calculated within the last two hours, the app will retrieve the reach from the database instead of calling the Twitter API.

Although the application works, it has a few limitations that, given more time, I would like to improve upon:
* For tweets with more than 100 retweets, we can only get the first 100 users that retweeted it. This is due to the package used, thujohn-twitter. In the getRters function, calls to the Twitter API are limited to the first 100 user IDs.
* If a user retweets a tweet but has more than 5000 followers, only the first 5000 followers are retrieved. This is also due to a limitation with the package, specifically the getFollowersIds function
* At times, the Twitter API's rate limit can be reached due to too many calls, especially when retrieving a tweet with a large number of retweeters.