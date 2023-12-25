<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait ProjectStaffAllowances
{
    /**
     * Get amount by hours or days from company site or company
     */
    protected function totalAllowances(): Attribute
    {
        $totalAmount = 0;

        $allowance = $this->staff->allowance;
        $companySite = $this->project->companySite;

        // check project working type is hours or days
        // ２級-construction_site_class
        $constructionSiteClass = $this->construction_site_class;
        if ($constructionSiteClass) {
            $totalAmount += $allowance->construction_site_class;
        }
        // 技能-construction_site_skills
        $constructionSiteSkills = $this->construction_site_skills;
        if ($constructionSiteSkills) {
            $totalAmount += $allowance->construction_site_skills;
        }
        // 協力-construction_site_cooperation
        $constructionSiteCooperation = $this->construction_site_cooperation;
        if ($constructionSiteCooperation) {
            $totalAmount += $allowance->construction_site_cooperation;
        }
        // company site is C-CUBE
        if ($companySite != null && $companySite->isTypeC()) {
            $totalAmount += $allowance->c_cube;
        }
        // TODO if staff worked > 20日超

        return Attribute::make(
            get: fn () => $totalAmount,
        );
    }

    /**
     * Get amount by hours or days from company site or company
     */
    protected function totalTransportationExpense(): Attribute
    {
        $totalAmount = $this->price;

        return Attribute::make(
            get: fn () => $totalAmount,
        );
    }
}
