<?php

return [
    'url'              => [
        'prefix_admin' => 'admin123',
        'prefix_news'  => 'news69',
    ],
    'format'         => [
        'long_time'  => 'H:i:s d/m/Y',
        'short_time' => 'd/m/Y',
    ],
    'template'         => [
        'color'=>['do'=>'#ff502e','vang'=>'#fff600','den'=>'#73777d',
            'xanh'=>'#00c183','hong'=>'#Be25a8','cam'=>'#BE6325','xanh-da-troi'=>'#256dbe'],
        'form_input' => [
            'class' => 'form-control col-md-6 col-xs-12'
        ],
        'form_date_picker' => [
            'class' => 'form-control col-md-6 col-xs-12 datepicker',
        ],
        'form_input_no_padding' => [
            'class' => 'form-control col-md-10 col-xs-12'
        ],
        'form_tag' => [
            'class' => 'form-control col-md-6 col-xs-12 tags',
            'data-role' => 'tagsinput',
        ],
        'form_input_tags' => [
            'class' => 'tags form-control col-md-6 col-xs-12'
        ],
        'form_label' => [
            'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        ],
        'form_label_no_padding' => [
            'class' => 'control-label col-md-2 col-sm-3 col-xs-12'
        ],
        'form_label_edit' => [
            'class' => 'control-label col-md-4 col-sm-3 col-xs-12'
        ],

        'form_ckeditor' => [
            'class' => 'form-control col-md-6 col-xs-12 ckeditor'
        ],
        'status'       => [
            'all'      => ['name' => 'Tất cả', 'class' => 'btn-info'],
            'trash'      => ['name' => 'Chờ xét duyệt', 'class' => 'btn-warning'],
            'accept'      => ['name' => 'Đã duyệt', 'class' => 'btn-success'],
            'active'   => ['name' => 'Kích hoạt', 'class'      => 'btn-success'],
            'inactive' => ['name' => 'Chưa kích hoạt', 'class' => 'btn-danger'],
            'pending' => ['name' => 'Chờ xác nhận', 'class' => 'btn-warning'],
            'cancel' => ['name' => 'Không thể liên lạc', 'class' => 'btn-danger'],
            'confirmed' => ['name' => 'Đã liên hệ', 'class' => 'btn-success'],
            'block'    => ['name' => 'Bị khóa', 'class' => 'btn-danger'],
            'default'  => ['name' => 'Chưa xác định', 'class' => 'btn-danger'],
            'order_pending'  => ['name' => 'Chờ xác nhận đơn', 'class' => 'btn-default'],
            'order_confirmed'  => ['name' => 'Đã xác nhận', 'class' => 'btn-primary'],
            'order_delivery'  => ['name' => 'Đang vận chuyển', 'class' => 'btn-warning'],
            'order_success'  => ['name' => 'Giao thành công', 'class' => 'btn-success'],
            'order_fail'  => ['name' => 'Giao thất bại', 'class' => 'btn-danger'],
        ],
        'is_home'       => [
            'yes' => ['name'=> 'Hiển thị', 'class'=> 'btn-primary'],
            'no'  => ['name'=> 'Không hiển thị', 'class'=> 'btn-warning']
        ],
        'display'       => [
            'list' => ['name'=> 'Danh sách'],
            'grid' => ['name'=> 'Lưới'],
        ],
        'type' => [
            'featured' => ['name'=> 'Nổi bật'],
            'normal'   => ['name'=> 'Bình thường'],
        ],
        'type_menu' => [
            'link'             => ['name' => 'Link'],
            'category_article' => ['name' => 'Danh mục bài viết'],
            'category_product' => ['name'=>'Danh mục sản phẩm']
        ],
        'type_link' => [
            'new_tab' => ['name' => 'Tab mới', 'target' => '_blank'],
            'current' => ['name' => 'Trang hiện tại', 'target' => '_self'],
        ],
        'contact' => [
            'pending' => ['name' => 'Đang chờ duyệt'],
            'confirmed' => ['name' => 'Đã duyệt'],
            'cancel' => ['name' => 'Không thể liên lạc'],
        ],
        'order' => [
            'order_pending' => ['name' => 'Chờ xác nhận'],
            'order_confirmed' => ['name' => 'Đã xác nhận'],
            'order_delivery' => ['name' => 'Đang giao hàng'],
            'order_success' => ['name' => 'Giao hàng thành công'],
            'order_fail' => ['name' => 'Giao hàng thất bại'],
        ],
        'level'       => [
            'admin'  => ['name'=> 'Admin'],
            'writer' => ['name'=> 'Writer'],
            'editor' => ['name'=> 'Editor'],
        ],
        'rss_source' => [
            'vnexpress' => ['name' => 'VNExpress'],
            'cafebiz'   => ['name' => 'CafeBiz'],
            'tuoitre'   => ['name' => 'Tuổi Trẻ'],
        ],
        'search'       =>[
            'all'           => ['name'=> 'Tìm Tất Cả'],
            'id'            => ['name'=> 'Tìm theo ID'],
            'name'          => ['name'=> 'Tìm theo Tên'],
            'product_name'  => ['name'=> 'Tìm theo Tên SP'],
            'customer_name' => ['name'=> 'Tìm theo Tên KH'],
            'address'       => ['name'=> 'Tìm theo Địa chỉ'],
            'username'      => ['name'=> 'Tìm theo Username'],
            'fullname'      => ['name'=> 'Tìm theo Fullname'],
            'email'         => ['name'=> 'Tìm theo Email'],
            'description'   => ['name'=> 'Tìm theo Mô tả'],
            'link'          => ['name'=> 'Tìm theo Link'],
            'content'       => ['name'=> 'Tìm theo Content'],
            'phone'         => ['name'=> 'Tìm theo Số Điện Thoại'],
            'message'       => ['name'=> 'Tìm theo Lời Nhắn'],
            'product_code'  => ['name'=> 'Tìm theo Mã Sản Phẩm'],
            'order_code'    => ['name'=> 'Tìm theo Mã Đơn Hàng'],
            'quantity'      => ['name'=> 'Tìm theo Số Lượng'],
            'price'         => ['name'=> 'Tìm theo Giá Cả'],
            'ip'            => ['name'=> 'Tìm theo Ip'],

        ],
        'button' => [
            'edit'      => ['class'=> 'btn-primary' , 'title'=> 'Edit'      , 'icon' => 'fa-pencil' , 'route-name' => '/form'],
            'delete'    => ['class'=> 'btn-danger btn-delete'  , 'title'=> 'Delete'    , 'icon' => 'fa-trash'  , 'route-name' => '/delete'],
            'info'      => ['class'=> 'btn-info'    , 'title'=> 'View'      , 'icon' => 'fa-eye' , 'route-name' => '/view'],
        ]

    ],
    'path' => [
        'gallery' => 'images/gallery/'
    ],
    'config' => [
        'search' => [
            'slider'      => ['all', 'name', 'link'],
            'category'    => ['all', 'name'],
            'article'     => ['all', 'name'],
            'user'        => ['all', 'username', 'email'],
            'menu'        => ['all', 'name', 'link'],
            'cart'        => ['all', 'order_code', 'customer_name', 'email', 'address', 'product_name', 'quantity', 'price'],
            'testimonial' => ['all', 'name'],
            'contact'     => ['all', 'email'],
            'product'     => ['all','product_code','name'],
            'attribute'   => ['all','name'],
            'rating'     => ['all','product_code','product_name','email','ip'],
            'default'     => ['all', 'id'],

        ],
        'button' => [
            'default'        => ['edit', 'delete'],
            'user'           => ['edit'],
            'subscribe'           => ['edit'],
            'order'       => ['info', 'delete'],
            'cart'           => [ 'info'],
            'contact'        => [ 'delete'],
        ]
    ],
    'notify' => [
        'success' => [
            'update' => 'Cập nhật thành công!'
        ]
    ]

];