<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\User;

class ComputeChefRatings extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $chef;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $chef)
	{
		$this->chef = $chef;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$chef = $this->chef;
		$chefRatingsSum = 0;
		$nReviews = $chef->clientReviews->count();

		foreach ($chef->clientReviews as $clientReview)
		{
			$chefRatingsSum = $chefRatingsSum + $clientReview->chef_rating;
		}

        $chef->rating = $chefRatingsSum / $nReviews;
        $chef->save();
	}

}
