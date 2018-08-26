<?php

declare(strict_types=1);

namespace Intervention\Image\Vips\Commands;

use Jcupitt\Vips\Exception;
use Intervention\Image\Commands\AbstractCommand;

class BlurCommand extends AbstractCommand
{
    /**
     * Execute the command.
     *
     * @param  \Intervention\Image\Image  $image
     * @return bool
     */
    public function execute($image): bool
    {
        $amount = $this->argument(0)
            ->between(0, 100)
            ->value(1);

        try {
            $core = $image->getCore();

            $core = $core->gaussblur($amount * 0.53);

            $image->setCore($core);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
