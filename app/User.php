<?php

namespace Helpsmile;

use Gravatar;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fullname', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the remember me token from DB
     *
     * @return mixed
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }
    
    /**
     * Set the remember me token to DB
     *
     * @return mixed
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column of remember me token in DB
     *
     * @return mixed
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * Check whether the user has the given role
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        return $role == $this->designation;
    }

    /**
     * Check the route of the home page
     *
     * @return string
     */
    public function getHomeRoute()
    {
        if($this->hasRole('Admin'))
            return 'admin.users.index';
        if($this->hasRole('Team Leader'))
            return 'teamleader.donations.index';
        if($this->hasRole('Field Coordinator'))
            return 'fieldcoordinator.donations.index';
        if($this->hasRole('Manager'))
            return 'manager.dashboard.index';
    }

    /**
     * Check the route of the settings page
     *
     * @return string
     */
    public function getSettingsRoute()
    {
        if($this->hasRole('Admin'))
            return 'admin.settings.index';
        if($this->hasRole('Team Leader'))
            return 'teamleader.settings.index';
        if($this->hasRole('Field Coordinator'))
            return 'fieldcoordinator.settings.index';
        if($this->hasRole('Manager'))
            return 'manager.settings.index';
    }

    /**
     * Check the route of the home page
     *
     * @return string
     */
    public function createdDonations()
    {
        return $this->hasMany('Helpsmile\Donation','telecaller_id');
    }

    /**
     * Check the route of the home page
     *
     * @return string
     */
    public function uploadedDonations()
    {
        return $this->hasMany('Helpsmile\Donation','teamleader_id');
    }

    /**
     * Check the route of the home page
     *
     * @return string
     */
    public function assignedDonations()
    {
        return $this->hasMany('Helpsmile\Donation','fieldexecutive_id');
    }

    /**
     * A user belongs to an organisation.
     *
     * @return mixed
     */
    public function organisation()
    {
        return $this->belongsTo('Helpsmile\Organisation');
    }

    /**
     * An user has many notifications.
     *
     * @return mixed
     */
    public function notifications()
    {
        return $this->belongsToMany('Helpsmile\Notification')->withTimestamps();
    }

    /**
     * Get the user's avatar image.
     *
     * @return string
     */
    public function getPhotocssAttribute()
    {
        if($this->profile && \App::make('filesystem')->disk('local')->exists('public/uploads/profiles' . '/' . $this->profile)) {
            return url('uploads/profiles/' . $this->profile);
        }

        return Gravatar::src($this->email, 100);
    }
}
