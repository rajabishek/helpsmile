<?php

namespace Helpsmile\Reporting\Contracts;

interface Factory
{
    /**
     * Get a file report generator implementation.
     *
     * @param  string  $format
     * @return \Helpsmile\Reporting\Contracts\FileReportGenerator
     */
    public function format($format = null);
}
