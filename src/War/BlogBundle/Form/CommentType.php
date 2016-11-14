<?php

namespace War\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user')
            ->add('comment')
    //        ->add('approved')
    //        ->add('created', 'datetime')
    //        ->add('updated', 'datetime')
    //        ->add('blog')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'War\BlogBundle\Entity\Comment'
        ));
    }
    
    public function getBlockPrefix()
    {
    return 'war_blogbundle_commenttype';
    }
}
