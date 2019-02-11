<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
            new TwigFilter('desc', [$this, 'addDesc']),
        ];
    }

    public function formatPrice($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = 'R$ '.$price;

        return $price;
    }
    
    public function addDesc($number, $discount, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = $number - ($number * ($discount/100));
        $price = number_format($price, $decimals, $decPoint, $thousandsSep);
        $price = 'R$ '.$price;

        return $price;
    }
}