<?php

namespace DW\SlideShowBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref')
            ->add('name')
            ->add('definition_short')
            ->add('definition')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DW\SlideShowBundle\Entity\Item'
        ));
    }

    public function getName()
    {
        return 'dw_slideshowbundle_itemtype';
    }
}
