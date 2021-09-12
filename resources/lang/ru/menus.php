<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'dashboard' => [
            'title' => 'Dashboard'
        ],

        'header' => [
            'language' => [
                'title' => 'Язык',

                'labels' => [
                    'en' => 'English',
                    'ru' => 'Русский',
                ]
            ]
        ],

        'general' => [
            'title' => 'General'
        ],

        'tecdoc' => [
            'title' => 'TecDoc',
            'languages' => [
                'title' => 'Языки',
                'main' => 'Языки',
                'all' => 'Все Языки',
                'create' => 'Создать Язык',
                'edit' => 'Редактировать Язык',
                'view' => 'Обзор Языка',
            ],
            'countries' => [
                'title' => 'Страны',
                'main' => 'Страны',
                'all' => 'Все Страны',
                'create' => 'Создать Страну',
                'edit' => 'Редактировать Страну',
                'view' => 'Обзор Страны',
            ],
            'country-groups' => [
                'title' => 'Группы Стран',
                'main' => 'Группы Стран',
                'all' => 'Все Группы Стран',
                'create' => 'Создать Группу Стран',
                'edit' => 'Редактировать Группу Стран',
                'view' => 'Обзор Группы Стран',
            ],
            'cars' => [
                'title' => 'Автомобили',

                'manufacturers' => [
                    'title' => 'Производители',
                ],

                'models' => [
                    'title' => 'Модели',
                ],

                'vehicles' => [
                    'title' => 'Транспортные Средства',
                ],

                'vehicle-details' => [
                    'title' => 'Обзор Транспортных Средств',
                ],
            ],
            'articles' => [
                'title' => 'Детали',
                'brands' => [
                    'title' => 'Бренды',
                    'main' => 'Бренды',
                    'all' => 'Все Бренды',
                    'create' => 'Создать Бренд',
                    'edit' => 'Редактировать Бренд',
                    'view' => 'Обзор Бренда',
                ],
                'brand-addresses' => [
                    'title' => 'Бренд Адреса',
                    'main' => 'Бренд Адреса',
                    'all' => 'Все Бренд Адреса',
                    'create' => 'Создать Бренд Адрес',
                    'edit' => 'Редактировать Бренд Адрес',
                    'view' => 'Обзор Бренд Адреса',
                ]
            ],

            'short-cuts' => [
                'title' => 'Категории',
            ],

            'assembly-groups' => [
                'title' => 'Сборочные Группы',
            ],

            'generic-articles' => [
                'title' => 'Общие Статьи',
            ],

            'direct-articles' => [
                'title' => 'Запчасти',
            ],

            'direct-article-details' => [
                'title' => 'Детализация Запчастей',
            ],

            'version' => [
                'title' => 'Версия',
            ]
        ],

        'shop' => [
            'title' => 'Магазин',

            'distributors' => [
                'title' => 'Дистрибьюторы',
                'all' => 'Все Дистрибьюторы',
                'create' => 'Создать Дистрибьютор',
                'edit' => 'Редактировать Дистрибьютор',
                'main' => 'Дистрибьюторы',
                'view' => 'Обзор Дистрибьютора',
            ],

            'distributor-storages' => [
                'title' => 'Склады',
                'all' => 'Все склады',
                'create' => 'Создать Склад',
                'edit' => 'Редактировать Склад',
                'main' => 'Склады',
                'view' => 'Обзор Склада',
            ],

            'distributor-products' => [
                'title' => 'Продукты',
                'all' => 'Все Продукты',
                'create' => 'Создать Продукт',
                'edit' => 'Редактировать Продукт',
                'main' => 'Продукты',
                'view' => 'Обзор Продукта',
            ],
        ],

        'settings' => [
            'title' => 'Настройки',

            'price_schemes' => [
                'title' => 'Схемы наценки',
                'all' => 'Все Схемы наценки',
                'create' => 'Создать Схему наценки',
                'edit' => 'Редактировать Схему наценки',
                'main' => 'Схемы наценки',
                'view' => 'Обзор Схемы наценки',
            ],
        ]
    ],

    'frontend' => [
        'header' => [
            'catalog' => 'Каталог автозапчастей',

            'account' => [
                'dashboard' => 'Дашборд',
                'garage' => 'Гараж',
                'orders' => 'Заказы',
                'profile' => 'Профиль',
                'password' => 'Пароль',
            ]
        ],

        'footer' => [
            'contacts' => [
                'title' => 'Связаться с нами',

                'labels' => [
                    'email' => 'Email',
                    'phone' => 'Телефон',
                    'support' => 'Поддержка',
                    'online_orders' => 'Интернет заказы',
                ]
            ],

            'information' => [
                'title' => 'Информация',

                'labels' => [
                ]
            ],

            'account' => [
                'title' => 'Мой кабинет',

                'labels' => [
                    'login' => 'Вход',
                    'register' => 'Регистрация',
                    'dashboard' => 'Дашборд',
                    'garage' => 'Гараж',
                    'orders' => 'История заказов',
                ]
            ],

            'newsletter' => [
                'title' => 'Рассылка',

                'labels' => [
                ]
            ]
        ],

        'pages' => [
            'about' => [
                'title' => 'О нас',
            ],

            'contacts' => [
                'title' => 'Контакты',
            ],

            'payment' => [
                'title' => 'Способы оплаты',
            ],

            'delivery' => [
                'title' => 'Способы доставки',
            ],

            'privacy' => [
                'title' => 'Политика конфиденциальности',
            ],

            'terms' => [
                'title' => 'Условия и положения',
            ],

            'faq' => [
                'title' => 'Вопрос-Ответ',
            ],
        ]
    ]
];
