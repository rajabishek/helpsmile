<?php

namespace Helpsmile;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['status','promised_amount','appointment'];

	/**
	 * A donation belongs to a donor associated with the donor_id
	 *
	 * @return mixed
	 */
	public function donor()
    {
        return $this->belongsTo('Helpsmile\Donor');
    }

	/**
	 * A donation belongs to a telecaller associated with the telecaller_id
	 *
	 * @return mixed
	 */
	public function telecaller()
    {
        return $this->belongsTo('Helpsmile\User');
    }

    /**
	 * A donation belongs to a teamleader associated with the teamleader_id
	 *
	 * @return mixed
	 */
	public function teamleader()
    {
        return $this->belongsTo('Helpsmile\User');
    }

    /**
	 * A donation belongs to a fieldexecutive associated with the fieldexecutive_id
	 *
	 * @return mixed
	 */
	public function fieldexecutive()
    {
        return $this->belongsTo('Helpsmile\User');
    }

    /**
	 * A donation has an address associated with it.
	 *
	 * @return mixed
	 */
	public function address()
    {
        return $this->hasOne('Helpsmile\Address');
    }

    /**
	 * Get all the donations for the given organisation
	 *
	 * @return mixed
	 */
	public function scopeForOrganization($query, $organisation)
    {
        return $query->where('organization_id', $organisation->id);
    }

    /**
	 * Get the human readable format of the donations's status
	 *
	 * @return array
	 */
	public function getStatusMessage($for = 'fieldcoordinator')
	{
	    if($for == 'fieldcoordinator' && false){
	    	switch($this->status){
		    	case 'unassigned' : return 'A field executive is yet to be assigned to visit the donor';
		    	case 'pending' : return 'A field coordinator has been assigned to visit the donor';
		    	case 'donated': return 'The donor has donated the money for the organisation';
		    	case 'disinterested': return 'The donor is not interested in donating for the organisation';
		    }
	    }
	   	else{
	   		switch($this->status){
		    	case 'unassigned' : return 'A field executive is yet to be assigned to visit the donor';
		    	case 'pending' : return $this->fieldexecutive->fullname. " has been assigned to visit the donor";
		    	case 'donated': return "The donor has donated a money of $this->donated_amount Rs for the organisation";
		    	case 'disinterested': return "The donor was not interested in donating for the organisation, and rejected contributing $this->promised_amount Rs";
		    }
	   	}
	}

    /**
	 * Return these fields from the database as \Carbon\Carbon instances
	 *
	 * @return array
	 */
	public function getDates()
	{
	    return array('created_at','updated_at','appointment');
	}

	public function getStatusClass(){
		switch ($this->status) {
			case 'unassigned':
				return 'label label-primary';
			case 'pending':
				return 'label label-warning';
			case 'donated':
				return 'label label-success';
			case 'disinterested':
				return 'label label-danger';
			
			default:
				return 'label label-primary';
		}

	}
}
