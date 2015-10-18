<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;

class CropImage extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $cropObject;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($cropObject)
	{
		$this->cropObject = $cropObject;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$cropObject = $this->cropObject;
		$destinationPath = $cropObject['destinationPath'];
		$cropw = $cropObject['cropw'];
		$croph = $cropObject['croph'];
		$cropx = $cropObject['cropx'];
		$cropy = $cropObject['cropy'];

		Log::info('init ok');

		$picture = Image::make('eatmythings.com/public/' . $destinationPath . '/profile_picture.jpg');

		Log::info('image made');

        $croppedPicture = $picture->crop($cropw, $croph, $cropx, $cropy);
        
        Log::info('picture cropped');

        $croppedPicture->save('eatmythings.com/public/' . $destinationPath . '/profile_picture.jpg');

        Log::info('picture saved');
        
        $croppedPictureMedium = $croppedPicture->resize(300, 300);
        $croppedPictureMedium->save('eatmythings.com/public/' . $destinationPath . '/profile_picture_md.jpg');

        $croppedPictureSmall = $croppedPictureMedium->resize(100, 100);
        $croppedPictureSmall->save('eatmythings.com/public/' . $destinationPath . '/profile_picture_sm.jpg');
	}

}
