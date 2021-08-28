<?php

namespace App\Actions\Time;

use Lorisleiva\Actions\Concerns\AsAction;

class GetDaysFromMinutes
{
    use AsAction;

    /**
     * Get minute and return in format of days hours and minutes
     *
     * @param int $minutes
     * @return String
     */
    public function handle(int $minutes)
    {
        $seconds = $minutes * 60;

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");

        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes');
    }
}