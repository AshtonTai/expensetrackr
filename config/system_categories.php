<?php

declare(strict_types=1);

use App\Enums\Finance\CategoryClassification;

return [
    // Income categories
    [
        'name' => 'Salary',
        'slug' => 'salary',
        'color' => '#16A34A',
        'classification' => CategoryClassification::Income,
        'icon' => 'salary',
    ],
    [
        'name' => 'Investments',
        'slug' => 'investments',
        'color' => '#059669',
        'classification' => CategoryClassification::Income,
        'icon' => 'investments',
    ],
    [
        'name' => 'Freelance',
        'slug' => 'freelance',
        'color' => '#0D9488',
        'classification' => CategoryClassification::Income,
        'icon' => 'freelance',
    ],
    [
        'name' => 'Gifts',
        'slug' => 'gifts',
        'color' => '#65A30D',
        'classification' => CategoryClassification::Income,
        'icon' => 'gifts',
    ],
    [
        'name' => 'Refunds',
        'slug' => 'refunds',
        'color' => '#0891B2',
        'classification' => CategoryClassification::Income,
        'icon' => 'refunds',
    ],
    [
        'name' => 'Rental Income',
        'slug' => 'rental-income',
        'color' => '#4F46E5',
        'classification' => CategoryClassification::Income,
        'icon' => 'rental-income',
    ],
    [
        'name' => 'Royalties',
        'slug' => 'royalties',
        'color' => '#7C3AED',
        'classification' => CategoryClassification::Income,
        'icon' => 'royalties',
    ],
    [
        'name' => 'Cashback',
        'slug' => 'cashback',
        'color' => '#E11D48',
        'classification' => CategoryClassification::Income,
        'icon' => 'cashback',
    ],

    // Expense categories
    [
        'name' => 'Housing',
        'slug' => 'housing',
        'color' => '#DC2626',
        'classification' => CategoryClassification::Expense,
        'icon' => 'housing',
    ],
    [
        'name' => 'Mortgage',
        'slug' => 'mortgage',
        'color' => '#B91C1C',
        'classification' => CategoryClassification::Expense,
        'icon' => 'mortgage',
        'parent_slug' => 'housing',
    ],
    [
        'name' => 'Repairs',
        'slug' => 'repairs',
        'color' => '#B45309',
        'classification' => CategoryClassification::Expense,
        'icon' => 'repairs',
        'parent_slug' => 'housing',
    ],
    [
        'name' => 'Transportation',
        'slug' => 'transportation',
        'color' => '#2563EB',
        'classification' => CategoryClassification::Expense,
        'icon' => 'transportation',
    ],
    [
        'name' => 'Groceries',
        'slug' => 'groceries',
        'color' => '#D97706',
        'classification' => CategoryClassification::Expense,
        'icon' => 'groceries',
    ],
    [
        'name' => 'Dining',
        'slug' => 'dining',
        'color' => '#EA580C',
        'classification' => CategoryClassification::Expense,
        'icon' => 'dining',
    ],
    [
        'name' => 'Utilities',
        'slug' => 'utilities',
        'color' => '#6D28D9',
        'classification' => CategoryClassification::Expense,
        'icon' => 'utilities',
    ],
    [
        'name' => 'Healthcare',
        'slug' => 'healthcare',
        'color' => '#DB2777',
        'classification' => CategoryClassification::Expense,
        'icon' => 'healthcare',
    ],
    [
        'name' => 'Entertainment',
        'slug' => 'entertainment',
        'color' => '#9333EA',
        'classification' => CategoryClassification::Expense,
        'icon' => 'entertainment',
    ],
    [
        'name' => 'Clothing',
        'slug' => 'clothing',
        'color' => '#C2410C',
        'classification' => CategoryClassification::Expense,
        'icon' => 'clothing',
    ],
    [
        'name' => 'Electronics',
        'slug' => 'electronics',
        'color' => '#F97316',
        'classification' => CategoryClassification::Expense,
        'icon' => 'electronics',
    ],
    [
        'name' => 'Home Services',
        'slug' => 'home-services',
        'color' => '#78716C',
        'classification' => CategoryClassification::Expense,
        'icon' => 'home-services',
    ],
    [
        'name' => 'Insurance',
        'slug' => 'insurance',
        'color' => '#BE185D',
        'classification' => CategoryClassification::Expense,
        'icon' => 'insurance',
    ],
    [
        'name' => 'Taxes',
        'slug' => 'taxes',
        'color' => '#9F1239',
        'classification' => CategoryClassification::Expense,
        'icon' => 'taxes',
    ],
    [
        'name' => 'Subscriptions',
        'slug' => 'subscriptions',
        'color' => '#C026D3',
        'classification' => CategoryClassification::Expense,
        'icon' => 'subscriptions',
    ],
    [
        'name' => 'Child Care',
        'slug' => 'child-care',
        'color' => '#CA8A04',
        'classification' => CategoryClassification::Expense,
        'icon' => 'child-care',
    ],
    [
        'name' => 'Pets',
        'slug' => 'pets',
        'color' => '#4D7C0F',
        'classification' => CategoryClassification::Expense,
        'icon' => 'pets',
    ],
    [
        'name' => 'Charity',
        'slug' => 'charity',
        'color' => '#EC4899',
        'classification' => CategoryClassification::Expense,
        'icon' => 'charity',
    ],
    [
        'name' => 'Personal Care',
        'slug' => 'personal-care',
        'color' => '#A21CAF',
        'classification' => CategoryClassification::Expense,
        'icon' => 'personal-care',
    ],
    [
        'name' => 'Holidays & Travel',
        'slug' => 'holidays-travel',
        'color' => '#0E7490',
        'classification' => CategoryClassification::Expense,
        'icon' => 'holidays-travel',
    ],
    [
        'name' => 'Debt Payments',
        'slug' => 'debt-payments',
        'color' => '#C81E1E',
        'classification' => CategoryClassification::Expense,
        'icon' => 'debt-payments',
    ],

    // Savings
    [
        'name' => 'Savings',
        'slug' => 'savings',
        'color' => '#047857',
        'classification' => CategoryClassification::Savings,
        'icon' => 'savings',
    ],

    // Transfer
    [
        'name' => 'Transfer',
        'slug' => 'transfer',
        'color' => '#475569',
        'classification' => CategoryClassification::Transfer,
        'icon' => 'transfer',
    ],

    // Other
    [
        'name' => 'Other',
        'slug' => 'other',
        'color' => '#52525B',
        'classification' => CategoryClassification::Other,
        'icon' => 'other',
    ],
];
