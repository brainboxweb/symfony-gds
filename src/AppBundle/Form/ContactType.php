<?php
/**
 * Created by PhpStorm.
 * User: garystraughan
 * Date: 10/02/15
 * Time: 09:08
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Email', 'email')
            ->add('Message', 'textarea')
        ;
    }

//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'AppBundle\Entity\Post'
//        ));
//    }

    public function getName()
    {
        return 'contact';
    }
}