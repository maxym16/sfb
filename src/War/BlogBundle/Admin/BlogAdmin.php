<?php

namespace War\BlogBundle\Admin;

//use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BlogAdmin extends AbstractAdmin
{
    // встановлення сортування по замовчанню
    protected $datagridValues = [
        '_sort_order' => 'ASC',//по зростанню
        '_sort_by'    => 'title'
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Зміст')
            ->add('title', null, array('label' => 'Title-Заголовок'))
            ->add('blog', 'text')
            ->end()    
            ->with('Фото',array('class' => 'col-md-6'))
            ->add('image','file',array('label' => 'Image',"attr" => array("multiple" => "multiple",)))
            ->end()    
            ->with('Автор', array('class' => 'col-md-6'))
            ->add('author')
//            ->add('slug', 'string')
            ->add('tags', 'text')
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('author')
            ->add('blog')
        ;
        
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('blog')
//            ->add('image')
            ->add('image', null, array(
                'template'=>'WarBlogBundle::picture.html.twig'))
            ->add('author')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))                
        ;        
    }

    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('image', null, array(
                'template'=>'WarBlogBundle::picture.html.twig'))
            ->add('blog')
            ->add('author')
        ;
    }
}
