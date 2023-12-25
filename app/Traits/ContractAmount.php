<?php

namespace App\Traits;

use App\Classes\Enum\ProjectContractType;
use App\Classes\Enum\ProjectPostType;
use App\Classes\Enum\ProjectWorkingType;

trait ContractAmount
{
    /**
     * Get price from company site or company if company site null
     */
    public function getPrice(ProjectPostType $postType, ProjectContractType $contractType, ProjectWorkingType $workingType) 
    {
        $isPostTypeQua = ProjectPostType::QUALIFIED_PERSONNEL == $postType;
        $isPostTypeGen = ProjectPostType::GENETAL == $postType;
        $contractPrice = $this->contractPrice;

        // 資格者
        if ($isPostTypeQua) {
            // 平日
            if (ProjectContractType::WEEKDAYS ==  $contractType) {
                if ($workingType == ProjectWorkingType::HOURS) {
                    // タイプ=時間
                    return $contractPrice->qualification_price_weekdays_hours;
                } else {
                    // タイプ=日額
                    return $contractPrice->qualification_price_weekdays;
                }
            }
            // 休日
            if (ProjectContractType::WEEKENDS_AND_HOLIDAYS ==  $contractType) {
                if ($workingType == ProjectWorkingType::HOURS) {
                    // タイプ=時間
                    return $contractPrice->qualification_price_holidays_hours;
                } else {
                    // タイプ=日額
                    return $contractPrice->qualification_price_holidays;
                }
            }
            // 平日残業
            if (ProjectContractType::WEEKENDS_AND_HOLIDAYS ==  $contractType) {
                if ($workingType == ProjectWorkingType::HOURS) {
                    // タイプ=時間
                    return $contractPrice->qualification_price_weekday_overtime;
                } else {
                    // タイプ=日額
                    return null;
                }
            }
            // 休日残業
            if (ProjectContractType::WEEKENDS_AND_HOLIDAYS ==  $contractType) {
                if ($workingType == ProjectWorkingType::HOURS) {
                    // タイプ=時間
                    return $contractPrice->qualification_price_holidays_overtime;
                } else {
                    // タイプ=日額
                    return null;
                }
            }
        }
        // 一般
        if ($isPostTypeGen) {
            // 平日
            if (ProjectContractType::WEEKDAYS ==  $contractType) {
                if ($workingType == ProjectWorkingType::HOURS) {
                    // タイプ=時間
                    return $contractPrice->general_price_weekdays_hours;
                } else {
                    // タイプ=日額
                    return $contractPrice->general_price_weekdays;
                }
            }
            // 休日
            if (ProjectContractType::WEEKENDS_AND_HOLIDAYS ==  $contractType) {
                if ($workingType == ProjectWorkingType::HOURS) {
                    // タイプ=時間
                    return $contractPrice->general_price_holidays_hours;
                } else {
                    // タイプ=日額
                    return $contractPrice->general_price_holidays;
                }
            }
            // 平日残業
            if (ProjectContractType::WEEKENDS_AND_HOLIDAYS ==  $contractType) {
                if ($workingType == ProjectWorkingType::HOURS) {
                    // タイプ=時間
                    return $contractPrice->general_price_weekday_overtime;
                } else {
                    // タイプ=日額
                    return null;
                }
            }
            // 休日残業
            if (ProjectContractType::WEEKENDS_AND_HOLIDAYS ==  $contractType) {
                if ($workingType == ProjectWorkingType::HOURS) {
                    // タイプ=時間
                    return $contractPrice->general_price_holidays_overtime;
                } else {
                    // タイプ=日額
                    return null;
                }
            }
        }

        // 研修-TRAINING
        return null;
    }
}
