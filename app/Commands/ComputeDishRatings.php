<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\Order;

class ComputeDishRatings extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $order;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Order $order)
	{
		$this->order = $order;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$order = $this->order;
		
		foreach ($order->dishes as $dish)
		{
			$dishRatingsSum = 0;
			$nDishRatings = $dish->dishRatings->count();

			foreach ($dish->dishRatings as $dishRating)
			{
				$dishRatingsSum = $dishRatingsSum + $dishRating->rating;
			}

			$dish->rating = $dishRatingsSum / $nDishRatings;
			$dish->save();
		}
	}

}
