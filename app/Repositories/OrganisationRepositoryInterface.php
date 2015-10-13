<?php namespace Helpsmile\Repositories;

use Helpsmile\User;
use Helpsmile\Organisation;
use Helpsmile\Services\Forms\LoginForm;
use Helpsmile\Services\Forms\AddEmployeeForm;
use Helpsmile\Services\Forms\EmployeeUpdateForm;
use Helpsmile\Services\Forms\SettingsForm;
use Helpsmile\Services\Forms\ChangePasswordForm;

interface OrganisationRepositoryInterface
{
    /**
     * Get the user registration form service.
     *
     * @return \Helpsmile\Services\Forms\RegistrationForm
     */
    public function getRegistrationForm();

    /**
     * Get the organisation curresponding to the domain
     *
     * @param  string $domain
     * @return \Helpsmile\Organisation
     */
    public function findByDomain($domain);

    /**
     * Find the organisation by the given the given confirmation code.
     *
     * @param  int  $id
     * @return \Helpsmile\User
     */
    public function findByConfirmationCode($confirmationCode);

    /**
     * Create a new organisation in the database.
     *
     * @param  array $data
     * @return \Helpsmile\Organisation
     */
    public function create(array $data);
}