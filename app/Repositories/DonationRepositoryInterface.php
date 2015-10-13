<?php namespace Helpsmile\Repositories;

use Helpsmile\User;
use Helpsmile\Donation;
use Helpsmile\Donor;
use Helpsmile\Address;
use Helpsmile\Organisation;
use Helpsmile\Exceptions\DonorNotFoundException;
use Helpsmile\Exceptions\DonationNotFoundException;
use Carbon\Carbon;

interface DonationRepositoryInterface
{
    /**
     * Get the donor donation creation form service.
     * Validates the rules for creating donation with donor details.
     * This happens when the donor is making a donation for the first time.
     *
     * @return \Helpsmile\Services\Forms\DonationCreationForm
     */
    public function getDonorDonationCreationForm();

    /**
     * Get the donation creation form service.
     * Validate the donation details.
     * This happens when an existing donor is making a donation.
     *
     * @return \Helpsmile\Services\Forms\DonationCreationForm
     */
    public function getDonationCreationForm();

    /**
     * Get the donation creation form service.
     * Validates the donation details before updating them.
     * This happens when donation details are updated after a fieldexecutive is assigned.
     *
     * @return \Helpsmile\Services\Forms\DonationUpdateForm
     */
    public function getDonationUpdateForm();

    /**
     * Get the donation creation form service.
     * Validates the donation details before updating them.
     * This happens when donation details are updated before a fieldexecutive is assigned.
     * 
     * @return \Helpsmile\Services\Forms\DonationUpdateForm
     */
    public function getUnassignedDonationUpdateForm();

    /**
     * Find all the donations which were uploaded by the teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllUploadedByTeamleader(User $teamleader, $perPage = 8);

    /**
     * Find all the unassigned donations which were uploaded by the teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllUnassignedUploadedByTeamleader(User $teamleader, $perPage = 8);

    /**
     * Find all the pending donations which were uploaded by the teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllPendingUploadedByTeamleader(User $teamleader, $perPage = 8);

    /**
     * Find all the donated donations which were uploaded by the given teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDonatedUploadedByTeamleader(User $teamleader, $perPage = 8);

     /**
     * Find all the disinterested donations which were uploaded by the teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDisinterestedUploadedByTeamleader(User $teamleader, $perPage = 8);

    /**
     * Find all the pending donations assigned for the given fieldexecutive.
     *
     * @param  \Helpsmile\User $executive
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllPendingAssignedForFieldExecutive(User $executive, $perPage = 8);

    /**
     * Find all the donated donations  assigned for the given fieldexecutive.
     *
     * @param  \Helpsmile\User $executive
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDonatedAssignedForFieldExecutive(User $executive, $perPage = 8);

    /**
     * Find all the donations from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllPaginatedForOrganisation(Organisation $organisation, $perPage = 8);

    /**
     * Find all unassigned donations from the given organisation.
     *
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllUnassignedPaginatedForOrganisation(Organisation $organisation, $perPage = 8);

    /**
     * Find all pending donations from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllPendingPaginatedForOrganisation(Organisation $organisation, $perPage = 8);

    /**
     * Find all donated donations from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDonatedPaginatedForOrganisation(Organisation $organisation, $perPage = 8);

    /**
     * Find all disinterested donations from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDisinterestedPaginatedForOrganisation(Organisation $organisation, $perPage = 8);

    /**
     * Search for all unassigned donations based on the given term from the given organisation.
     *
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchUnassignedByTermForOrganisation($term, Organisation $organisation, $perPage = 8);

    /**
     * Search for all pending donations based on the given term from the given organisation.
     *
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchPendingByTermForOrganisation($term, Organisation $organisation, $perPage = 8);

    /**
     * Search for all donated donations based on the given term from the given organisation.
     *
     * @param  string $term
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchDonatedByTermForOrganisation($term, Organisation $organisation, $perPage = 8);

    /**
     * Search for all disinterested donations based on the given term from the given organisation.
     *     
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchDisinterestedByTermForOrganisation($term, Organisation $organisation, $perPage = 8);

    /**
     * Search for all donations uploaded by the teamleader based on the given term.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  string $term
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchByTermForTeamleader(User $teamleader,$term,$perPage = 8);

    /**
     * Save the donation details for the given teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  array $data
     * @return \Helpsmile\Donation
     */
    public function uploadDonationDetailsForTeamleader(User $teamleader, array $data);

    /**
     * Update the donation details.
     *
     * @param  \Helpsmile\User $donation
     * @param  array $data
     * @return \Helpsmile\User
     */
    public function edit(Donation $donation, array $data);

    /**
     * Find the donation with the curresponding id from the given organisation.
     *
     * @param  integer $id
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Donation
     */
    public function findByIdForOrganisation($id, Organisation $organisation);

    /**
     * Find the donation with the specified id for the given teamleader
     *
     * @param  integer $donationid
     * @param  \Helpsmile\User $teamleader
     * @return \Helpsmile\Donation
     */
    public function findByIdForTeamleader($donationid, User $teamleader);

    /**
     * Find the donation with the specified id assigned for the field executive.
     *
     * @param  integer $donationid
     * @param  \Helpsmile\User $executive
     * @return \Helpsmile\Donation
     */
    public function findByIdAssignedForFieldExecutive($donationid, User $executive);

    /**
     * Mark the given donation as donated and persist the donated amount.
     *
     * @param  \Helpsmile\Donation $donation
     * @param  integer $donated_amount
     * @return \Helpsmile\Donation
     */
    public function markAsDonated(Donation $donation,$donated_amount);

    /**
     * Find all donations created by the telecaller for the given teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $telecaller
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllForTeamleaderCreatedByTelecaller(User $teamleader, $telecaller_id, $perPage = 8);

    /**
     * Assign the donation to the given field executive.
     *
     * @param  \Helpsmile\User $fieldexecutive_id
     * @return \Helpsmile\Donation $donation
     */
    public function assignFieldExecutiveForDonation(User $fieldexecutive, Donation $donation);
}
