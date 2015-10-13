<?php namespace Helpsmile\Repositories\Eloquent;

use Helpsmile\User;
use Helpsmile\Organisation;
use Illuminate\Foundation\Application;
use Illuminate\Hashing\BcryptHasher;
use Helpsmile\Services\Forms\RegistrationForm;
use Helpsmile\Repositories\OrganisationRepositoryInterface;
use Helpsmile\Exceptions\OrganisationNotFoundException;

class OrganisationRepository extends AbstractRepository implements OrganisationRepositoryInterface{

    /**
     * Create a new DbOrganisationRepository instance.
     *
     * @param  \Helpsmile\Organisation  $organisation
     * @return void
     */
    public function __construct(Organisation $organisation,Application $app, BcryptHasher $hash)
    {
        $this->model = $organisation;
        $this->app = $app;
        $this->hash = $hash;
    }

    /**
     * Get the user registration form service.
     *
     * @return \Helpsmile\Services\Forms\RegistrationForm
     */
    public function getRegistrationForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\RegistrationForm');
    }

    /**
     * Get the user registration form service.
     *
     * @return \Helpsmile\Services\Forms\ResendEmailVerificationForm
     */
    public function getResendEmailVerificationForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\ResendEmailVerificationForm');
    }

    /**
     * Get the organisation curresponding to the domain
     *
     * @param  string $domain
     * @return \Helpsmile\Organisation
     */
    public function findByDomain($domain)
    {
        $organisation = $this->model->where('domain',$domain)->first();

        if(is_null($organisation))
            throw new OrganisationNotFoundException("There is no organisation with domain as $domain");

        return $organisation;
    }

    /**
     * Find the organisation by the given the given confirmation code.
     *
     * @param  int  $id
     * @return \Helpsmile\User
     */
    public function findByConfirmationCode($confirmationCode)
    {
        $organisation = $this->model->where('confirmation_code',$confirmationCode)->first();

        if(is_null($organisation))
            throw new OrganisationNotFoundException("The organisation having confirmation code as $confirmationCode does not exist.");

        return $organisation;
    }

    /**
     * Create a new organisation in the database.
     *
     * @param  array $data
     * @return \Helpsmile\Organisation
     */
    public function create(array $data)
    {
        $organisation = $this->getNew();

        $organisation->name = $data['name'];
        $organisation->domain = $data['domain'];

        if(isset($data['confirmation_code']) && $data['confirmation_code'])
            $organisation->confirmation_code  = $data['confirmation_code'];

        $organisation->save();

        return $organisation;
    }
}
