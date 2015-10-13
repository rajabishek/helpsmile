<?php namespace Helpsmile\Repositories;

use Helpsmile\User;
use Helpsmile\Organisation;
use Helpsmile\Services\Forms\LoginForm;
use Helpsmile\Services\Forms\AddEmployeeForm;
use Helpsmile\Services\Forms\EmployeeUpdateForm;
use Helpsmile\Services\Forms\SettingsForm;
use Helpsmile\Services\Forms\ChangePasswordForm;

interface UserRepositoryInterface
{

    /**
     * Get the user login form service.
     *
     * @return \Helpsmile\Services\Forms\LoginForm
     */
    public function getLoginForm();

    /**
     * Get the user creation form service.
     *
     * @return \Helpsmile\Services\Forms\AddEmployeeForm
     */
    public function getUserCreationForm();

    /**
     * Get the user update form service.
     *
     * @return \Helpsmile\Services\Forms\EmployeeUpdateForm
     */
    public function getUserUpdateForm();

    /**
     * Get the user update form service.
     *
     * @return \Helpsmile\Services\Forms\SettingsForm
     */
    public function getSettingsForm();

    /**
     * Get the change password form service.
     *
     * @return \Helpsmile\Services\Forms\ChangePasswordForm
     */
    public function getChangePasswordForm();

    /**
     * Find all users paginated.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @param  int  $perPage
     * @return Illuminate\Database\Eloquent\Collection|\Helpsmile\User[]
     */
    public function findAllPaginatedForOrganisation($organisation, $perPage = 8);

    /**
     * Find the user by the given id from the given organisation.
     *
     * @param  int  $id
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function findByIdForOrganisation($id, Organisation $organisation);

    /**
     * Find the user by the given email address from the given organisation.
     *
     * @param  int  $email
     * @param  \Helpsmile\Organisation  $organisation
     * @return \Helpsmile\User
     */
    public function findByEmailForOrganisation($email, Organisation $organisation);

    /**
     * Return array of key-value (id => name) pairs of all users who are telecallers from the given organisation.
     *
     * @return array
     */
    public function listAllTelecallersForOrganisation(Organisation $organisation);

    /**
     * Return array of key-value (id => name) pairs of all users who are teamleaders from the given organisation.
     *
     * @return array
     */
    public function listAllTeamleadersForOrganisation(Organisation $organisation);

    /**
     * Return array of key-value (id => name) pairs of all users who are field-excutives from the given organisation.
     *
     * @return array
     */
    public function listAllFieldexecutivesForOrganisation(Organisation $organisation);

    /**
     * Find all users that match the given search term.
     *
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\User[]
     */
    public function searchByTermPaginatedForOrganisation($term, Organisation $organisation, $perPage = 8);

    /**
     * Find all users by their designation.
     *
     * @param  string $designation
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\User[]
     */
    public function searchByDesignationForOrganisation($designation, $organisation, $perPage = 8);

    /**
     * Create a new user in the database for the given organisation.
     *
     * @param  array $data
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function createForOrganisation(array $data, Organisation $organisation);

    /**
     * Update the user in the database.
     *
     * @param  \Helpsmile\User $user
     * @param  array $data
     * @return \Helpsmile\User
     */
    public function edit(User $user, array $data);

    /**
     * Get the performance of the telecallers from the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function getTelecallersStatisticsForOrganisation(Organisation $organisation);

    /**
     * Get the performance of the teamleaders from the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function getTeamleadersStatisticsForOrganisation(Organisation $organisation);

    /**
     * Get the performance of the field executives from the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function getFieldexecutivesStatisticsForOrganisation(Organisation $organisation);
}