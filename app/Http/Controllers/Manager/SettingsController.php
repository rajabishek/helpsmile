<?php

namespace Helpsmile\Http\Controllers\Manager;

use Helpsmile\Http\Controllers\Controller;
use Helpsmile\Services\Settings\ManagesSettingsAndHandlesUserProfile;


class SettingsController extends Controller {

    /**
     * Trait to handle settings and profile upload.
     *
     * @see \Helpsmile\Services\Settings\ManagesSettingsAndHandlesUserProfile
     */
    use ManagesSettingsAndHandlesUserProfile;

    /**
     * The name of the view to render for the settings page
     *
     * @var string
     */
    protected $settingsView = 'manager.settings';

    /**
     * The route name for the settings page
     *
     * @var string
     */
    protected $settingsRoute = 'manager.settings.index';
}