<?php

declare(strict_types=1);

namespace App\Enums\Finance;

enum CategoryIcons: string
{
    // Income
    case salary = 'salary';
    case investments = 'investments';
    case freelance = 'freelance';
    case gifts = 'gifts';
    case refunds = 'refunds';
    case rental_income = 'rental-income';
    case royalties = 'royalties';
    case cashback = 'cashback';

    // Expense
    case housing = 'housing';
    case mortgage = 'mortgage';
    case repairs = 'repairs';
    case transportation = 'transportation';
    case groceries = 'groceries';
    case dining = 'dining';
    case utilities = 'utilities';
    case healthcare = 'healthcare';
    case entertainment = 'entertainment';
    case clothing = 'clothing';
    case electronics = 'electronics';
    case home_services = 'home-services';
    case insurance = 'insurance';
    case taxes = 'taxes';
    case subscriptions = 'subscriptions';
    case child_care = 'child-care';
    case pets = 'pets';
    case charity = 'charity';
    case personal_care = 'personal-care';
    case holidays_travel = 'holidays-travel';
    case debt_payments = 'debt-payments';
    case education = 'education';
    case technology = 'technology';
    case services = 'services';
    case loans = 'loans';
    case shopping = 'shopping';

    // Savings & misc
    case savings = 'savings';
    case transfer = 'transfer';
    case other = 'other';

    public static function casesAsValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
