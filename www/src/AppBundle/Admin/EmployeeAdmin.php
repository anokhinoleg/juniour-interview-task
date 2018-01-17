<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 15.01.18
 * Time: 17:22
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\DatePickerType;


class EmployeeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper): void
    {
        // get the current Image instance
        $image = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = ['required' => false];
        if ($image && ($webPath = $image->getWebPath())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath().$webPath;
            dump($fullPath);
            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="'.$fullPath.'" class="admin-preview" style="width: 200px; height: 200px;/>';
        }


        $formMapper
            ->add('firstName')
            ->add('lastName')
            ->add('photo', 'file', $fileFieldOptions)
            ->add('position', 'entity', [
                'class' => 'AppBundle\Entity\Position',
                'choice_label' => 'name',
            ])
            ->add('rate', 'number')
            ->add('firstWorkingDayDate', DatePickerType::class)
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id')
            ->add('photo', 'string', array('template' => 'AppBundle:Admin:list_photo.html.twig'))
            ->addIdentifier('firstName')
            ->addIdentifier('lastName')
            ->add('position', 'entity', [
                'class' => 'AppBundle\Entity\Position',
                'choice_label' => 'name',
            ])
            ->add('rate')
            ->add('firstWorkingDayDate')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filterMapper): void
    {
        $filterMapper
            ->add('firstName')
            ->add('lastName')
            ->add('position')
            ->add('rate')
            ->add('firstWorkingDayDate')
        ;
    }

    public function prePersist($photo)
    {
        $this->manageFileUpload($photo);
    }

    public function preUpdate($photo)
    {
        $this->manageFileUpload($photo);
    }

    private function manageFileUpload($photo)
    {
        if ($photo->getPhoto()) {
            $photo->refreshUpdated();
        }
    }
}