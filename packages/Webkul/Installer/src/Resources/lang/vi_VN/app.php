<?php

return [
    'seeders' => [
        'attribute' => [
            'attribute-families' => 'Các gia đình thuộc tính',
            'attribute-groups'   => [
                'description'      => 'Mô tả',
                'general'          => 'Tổng quát',
                'inventories'      => 'Kho hàng',
                'meta-description' => 'Mô tả meta',
                'price'            => 'Giá',
                'technical'        => 'Kỹ thuật',
                'shipping'         => 'Vận chuyển',
            ],
            'attributes' => [
                'brand'                => 'Thương hiệu',
                'color'                => 'Màu sắc',
                'cost'                 => 'Chi phí',
                'description'          => 'Mô tả',
                'featured'             => 'Nổi bật',
                'guest-checkout'       => 'Thanh toán cho khách hàng',
                'height'               => 'Chiều cao',
                'length'               => 'Chiều dài',
                'manage-stock'         => 'Quản lý kho hàng',
                'meta-description'     => 'Mô tả meta',
                'meta-keywords'        => 'Từ khóa meta',
                'meta-title'           => 'Tiêu đề meta',
                'name'                 => 'Tên',
                'new'                  => 'Mới',
                'price'                => 'Giá',
                'product-number'       => 'Số sản phẩm',
                'short-description'    => 'Mô tả ngắn',
                'size'                 => 'Kích cỡ',
                'sku'                  => 'SKU',
                'special-price-from'   => 'Giá đặc biệt từ',
                'special-price-to'     => 'Giá đặc biệt đến',
                'special-price'        => 'Giá đặc biệt',
                'status'               => 'Trạng thái',
                'tax-category'         => 'Danh mục thuế',
                'url-key'              => 'Khóa URL',
                'visible-individually' => 'Hiển thị riêng biệt',
                'weight'               => 'Cân nặng',
                'width'                => 'Chiều rộng',
            ],
            'attribute-options' => [
                'black'  => 'Đen',
                'green'  => 'Xanh lá cây',
                'l'      => 'L',
                'm'      => 'M',
                'red'    => 'Đỏ',
                's'      => 'S',
                'white'  => 'Trắng',
                'xl'     => 'XL',
                'yellow' => 'Vàng',
            ],
        ],
        'category' => [
            'categories' => [
                'description' => 'Mô tả danh mục',
                'name'        => 'Danh mục chính',
            ],
            'category_fields' => [
                'name'        => 'Tên',
                'description' => 'Mô tả',
            ],
        ],
        'cms' => [
            'pages' => [
                'about-us' => [
                    'content' => 'Nội dung trang giới thiệu',
                    'title'   => 'Về chúng tôi',
                ],
                'contact-us' => [
                    'content' => 'Nội dung trang liên hệ',
                    'title'   => 'Liên hệ với chúng tôi',
                ],
                'customer-service' => [
                    'content' => 'Nội dung trang dịch vụ khách hàng',
                    'title'   => 'Dịch vụ khách hàng',
                ],
                'payment-policy' => [
                    'content' => 'Nội dung trang chính sách thanh toán',
                    'title'   => 'Chính sách thanh toán',
                ],
                'privacy-policy' => [
                    'content' => 'Nội dung trang chính sách bảo mật',
                    'title'   => 'Chính sách bảo mật',
                ],
                'refund-policy' => [
                    'content' => 'Nội dung trang chính sách hoàn trả',
                    'title'   => 'Chính sách hoàn trả',
                ],
                'return-policy' => [
                    'content' => 'Nội dung trang chính sách trả hàng',
                    'title'   => 'Chính sách trả hàng',
                ],
                'shipping-policy' => [
                    'content' => 'Nội dung trang chính sách vận chuyển',
                    'title'   => 'Chính sách vận chuyển',
                ],
                'terms-conditions' => [
                    'content' => 'Nội dung trang điều khoản',
                    'title'   => 'Điều khoản và điều kiện',
                ],
                'terms-of-use' => [
                    'content' => 'Nội dung trang điều khoản sử dụng',
                    'title'   => 'Điều khoản sử dụng',
                ],
                'whats-new' => [
                    'content' => 'Nội dung trang cập nhật mới',
                    'title'   => 'Cập nhật mới',
                ],
            ],
        ],
        'core' => [
            'channels' => [
                'meta-title'       => 'Cửa hàng Demo',
                'meta-keywords'    => 'Từ khóa meta của cửa hàng Demo',
                'meta-description' => 'Mô tả meta của cửa hàng Demo',
                'name'             => 'Chuẩn',
            ],
            'currencies' => [
                'AED' => 'Dirham',
                'AFN' => 'Afghani',
                'CNY' => 'Nhân dân tệ',
                'EUR' => 'Euro',
                'GBP' => 'Bảng Anh',
                'INR' => 'Rupee Ấn Độ',
                'IRR' => 'Rial Iran',
                'JPY' => 'Yên Nhật',
                'RUB' => 'Rúp Nga',
                'SAR' => 'Riyal Ả Rập Saudi',
                'TRY' => 'Lira Thổ Nhĩ Kỳ',
                'UAH' => 'Hryvnia Ukraine',
                'USD' => 'Đô la Mỹ',
            ],
        ],
        'customer' => [
            'customer-groups' => [
                'general'   => 'Chung',
                'guest'     => 'Khách hàng',
                'wholesale' => 'Bán buôn',
            ],
        ],
        'inventory' => [
            'inventory-sources' => [
                'name' => 'Chuẩn',
            ],
        ],
        'shop' => [
            'theme-customizations' => [
                'all-products' => [
                    'name'    => 'Tất cả sản phẩm',
                    'options' => [
                        'title' => 'Tất cả sản phẩm',
                    ],
                ],
                'bold-collections' => [
                    'content' => [
                        'btn-title'   => 'Xem tất cả',
                        'description' => 'Khám phá các bộ sưu tập mới mẻ của chúng tôi! Tăng cường phong cách của bạn bằng cách thêm màu sắc tươi sáng và thiết kế táo bạo. Hãy làm phong phú thêm tủ đồ của bạn với những họa tiết tươi sáng và màu sắc đậm. Chuẩn bị để bắt đầu hành trình táo bạo của bạn!',
                        'title'       => 'Chuẩn bị cho các bộ sưu tập táo bạo mới của chúng tôi!',
                    ],
                    'name' => 'Bộ sưu tập táo bạo',
                ],
                'categories-collections' => [
                    'name' => 'Bộ sưu tập theo danh mục',
                ],
                'featured-collections' => [
                    'name'    => 'Bộ sưu tập nổi bật',
                    'options' => [
                        'title' => 'Sản phẩm nổi bật',
                    ],
                ],
                'footer-links' => [
                    'name'    => 'Liên kết chân trang',
                    'options' => [
                        'about-us'         => 'Về chúng tôi',
                        'contact-us'       => 'Liên hệ với chúng tôi',
                        'customer-service' => 'Dịch vụ khách hàng',
                        'payment-policy'   => 'Chính sách thanh toán',
                        'privacy-policy'   => 'Chính sách bảo mật',
                        'refund-policy'    => 'Chính sách hoàn trả',
                        'return-policy'    => 'Chính sách trả hàng',
                        'shipping-policy'  => 'Chính sách vận chuyển',
                        'terms-conditions' => 'Điều khoản và điều kiện',
                        'terms-of-use'     => 'Điều khoản sử dụng',
                        'whats-new'        => 'Cập nhật mới',
                    ],
                ],
                'game-container' => [
                    'content' => [
                        'sub-title-1' => 'Các bộ sưu tập của chúng tôi',
                        'sub-title-2' => 'Các bộ sưu tập của chúng tôi',
                        'title'       => 'Chơi với các sản phẩm mới!',
                    ],
                    'name' => 'Container trò chơi',
                ],
                'image-carousel' => [
                    'name'    => 'Carousel hình ảnh',
                    'sliders' => [
                        'title' => 'Chuẩn bị cho bộ sưu tập mới',
                    ],
                ],
                'new-products' => [
                    'name'    => 'Sản phẩm mới',
                    'options' => [
                        'title' => 'Sản phẩm mới',
                    ],
                ],
                'offer-information' => [
                    'content' => [
                        'title' => 'BẮT ĐẦU DUYỆT VỚI %40 GIẢM GIÁ CHO MUA HÀNG ĐẦU TIÊN CỦA BẠN!',
                    ],
                    'name' => 'Thông tin về ưu đãi',
                ],
                'services-content' => [
                    'description' => [
                        'emi-available-info'   => 'Có cơ hội tài chính miễn phí cho tất cả các thẻ tín dụng chính',
                        'free-shipping-info'   => 'Giao hàng miễn phí cho tất cả các đơn hàng',
                        'product-replace-info' => 'Thay thế sản phẩm dễ dàng!',
                        'time-support-info'    => 'Hỗ trợ đặc biệt 24/7 qua trò chuyện trực tuyến và email',
                    ],
                    'name'  => 'Nội dung dịch vụ',
                    'title' => [
                        'emi-available'   => 'Tài chính miễn phí',
                        'free-shipping'   => 'Giao hàng miễn phí',
                        'product-replace' => 'Thay thế sản phẩm',
                        'time-support'    => 'Hỗ trợ 24/7',
                    ],
                ],
                'top-collections' => [
                    'content' => [
                        'sub-title-1' => 'Các bộ sưu tập của chúng tôi',
                        'sub-title-2' => 'Các bộ sưu tập của chúng tôi',
                        'sub-title-3' => 'Các bộ sưu tập của chúng tôi',
                        'sub-title-4' => 'Các bộ sưu tập của chúng tôi',
                        'sub-title-5' => 'Các bộ sưu tập của chúng tôi',
                        'sub-title-6' => 'Các bộ sưu tập của chúng tôi',
                        'title'       => 'Chơi với các sản phẩm mới!',
                    ],
                    'name' => 'Các bộ sưu tập nổi bật',
                ],
            ],
        ],
        'user' => [
            'roles' => [
                'description' => 'Vai trò này sẽ có quyền truy cập vào tất cả các tính năng',
                'name'        => 'Quản trị viên',
            ],
            'users' => [
                'name' => 'Ví dụ',
            ],
        ],
    ],

    'installer' => [
        'index' => [
            'create-administrator' => [
                'admin'            => 'Quản trị viên',
                'unopim'           => 'UnoPim',
                'confirm-password' => 'Xác nhận mật khẩu',
                'email-address'    => 'admin@example.com',
                'email'            => 'Email',
                'password'         => 'Mật khẩu',
                'title'            => 'Tạo quản trị viên',
            ],

            'environment-configuration' => [
                'allowed-currencies'  => 'Đồng tiền được phép',
                'allowed-locales'     => 'Các địa phương được phép',
                'application-name'    => 'Tên ứng dụng',
                'unopim'              => 'UnoPim',
                'chinese-yuan'        => 'Nhân dân tệ Trung Quốc (CNY)',
                'database-connection' => 'Kết nối cơ sở dữ liệu',
                'database-hostname'   => 'Tên máy chủ cơ sở dữ liệu',
                'database-name'       => 'Tên cơ sở dữ liệu',
                'database-password'   => 'Mật khẩu cơ sở dữ liệu',
                'database-port'       => 'Cổng cơ sở dữ liệu',
                'database-prefix'     => 'Tiền tố cơ sở dữ liệu',
                'database-username'   => 'Tên người dùng cơ sở dữ liệu',
                'default-currency'    => 'Đồng tiền mặc định',
                'default-locale'      => 'Địa phương mặc định',
                'default-timezone'    => 'Múi giờ mặc định',
                'default-url-link'    => 'https://localhost',
                'default-url'         => 'URL mặc định',
                'dirham'              => 'Dirham (AED)',
                'euro'                => 'Euro (EUR)',
                'iranian'             => 'Rial Iran (IRR)',
                'israeli'             => 'Shekel Israel (ILS)',
                'japanese-yen'        => 'Yên Nhật (JPY)',
                'mysql'               => 'MySQL',
                'pgsql'               => 'pgSQL',
                'pound'               => 'Bảng Anh (GBP)',
                'rupee'               => 'Rupee Ấn Độ (INR)',
                'russian-ruble'       => 'Rúp Nga (RUB)',
                'saudi'               => 'Riyal Ả Rập Saudi (SAR)',
                'select-timezone'     => 'Chọn múi giờ',
                'sqlsrv'              => 'SQLSRV',
                'title'               => 'Kết nối cơ sở dữ liệu',
                'turkish-lira'        => 'Lira Thổ Nhĩ Kỳ (TRY)',
                'ukrainian-hryvnia'   => 'Hryvnia Ukraine (UAH)',
                'usd'                 => 'Đô la Mỹ (USD)',
                'warning-message'     => 'Cảnh báo! Cấu hình này sẽ không thể thay đổi sau này.',
            ],

            'installation-processing' => [
                'unopim'      => 'Cài đặt UnoPim',
                'unopim-info' => 'Đang tạo các bảng cơ sở dữ liệu, điều này có thể mất vài phút.',
                'title'       => 'Quá trình cài đặt',
            ],

            'installation-completed' => [
                'admin-panel'               => 'Bảng điều khiển quản trị',
                'unopim-forums'             => 'Diễn đàn UnoPim',
                'explore-unopim-extensions' => 'Khám phá các tiện ích mở rộng UnoPim',
                'title-info'                => 'UnoPim đã được cài đặt thành công.',
                'title'                     => 'Cài đặt hoàn tất',
            ],

            'ready-for-installation' => [
                'create-databsae-table'   => 'Tạo bảng cơ sở dữ liệu',
                'install-info-button'     => 'Nhấn nút bên dưới để bắt đầu',
                'install-info'            => 'cài đặt UnoPim',
                'install'                 => 'Cài đặt',
                'populate-database-table' => 'Điền các bảng cơ sở dữ liệu',
                'start-installation'      => 'Bắt đầu cài đặt',
                'title'                   => 'Sẵn sàng cho cài đặt',
            ],

            'start' => [
                'locale'        => 'Ngôn ngữ',
                'main'          => 'Trang chủ',
                'select-locale' => 'Chọn ngôn ngữ',
                'title'         => 'Cài đặt UnoPim',
                'welcome-title' => 'Chào mừng bạn đến với UnoPim :version',
            ],

            'server-requirements' => [
                'calendar'    => 'Lịch',
                'ctype'       => 'cType',
                'curl'        => 'cURL',
                'dom'         => 'DOM',
                'fileinfo'    => 'Thông tin tệp',
                'filter'      => 'Lọc',
                'gd'          => 'GD',
                'hash'        => 'Băm',
                'intl'        => 'Intl',
                'json'        => 'JSON',
                'mbstring'    => 'MbString',
                'openssl'     => 'OpenSSL',
                'pcre'        => 'PCRE',
                'pdo'         => 'PDO',
                'php-version' => '8.2 hoặc cao hơn',
                'php'         => 'PHP',
                'session'     => 'Phiên',
                'title'       => 'Yêu cầu hệ thống',
                'tokenizer'   => 'Bộ phân tách từ',
                'xml'         => 'XML',
            ],

            'back'                     => 'Trở lại',
            'unopim-info'              => 'Dự án cộng đồng',
            'unopim-logo'              => 'Logo UnoPim',
            'unopim'                   => 'UnoPim',
            'continue'                 => 'Tiếp tục',
            'installation-description' => 'Quá trình cài đặt UnoPim bao gồm một số bước. Đây là tổng quan:',
            'wizard-language'          => 'Ngôn ngữ của Trình hướng dẫn cài đặt',
            'installation-info'        => 'Cảm ơn bạn đã gia nhập!',
            'installation-title'       => 'Cài đặt UnoPim',
            'save-configuration'       => 'Lưu cấu hình',
            'skip'                     => 'Bỏ qua',
            'title'                    => 'Trình hướng dẫn cài đặt UnoPim',
            'webkul'                   => 'Webkul',
        ],
    ],
];
