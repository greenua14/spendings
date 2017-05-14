<?php

namespace SpendingsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('symbol', TextareaType::class)
            ->add('name', TextareaType::class)
            ->add('description', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Add Category', 'attr' => ['class' => 'submit-btn']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SpendingsBundle\Entity\Category'
        ));
    }

}
