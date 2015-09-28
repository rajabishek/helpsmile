<?php

namespace Helpsmile;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['url'];

	/**
	 * A user belongs to an organisation.
	 *
	 * @return mixed
	 */
	public function organisation()
    {
        return $this->belongsTo('Helpsmile\Organisation');
    }
}
