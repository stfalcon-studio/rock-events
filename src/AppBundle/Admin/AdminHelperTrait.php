<?php

namespace AppBundle\Admin;

use AppBundle\Admin\Export\DoctrineORMQuerySourceIterator;
use AppBundle\Entity\User;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;

/**
 * AdminHelperTrait
 */
trait AdminHelperTrait
{
    /**
     * Get user
     *
     * @return User
     */
    protected function getUser()
    {
        $tokenStorage = $this->getConfigurationPool()->getContainer()->get('security.token_storage');

        return $tokenStorage->getToken()->getUser();
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSourceIterator()
    {
        $datagrid = $this->getDatagrid();
        $datagrid->buildPager();
        $query = $datagrid->getQuery();
        $query->select('DISTINCT '.$query->getRootAlias());

        if ($query instanceof ProxyQueryInterface) {
            $query->addOrderBy($query->getSortBy(), $query->getSortOrder());
            $query = $query->getQuery();
        }

        $translator = $this->getConfigurationPool()->getContainer()->get('translator');

        return new DoctrineORMQuerySourceIterator($query, $this->getExportFields(), $translator, 'Y-m-d H:i:s');
    }
}
