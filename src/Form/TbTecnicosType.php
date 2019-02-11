<?php

namespace App\Form;

use App\Entity\TbTecnicos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TbTecnicosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cpf', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('nome_completo', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('dt_nasc', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
            ->add('valor_hora', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'name.not_blank',
                ])
            ])
        ;
        $builder->get('dt_nasc')
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
        $builder->get('valor_hora')
                ->addModelTransformer(new CallbackTransformer(
                    function ($toInt) {
                        if(!empty($toInt)){
                            return str_replace('.','', $toInt);
                        }
                    },
                    function ($toFloat) {
                        if(!empty($toFloat)){
                            $number = str_replace('.','', $toFloat);
                            $number = str_replace(',','.', $number);
                            return $number;
                        }
                    }
                ))
        ;
        $builder->get('cpf')
                ->addModelTransformer(new CallbackTransformer(
                    function ($cpfInt) {
                        return $cpfInt;
                    },
                    function ($cpfInt) {
                        if(!empty($cpfInt)){
                            $number = str_replace('.','', $cpfInt);
                            $number = str_replace('-','', $number);
                            return $number;
                        }
                        return false;
                    }
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TbTecnicos::class,
        ]);
    }
}
