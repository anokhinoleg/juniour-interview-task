<?php

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 15.01.18
 * Time: 15:31
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;

class UserAdmin extends SonataUserAdmin
{
    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('username')
            ->add('position')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('username')
            ->add('position', null, [
                'label' => 'Position'
                ]
            )
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filterMapper): void
    {
        $filterMapper
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('position')
        ;
    }
}