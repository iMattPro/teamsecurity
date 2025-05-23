<?php
/**
*
* Team Security Measures extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\teamsecurity\tests;

class ext_test extends \phpbb_database_test_case
{
	protected const TEAM_SECURITY = 'phpbb/teamsecurity';
	protected $extension_manager;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/extensions.xml');
	}

	protected function setUp(): void
	{
		parent::setUp();

		$this->extension_manager = $this->create_extension_manager();
	}

	public function test_enable()
	{
		// Enable it
		$this->extension_manager->enable(self::TEAM_SECURITY);

		// Assert it's enabled
		$this->assertEquals([self::TEAM_SECURITY], array_keys($this->extension_manager->all_enabled()));
		$this->assertEquals([self::TEAM_SECURITY], array_keys($this->extension_manager->all_configured()));
	}

	public function test_disable()
	{
		// Enable it
		$this->extension_manager->enable(self::TEAM_SECURITY);

		// Assert it's Enabled
		$this->assertEquals([self::TEAM_SECURITY], array_keys($this->extension_manager->all_enabled()));

		// Disable it and assert expected trigger error is called
		$this->setExpectedTriggerError(E_USER_WARNING, 'TEAM_SECURITY_DISABLE_MESSAGE');
		$this->extension_manager->disable(self::TEAM_SECURITY);
	}

	protected function create_extension_manager()
	{
		$phpbb_root_path = dirname(__DIR__, 2) . '/';
		$php_ext = 'php';

		$config = new \phpbb\config\config(['version' => PHPBB_VERSION]);
		$db = $this->new_dbal();
		$db_doctrine = $this->new_doctrine_dbal();
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$factory = new \phpbb\db\tools\factory();
		$finder_factory = new \phpbb\finder\factory(null, false, $phpbb_root_path, $php_ext);
		$db_tools = $factory->get($db_doctrine);
		$table_prefix = 'phpbb_';

		$container = new \phpbb_mock_container_builder();
		$container->set('event_dispatcher',  $phpbb_dispatcher);

		$migrator = new \phpbb\db\migrator(
			$container,
			$config,
			$db,
			$db_tools,
			'phpbb_migrations',
			$phpbb_root_path,
			$php_ext,
			$table_prefix,
			self::get_core_tables(),
			[],
			new \phpbb\db\migration\helper()
		);
		$container->set('migrator', $migrator);

		return new \phpbb\extension\manager(
			$container,
			$db,
			$config,
			$finder_factory,
			'phpbb_ext',
			$phpbb_root_path,
			null
		);
	}
}
