<?php namespace Helpsmile\Reporting\Contracts;

use Helpsmile\Organisation;

interface FileReportGenerator
{
    /**
     * Set the column name to order the employee list
     *
     * @param  string  $orderby
     * @return \Helpsmile\Reporting\FileReportGenerator
     */
    public function orderby($orderby);

    /**
     * Set whether to order in ascending or descending.
     *
     * @param  string  $ordertype
     * @return \Helpsmile\Reporting\FileReportGenerator
     */
    public function ordertype($ordertype);

    /**
     * Get the employee details as a report in a file from the given organisation.
     *
     * @param  \Helpsmile\Organisation  $organisation
     * @return bool
     */
    public function getEmployeeDetailsForOrganisation(Organisation $Organisation);
}