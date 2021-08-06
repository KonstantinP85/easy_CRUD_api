<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Reader;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotNull;

class ReaderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'constraints' => [
                    new NotNull([
                        'message'=>'Name can not be blank'
                    ]),
                    ]
                ))
            ->add('email', EmailType::class, array(
                'constraints' => [
                    new NotNull([
                        'message'=>'Email can not be blank'
                    ]),
                    new Email(),
                ]
            ))
            ->add('category', EntityType::class, array(
                'class'=> Category::class,
                'multiple'=>true,
                'constraints' => [
                    new NotNull([
                        'message'=>'Category can not be blank'
                    ]),
                ]
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reader::class,
            'csrf_protection' => false
        ]);
    }
}
