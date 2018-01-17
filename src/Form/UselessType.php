<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\UselessEntity;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UselessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meh', TextType::class)
            ->add('whatever',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UselessEntity::class,
        ));
    }

    public function getName()
    {
        return 'useless';
    }
}