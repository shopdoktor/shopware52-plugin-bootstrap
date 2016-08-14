<?php
namespace LenzTest;

class LenzTest extends \Shopware\Components\Plugin
{
	public static function getSubscribedEvents()
	{
		return [
			'Enlight_Controller_Action_PostDispatch_Frontend_Detail' => 'onPostDispatchDetail'
		];
	}

	public function install(InstallContext $context)
	{
		return true;
	}

	public function update(UpdateContext $context)
	{
		return true;
	}

	public function activate(ActivateContext $context)
	{
		return true;
	}

	public function deactivate(DeactivateContext $context)
	{
		return true;
	}

	public function uninstall(UninstallContext $context)
	{
		return true;
	}

	public function onPostDispatchDetail(Enlight_Event_EventArgs $args) {
		$conn = $this->container->get('dbal_connection');
		$config = (new DBALConfigReader($conn))->getByPluginName('LenzTest');

		if(!$config['show']) {
			return;
		}

		$subject  = $args->getSubject();
		$request  = $subject->Request();
		/** @var $view */
		$view     = $subject->View();

		$sArticle = $view->sArticle;

		$sArticle['name'] = 'Hier steht der Artikelname.';

		$view->sArticle = $sArticle;
	}
}