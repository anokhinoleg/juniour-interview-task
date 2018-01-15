<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 15.01.18
 * Time: 17:22
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EmployeeAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName')
            ->add('position')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('firstName')
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
            ->add('firstName')
            ->add('position')
        ;
    }
}