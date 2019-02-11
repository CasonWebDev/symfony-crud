<?php

namespace App\Form;

use App\Entity\TbServicos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TbServicosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', ChoiceType::class, [
                'choices'  => [
                    'Escolha uma opção' => null,
                    'Hidraulico' => 'Hidraulico',
                    'Eletrico' => 'Eletrico',
                    'Pintura' => 'Pintura'
                ],
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('descricao', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('tempo_medio', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TbServicos::class,
        ]);
    }
}
