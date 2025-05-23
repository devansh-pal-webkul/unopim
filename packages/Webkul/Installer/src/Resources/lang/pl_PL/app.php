<?php

return [
    'seeders' => [
        'attribute' => [
            'attribute-families' => 'Domyślny',
            'attribute-groups'   => [
                'description'      => 'Opis',
                'general'          => 'Ogólny',
                'inventories'      => 'Zasoby',
                'meta-description' => 'Meta opis',
                'price'            => 'Cena',
                'technical'        => 'Techniczny',
                'shipping'         => 'Wysyłka',
            ],
            'attributes' => [
                'brand'                => 'Marka',
                'color'                => 'Kolor',
                'cost'                 => 'Koszt',
                'description'          => 'Opis',
                'featured'             => 'Polecany',
                'guest-checkout'       => 'Zakupy gościa',
                'height'               => 'Wysokość',
                'length'               => 'Długość',
                'manage-stock'         => 'Zarządzanie zapasami',
                'meta-description'     => 'Meta opis',
                'meta-keywords'        => 'Meta słowa kluczowe',
                'meta-title'           => 'Meta tytuł',
                'name'                 => 'Nazwa',
                'new'                  => 'Nowy',
                'price'                => 'Cena',
                'product-number'       => 'Numer produktu',
                'short-description'    => 'Krótki opis',
                'size'                 => 'Rozmiar',
                'sku'                  => 'SKU',
                'special-price-from'   => 'Promocja od',
                'special-price-to'     => 'Promocja do',
                'special-price'        => 'Promocyjna cena',
                'status'               => 'Status',
                'tax-category'         => 'Kategoria podatkowa',
                'url-key'              => 'URL klucz',
                'visible-individually' => 'Widoczny indywidualnie',
                'weight'               => 'Waga',
                'width'                => 'Szerokość',
            ],
            'attribute-options' => [
                'black'  => 'Czarny',
                'green'  => 'Zielony',
                'l'      => 'L',
                'm'      => 'M',
                'red'    => 'Czerwony',
                's'      => 'S',
                'white'  => 'Biały',
                'xl'     => 'XL',
                'yellow' => 'Żółty',
            ],
        ],
        'category' => [
            'categories' => [
                'description' => 'Opis głównej kategorii',
                'name'        => 'Główna kategoria',
            ],
            'category_fields' => [
                'name'        => 'Nazwa',
                'description' => 'Opis',
            ],
        ],
        'cms' => [
            'pages' => [
                'about-us' => [
                    'content' => 'Zawartość strony o nas',
                    'title'   => 'O nas',
                ],
                'contact-us' => [
                    'content' => 'Zawartość strony kontaktowej',
                    'title'   => 'Kontakt',
                ],
                'customer-service' => [
                    'content' => 'Zawartość strony serwisowej',
                    'title'   => 'Serwis',
                ],
                'payment-policy' => [
                    'content' => 'Zawartość strony polityki płatności',
                    'title'   => 'Polityka płatności',
                ],
                'privacy-policy' => [
                    'content' => 'Zawartość strony polityki prywatności',
                    'title'   => 'Polityka prywatności',
                ],
                'refund-policy' => [
                    'content' => 'Zawartość strony polityki zwrotów',
                    'title'   => 'Polityka zwrotów',
                ],
                'return-policy' => [
                    'content' => 'Zawartość strony polityki zwrotów',
                    'title'   => 'Polityka zwrotów',
                ],
                'shipping-policy' => [
                    'content' => 'Zawartość strony polityki wysyłki',
                    'title'   => 'Polityka wysyłki',
                ],
                'terms-conditions' => [
                    'content' => 'Zawartość strony warunków',
                    'title'   => 'Warunki',
                ],
                'terms-of-use' => [
                    'content' => 'Zawartość strony warunków użytkowania',
                    'title'   => 'Warunki użytkowania',
                ],
                'whats-new' => [
                    'content' => 'Zawartość strony nowości',
                    'title'   => 'Nowości',
                ],
            ],
        ],
        'core' => [
            'channels' => [
                'meta-title'       => 'Demo sklep',
                'meta-keywords'    => 'Demo sklep meta słowa kluczowe',
                'meta-description' => 'Demo sklep meta opis',
                'name'             => 'Domyślny',
            ],
            'currencies' => [
                'AED' => 'Dirham',
                'AFN' => 'Izraelski Szekel',
                'CNY' => 'Chiński Yuan',
                'EUR' => 'Euro',
                'GBP' => 'Funt szterling',
                'INR' => 'Indyjska rupia',
                'IRR' => 'IRA',
                'JPY' => 'Japońska jen',
                'RUB' => 'Rubel rosyjski',
                'SAR' => 'Rijali saudyjski',
                'TRY' => 'Lira turecka',
                'UAH' => 'Hrywna ukraińska',
                'USD' => 'Dolar amerykański',
            ],
        ],
        'customer' => [
            'customer-groups' => [
                'general'   => 'Ogólny',
                'guest'     => 'Gość',
                'wholesale' => 'Hurtowy',
            ],
        ],
        'inventory' => [
            'inventory-sources' => [
                'name' => 'Domyślny',
            ],
        ],
        'shop' => [
            'theme-customizations' => [
                'all-products' => [
                    'name'    => 'Wszystkie produkty',
                    'options' => [
                        'title' => 'Wszystkie produkty',
                    ],
                ],
                'bold-collections' => [
                    'content' => [
                        'btn-title'   => 'Wyświetl wszystkie',
                        'description' => 'Przedstawiamy nową kolekcję Bold! Postaw na odważny styl z wyrazistymi wzorami i kolorami. Zdefiniuj swój wygląd na nowo z odważnymi wzorami i wyrazistymi kolorami. Przygotuj się na wyjątkowe momenty z naszą kolekcją Bold!',
                        'title'       => 'Poznaj nową kolekcję Bold!',
                    ],
                    'name' => 'Kolekcja Bold',
                ],
                'categories-collections' => [
                    'name' => 'Kolekcje kategorii',
                ],
                'featured-collections' => [
                    'name'    => 'Kolekcje polecane',
                    'options' => [
                        'title' => 'Produkty polecane',
                    ],
                ],
                'footer-links' => [
                    'name'    => 'Linki stopki',
                    'options' => [
                        'about-us'         => 'O nas',
                        'contact-us'       => 'Kontakt',
                        'customer-service' => 'Serwis',
                        'payment-policy'   => 'Polityka płatności',
                        'privacy-policy'   => 'Polityka prywatności',
                        'refund-policy'    => 'Polityka zwrotów',
                        'return-policy'    => 'Polityka zwrotów',
                        'shipping-policy'  => 'Polityka wysyłki',
                        'terms-conditions' => 'Warunki',
                        'terms-of-use'     => 'Warunki użytkowania',
                        'whats-new'        => 'Nowości',
                    ],
                ],
                'game-container' => [
                    'content' => [
                        'sub-title-1' => 'Nasze kolekcje',
                        'sub-title-2' => 'Nasze kolekcje',
                        'title'       => 'Przygotuj się do gry z naszymi nowymi dodatkami!',
                    ],
                    'name' => 'Kontener do gry',
                ],
                'image-carousel' => [
                    'name'    => 'Karuzela obrazków',
                    'sliders' => [
                        'title' => 'Przygotuj się na nowe kolekcje',
                    ],
                ],
                'new-products' => [
                    'name'    => 'Nowe produkty',
                    'options' => [
                        'title' => 'Nowe produkty',
                    ],
                ],
                'offer-information' => [
                    'content' => [
                        'title' => 'Do 40% zniżki na pierwsze zamówienia! ZAKUP TERAZ',
                    ],
                    'name' => 'Informacje o ofercie',
                ],
                'services-content' => [
                    'description' => [
                        'emi-available-info'   => 'Dostępne EMI na wszystkie główne karty kredytowe',
                        'free-shipping-info'   => 'Darmowa wysyłka na wszystkie zamówienia',
                        'product-replace-info' => 'Łatwe zamiany dostępne!',
                        'time-support-info'    => 'Dedykowana obsługa 24/7 przez czat i e-mail',
                    ],
                    'name'  => 'Zawartość usług',
                    'title' => [
                        'emi-available'   => 'Dostępne EMI',
                        'free-shipping'   => 'Darmowa wysyłka',
                        'product-replace' => 'Wymiana produktu',
                        'time-support'    => 'Obsługa 24/7',
                    ],
                ],
                'top-collections' => [
                    'content' => [
                        'sub-title-1' => 'Nasze kolekcje',
                        'sub-title-2' => 'Nasze kolekcje',
                        'sub-title-3' => 'Nasze kolekcje',
                        'sub-title-4' => 'Nasze kolekcje',
                        'sub-title-5' => 'Nasze kolekcje',
                        'sub-title-6' => 'Nasze kolekcje',
                        'title'       => 'Przygotuj się do gry z naszymi nowymi dodatkami!',
                    ],
                    'name' => 'Główne kolekcje',
                ],
            ],
        ],
        'user' => [
            'roles' => [
                'description' => 'Ta rola będzie miała wszystkie uprawnienia',
                'name'        => 'Administrator',
            ],
            'users' => [
                'name' => 'Przykład',
            ],
        ],
    ],

    'installer' => [
        'index' => [
            'create-administrator' => [
                'admin'            => 'Administrator',
                'unopim'           => 'UnoPim',
                'confirm-password' => 'Potwierdź hasło',
                'email-address'    => 'admin@example.com',
                'email'            => 'E-mail',
                'password'         => 'Hasło',
                'title'            => 'Utwórz Administratora',
            ],

            'environment-configuration' => [
                'allowed-currencies'  => 'Dozwolone waluty',
                'allowed-locales'     => 'Dozwolone lokalizacje',
                'application-name'    => 'Nazwa aplikacji',
                'unopim'              => 'UnoPim',
                'chinese-yuan'        => 'Chiński Juan (CNY)',
                'database-connection' => 'Połączenie z bazą danych',
                'database-hostname'   => 'Nazwa hosta bazy danych',
                'database-name'       => 'Nazwa bazy danych',
                'database-password'   => 'Hasło do bazy danych',
                'database-port'       => 'Port bazy danych',
                'database-prefix'     => 'Prefix bazy danych',
                'database-username'   => 'Nazwa użytkownika bazy danych',
                'default-currency'    => 'Domyślna waluta',
                'default-locale'      => 'Domyślna lokalizacja',
                'default-timezone'    => 'Domyślna strefa czasowa',
                'default-url-link'    => 'https://localhost',
                'default-url'         => 'Domyślny URL',
                'dirham'              => 'Dirham (AED)',
                'euro'                => 'Euro (EUR)',
                'iranian'             => 'Irański Rial (IRR)',
                'israeli'             => 'Izraelski Szekel (ILS)',
                'japanese-yen'        => 'Japoński Jen (JPY)',
                'mysql'               => 'MySQL',
                'pgsql'               => 'pgSQL',
                'pound'               => 'Brytyjski Funt (GBP)',
                'rupee'               => 'Indyjska Rupia (INR)',
                'russian-ruble'       => 'Rosyjski Rubel (RUB)',
                'saudi'               => 'Saudyjski Rial (SAR)',
                'select-timezone'     => 'Wybierz strefę czasową',
                'sqlsrv'              => 'SQLSRV',
                'title'               => 'Konfiguracja Bazy Danych',
                'turkish-lira'        => 'Turecka Lira (TRY)',
                'ukrainian-hryvnia'   => 'Ukraińska Hrywna (UAH)',
                'usd'                 => 'Dolar Amerykański (USD)',
                'warning-message'     => 'Uwaga! Domyślna lokalizacja i waluta nie mogą być zmienione później.',
            ],

            'installation-processing' => [
                'unopim'      => 'Instalacja UnoPim',
                'unopim-info' => 'Tworzenie tabel w bazie danych, to może chwilę potrwać.',
                'title'       => 'Trwa Instalacja',
            ],

            'installation-completed' => [
                'admin-panel'               => 'Panel Administratora',
                'unopim-forums'             => 'Forum UnoPim',
                'explore-unopim-extensions' => 'Przeglądaj Rozszerzenia UnoPim',
                'title-info'                => 'UnoPim został pomyślnie zainstalowany.',
                'title'                     => 'Instalacja Zakończona',
            ],

            'ready-for-installation' => [
                'create-databsae-table'   => 'Tworzenie tabel bazy danych',
                'install-info-button'     => 'Kliknij przycisk poniżej, aby rozpocząć.',
                'install-info'            => 'Instalacja UnoPim',
                'install'                 => 'Instaluj',
                'populate-database-table' => 'Wypełnianie tabel bazy danych',
                'start-installation'      => 'Rozpocznij instalację',
                'title'                   => 'Gotowy do instalacji',
            ],

            'start' => [
                'locale'        => 'Lokalizacja',
                'main'          => 'Start',
                'select-locale' => 'Wybierz lokalizację',
                'title'         => 'Instalacja UnoPim',
                'welcome-title' => 'Witamy w UnoPim :version',
            ],

            'server-requirements' => [
                'calendar'    => 'Kalendarz',
                'ctype'       => 'cType',
                'curl'        => 'cURL',
                'dom'         => 'DOM',
                'fileinfo'    => 'Informacja o plikach',
                'filter'      => 'Filtr',
                'gd'          => 'GD',
                'hash'        => 'Hash',
                'intl'        => 'Internationalization',
                'json'        => 'JSON',
                'mbstring'    => 'MBString',
                'openssl'     => 'OpenSSL',
                'pcre'        => 'PCRE',
                'pdo'         => 'PDO',
                'php-version' => '8.2 lub nowszy',
                'php'         => 'PHP',
                'session'     => 'Sesja',
                'title'       => 'Wymagania systemowe',
                'tokenizer'   => 'Tokenizer',
                'xml'         => 'XML',
            ],

            'back'                     => 'Wstecz',
            'unopim-info'              => 'Projekt Społecznościowy',
            'unopim-logo'              => 'Logo UnoPim',
            'unopim'                   => 'UnoPim',
            'continue'                 => 'Kontynuuj',
            'installation-description' => 'Instalacja UnoPim składa się z kilku kroków. Oto krótki przegląd:',
            'wizard-language'          => 'Język instalatora',
            'installation-info'        => 'Dziękujemy, że jesteś z nami!',
            'installation-title'       => 'Witamy w instalacji',
            'save-configuration'       => 'Zapisz konfigurację',
            'skip'                     => 'Pomiń',
            'title'                    => 'Instalator UnoPim',
            'webkul'                   => 'Webkul',
        ],
    ],
];
