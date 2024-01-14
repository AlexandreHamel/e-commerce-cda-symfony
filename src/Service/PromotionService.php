<?php

namespace App\Service;

use App\Entity\ProductsPromotions;
use DateTime;

class PromotionService
{
    public function calculateDiscountedPrice(ProductsPromotions $productPromotion, $originalPrice)
    {
        $now = new DateTime();
        
        // Vérifie si la promotion est active
        if ($now >= $productPromotion->getStartDate() && $now <= $productPromotion->getEndDate()) {
            // Calcule le prix avec la promotion
            $discountedPrice = $originalPrice - ($originalPrice * ($productPromotion->getDiscount() / 100));
            return $discountedPrice;
        }
        return $originalPrice;
    }
}
