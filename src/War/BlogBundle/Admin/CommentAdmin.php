<?php

namespace War\BlogBundle\Admin;

//use Sonata\AdminBundle\Admin\Admin;
//use Sonata\AdminBundle\Datagrid\ListMapper;
//use Sonata\AdminBundle\Datagrid\DatagridMapper;
//use Sonata\AdminBundle\Validator\ErrorElement;
//use Sonata\AdminBundle\Form\FormMapper;
//use War\BlogBundle\Entity\Comment;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class CommentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user')
            ->add('comment', 'text')
            ->add('blog', 'entity', array(
                'class' => 'War\BlogBundle\Entity\Blog',
                'choice_label' => 'title',))
//            ->add('blog.title')
//            ->add('approved')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('comment')
        ;
        
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('user')
            ->add('comment')
            ->add('blog.title')
            ->add('_action', null, array(
                'actions' => array(
                //    'show' => array(),
                //    'edit' => array(),
                    'delete' => array(),
                )
            ))                
        ;        
    }
/*    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('user')
            ->add('comment')
            ->add('approved')
        ;
    }*/
    //user rights права користувача
/*    public function getBatchActions()
    {
        $actions = parent::getBatchActions();

        // перевірка прав користувача
        if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')) 
        {
        $actions['extend'] = [
                'label'            => 'Продовжити',
                'ask_confirmation' => true // Якщо true, буде виведено повідомлення про підтвердження дії
            ];
        }

        return $actions;
    }*/    
}
