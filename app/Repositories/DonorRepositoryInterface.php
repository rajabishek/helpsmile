<?php namespace Helpsmile\Repositories;

use Helpsmile\Donor;
use Helpsmile\User;
use Helpsmile\Organisation;
use Helpsmile\Services\Forms\DonorCreationForm;
use Helpsmile\Services\Forms\DonorUpdateForm;

interface DonorRepositoryInterface
{
    /**
     * Get the donor creation form service.
     *
     * @return \Helpsmile\Services\Forms\DonorCreationForm
     */
    public function getDonorCreationForm();

    /**
     * Get the donor creation form service.
     *
     * @return \Helpsmile\Services\Forms\DonorCreationForm
     */
    public function getDonorUpdateForm();

    /**
     * Find all the donors from the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donor[]
     */
    public function findAllPaginatedForOrganisation(Organisation $organisation, $perPage = 8);

    /**
     * Search for all donors based on the given term from the given organisation.
     *
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile]
     */
    public function searchByTermForOrganisation($term, Organisation $organisation, $perPage = 8);

    /**
     * Update the donor details in the database.
     *
     * @param  \Helpsmile\Donor $donor
     * @param  array $data
     * @return \Helpsmile\Donor
     */
    public function edit(Donor $donor, array $data);

    /**
     * Find the donor with the curresponding id from the given organisation.
     *
     * @param  integer $id
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Donor
     */
    public function findByIdForOrganisation($id, Organisation $organisation);
}