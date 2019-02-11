<?php

namespace App\Form;

use App\Entity\TbOs;
use App\Entity\TbTecnicos;
use App\Entity\TbFerramentas;
use App\Entity\TbServicos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TbOsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('desconto', TextType::class)
            ->add('data_servico', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ]),
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('tecnico', EntityType::class, [
                'class' => TbTecnicos::class,
                'choice_label' => 'nome_completo',
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('ferramentas', EntityType::class, [
                'class' => TbFerramentas::class,
                'choice_label' => 'nome_ferramenta',
                'multiple' => true,
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('servicos', EntityType::class, [
                'class' => TbServicos::class,
                'choice_label' => 'descricao',
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
        ;
        $builder->get('data_servico')
                ->addModelTransformer(new CallbackTransformer(
                    function ($outNasc) {
                        if(!empty($outNasc)){
                            return date_format($outNasc,"Y-m-d");
                        }
                    },
                    function ($inNasc) {
                        if(!empty($inNasc)){
                            return new \DateTime($inNasc);
                        }
                    }
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TbOs::class,
        ]);
    }
}
