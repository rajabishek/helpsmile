<?php

// Defining menu structure here
// the items that need to appear when user is logged in should have logged_in set as true
return array(

	'homemenu' => array(

		array(
			'label' => 'Home',
			'route' => 'home',
			'active' => array('/'),
			'glyphicon' => 'si si-home'
		),

		array(
			'label' => 'Register',
			'route' => 'auth.getRegister',
			'active' => array('accounts/register*'),
			'glyphicon' => 'si si-plus'
		),

		array(
			'label' => 'Pricing',
			'route' => 'pricing',
			'active' => array('pricing'),
			'glyphicon' => 'si si-wallet'
		),

		array(
			'label' => 'Contact',
			'route' => 'contact',
			'active' => array('contact'),
			'glyphicon' => 'si si-envelope-open'
		),

		array(
			'label' => 'Support',
			'route' => 'support',
			'active' => array('support'),
			'glyphicon' => 'si si-book-open'
		),

		array(
			'label' => 'About',
			'route' => 'about',
			'active' => array('about'),
			'glyphicon' => 'si si-info'
		),
	),

	'adminmenu' => array(

		array(
			'label' => 'Manage Employees',
			'route' => 'admin.users.index',
			'active' => array('admin/users'),
			'glyphicon' => 'si si-users'
		),
		array(
			'label' => 'Add Employees',
			'route' => 'admin.users.create',
			'active' => array('admin/users/create'),
			'glyphicon' => 'si si-plus'
		),
		array(
			'label' => 'Import List',
			'route' => 'admin.users.getImport',
			'active' => array('admin/users/import'),
			'glyphicon' => 'si si-cloud-upload'
		),
		array(
			'label' => 'Download List',
			'route' => 'admin.users.getDownload',
			'active' => array('admin/users/download'),
			'glyphicon' => 'si si-cloud-download'
		),
		array(
			'label' => 'Webhooks',
			'route' => 'admin.webhooks.index',
			'active' => array('admin/webhooks*'),
			'glyphicon' => 'si si-energy'
		),
		array(
			'label' => 'Settings',
			'route' => 'admin.settings.index',
			'active' => array('admin/settings*'),
			'glyphicon' => 'si si-settings'
		)

	),

	'managermenu' => array(

		array(
			'label' => 'Telecallers',
			'route' => 'manager.telecallers.index',
			'active' => array('admin/telecallers*'),
			'glyphicon' => 'si si-call-in'
		),
		array(
			'label' => 'Teamleaders',
			'route' => 'manager.teamleaders.index',
			'active' => array('admin/teamleaders*'),
			'glyphicon' => 'si si-user'
		),
		array(
			'label' => 'Fieldexecutives',
			'route' => 'manager.fieldexecutives.index',
			'active' => array('admin/fieldexecutives*'),
			'glyphicon' => 'si si-pointer'
		),
		array(
			'label' => 'Settings',
			'route' => 'manager.settings.index',
			'active' => array('manager/settings*'),
			'glyphicon' => 'si si-settings'
		)
	),

	'teamleadermenu' => array(

		array(
			'label' => 'Donations',
			'route' => 'teamleader.donations.index',
			'active' => array('teamleader/donations*'),
			'glyphicon' => 'si si-wallet'
		),
		array(
			'label' => 'Add Donation',
			'route' => 'teamleader.donations.create',
			'active' => array('teamleader/donations/create'),
			'glyphicon' => 'si si-plus'
		),
		array(
			'label' => 'Donors',
			'route' => 'teamleader.donors.index',
			'active' => array('teamleader/donors*'),
			'glyphicon' => 'si si-users'
		),
		array(
			'label' => 'Settings',
			'route' => 'teamleader.settings.index',
			'active' => array('teamleader/settings*'),
			'glyphicon' => 'si si-settings'
		)
	),

	'fieldcoordinatormenu' => array(

		array(
			'label' => 'Unassigned',
			'route' => 'fieldcoordinator.donations.index',
			'active' => array('fieldcoordinator/donations'),
			'glyphicon' => 'si si-pin'
		),

		array(
			'label' => 'Pending',
			'route' => 'fieldcoordinator.donations.getPending',
			'active' => array('fieldcoordinator/donations/pending*'),
			'glyphicon' => 'si si-clock'
		),
		array(
			'label' => 'Donated',
			'route' => 'fieldcoordinator.donations.getDonated',
			'active' => array('fieldcoordinator/donations/donated'),
			'glyphicon' => 'si si-check'
		),
		array(
			'label' => 'Disinterested',
			'route' => 'fieldcoordinator.donations.getDisinterested',
			'active' => array('fieldcoordinator/donations/disinterested'),
			'glyphicon' => 'si si-close'
		),
		array(
			'label' => 'Donors',
			'route' => 'fieldcoordinator.donors.index',
			'active' => array('fieldcoordinator/donors*'),
			'glyphicon' => 'si si-users'
		),
		array(
			'label' => 'Settings',
			'route' => 'fieldcoordinator.settings.index',
			'active' => array('fieldcoordinator/settings*'),
			'glyphicon' => 'si si-settings'
		)
	),

	'pendingdonationsmenu' => array(

		array(
			'label' => 'Tabular',
			'route' => 'fieldcoordinator.donations.getPending',
			'active' => array('fieldcoordinator/donations/pending'),
			'glyphicon' => 'glyphicon glyphicon-list-alt'
		),

		array(
			'label' => 'Timeline',
			'route' => 'fieldcoordinator.donations.getPendingInTimeline',
			'active' => array('fieldcoordinator/donations/pending/timeline'),
			'glyphicon' => 'glyphicon glyphicon-blackboard'
		),
	)
);
