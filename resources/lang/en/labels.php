<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => 'All',
        'yes' => 'Yes',
        'no' => 'No',
        'copyright' => 'Copyright',
        'custom' => 'Custom',
        'actions' => 'Actions',
        'active' => 'Active',
        'select_option' => 'Select a option',
        'empty' => 'emtpy',
        'account' => 'Account',
        'buttons' => [
            'save' => 'Save',
            'update' => 'Update',
            'close' => 'Close',
            'add' => 'Add',
        ],
        'hide' => 'Hide',
        'inactive' => 'Inactive',
        'none' => 'None',
        'show' => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
        'create_new' => 'Create New',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more' => 'More',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions' => 'Permissions',
                    'role' => 'Role',
                    'sort' => 'Sort',
                    'total' => 'role total|roles total',
                ],
            ],

            'regulation' => [
                'create' => 'Create regulation',
                'edit' => 'Edit regulation',
                'management' => 'Rules and regulations management',

                'table' => [
                    'sort' => 'sort',
                    'last_updated' => 'Last updated',
                ],
            ],

            'class' => [
                'create' => 'Create class',
                'edit' => 'Edit class',
                'management' => 'Class management',

                'table' => [
                    'name' => 'Name',
                    'section' => 'Section',
                    'tag' => 'Tag',
                    'schedule' => 'Schedule',
                    'days' => 'Days',
                    'classroom_type' => 'Class type',
                    'student' => 'Student',
                    'instructor' => 'Instructor',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'section' => [
                'create' => 'Create section',
                'edit' => 'Edit section',
                'management' => 'Sections management',

                'table' => [
                    'id' => 'Id',
                    'name' => 'Name',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'note' => [
                'create' => 'Create note',
                'edit' => 'Edit note',
                'management' => 'Notes management',
                'management_general' => 'General notes management',
                'management_personal' => 'Personal notes management',
                'note' => 'notes',
                
                'table' => [
                    'id' => 'Id',
                    'name' => 'Name',
                    'content' => 'Content',
                    'personal' => 'Personal note',
                    'general' => 'General note',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'created_by' => 'Created by',
                    'total' => 'Total',
                ],
            ],

            'method' => [
                'create' => 'Create payment method',
                'edit' => 'Edit payment method',
                'management' => 'Payment method management',

                'table' => [
                    'name' => 'Name',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'school' => [
                'create' => 'Create school',
                'edit' => 'Edit school',
                'management' => 'Schools management',
                'image_upload' => 'Upload image',
                'change_image' => 'Change image',
                'choose_file' => 'choose a file (max: 2048 kB)',

                'table' => [
                    'id' => 'Id',
                    'name' => 'Name',
                    'image' => 'Image',
                    'address' => 'Address',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],


            'cms_support' => [
                'create' => 'Create cms page',
                'edit' => 'Edit cms page',
                'management' => 'Cms page management',

                'table' => [
                    'name' => 'Name',
                    'image' => 'Image',
                    'address' => 'Address',
                    'slug' => 'slug',
                    'title' => 'Title',
                    'content' => 'Content',
                    'meta_title' => 'Meta title',
                    'meta_description' => 'Meta description',
                    'meta_keywords' => 'Meta keywords',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'cms_gallery' => [
                'create' => 'Create image',
                'edit' => 'Edit image',
                'management' => 'Gallery management',
                'image_upload' => 'Upload image',
                'change_image' => 'Change image',
                'choose_file' => 'choose a file (max: 2048 kB)',
                'table' => [
                    'title' => 'Title',
                    'image' => 'Image',
                    'address' => 'Address',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'cms_schedule' => [
                'create' => 'Create schedule',
                'edit' => 'Edit schedule',
                'management' => 'Schedule management',
                'image_upload' => 'upload image',
                'choose_file' => 'choose a file',

                'table' => [
                    'name' => 'name',
                    'image' => 'Image',
                    'schedule' => 'Schedule',
                    'mon' => 'Monday',
                    'tue' => 'Tuesday',
                    'wed' => 'Wednesday',
                    'thu' => 'Thursday',
                    'fri' => 'Friday',
                    'sat' => 'Saturday',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'cms_staff' => [
                'create' => 'Create staff',
                'edit' => 'Edit staff',
                'management' => 'Staff management',
                'image_upload' => 'Upload image',
                'choose_file' => 'choose a file',

                'table' => [
                    'name' => 'Name',
                    'image' => 'Image',
                    'address' => 'Address',
                    'job' => 'Job',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],


            'product' => [
                'create' => 'Create product',
                'edit' => 'Edit product',
                'add_quantity' => 'Add/Subtract (+/-)',
                'management' => 'Product management',

                'table' => [
                    'name' => 'Name',
                    'image' => 'Image',
                    'code' => 'Code',
                    'quantity' => 'Quantity',
                    'actually_quantity' => 'Inital quantity',
                    'price' => 'Price',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],



            'service' => [
                'create' => 'Create service',
                'edit' => 'Edit service',
                'management' => 'Service management',

                'table' => [
                    'name' => 'Name',
                    'image' => 'Image',
                    'code' => 'Code',
                    'price' => 'Price',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'sell' => [
                'id' => 'ID',
                'create' => 'Create sale',
                'edit' => 'Edit sale',
                'add' => 'Add',
                'view' => 'View sale',
                'management' => 'Sale management',
                'go_list_sale' => 'Go to the sale list',
                'print' => 'Print',
                'sale' => 'Sale',
                'sale_to' => 'Sale to',
                'issued_by' => 'Issued by',
                'payment_type' => 'Payment type',
                'print_last_sale' => 'Print last sale',
                'list_sale' => 'List sale',
                'last' => 'Last',
                'sale_setting' => 'sale setting',
                'enter_user' => 'Enter user',
                'enter_payment_type' => 'Enter payment type',
                'text_ticket' => 'Add text ticket',
                'product' => 'product',
                'product_service' => 'Product o service',
                'service' => 'Service',
                'user' => 'User',
                'payment_method' => 'Payment method',

                'table' => [
                    'id' => 'Id',
                    'name' => 'Name',
                    'image' => 'Image',
                    'address' => 'Address',
                    'concept' => 'Concept',
                    'price' => 'Price',
                    'quantity' => 'Quantity',
                    'total_sale' => 'Total',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'generated_by' => 'Generated by',
                    'total' => 'Total',
                ],
            ],

            'tag' => [
                'create' => 'Create tag',
                'edit' => 'Edit tag',
                'management' => 'Tag management',

                'table' => [
                    'id' => 'id',
                    'name' => 'Name',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],



            'subscription' => [
                'subscription' => 'Inscription',
                'create' => 'Create inscription',
                'edit' => 'Edit inscription',
                'management' => 'Inscription management',
                'view' => 'View inscription',
                'view_payments' => 'View monthly payment',
                'payment' => 'Monthly payment',
                'add_payment' => 'Add monthly payment',
                'print' => 'Print inscription',
                'details' => 'Details inscription',
                'info_user' => 'Info user',
                'delete' => 'Delete',
                'table' => [
                    'id' => 'ID',
                    'name' => 'Name',
                    'email' => 'Email',
                    'sort' => 'Sort',
                    'user' => 'User',
                    'start' => 'Initial',
                    'end' => 'Final',
                    'price' => 'Price',
                    'tags' => 'Tags',
                    'comment' => 'Comment',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'last_payment_date' => 'Last monthly payment',
                    'generated_by' => 'Generated by',
                    'days_left' => 'days left',
                    'past_due' => 'past due',
                    'no_data' => 'no data',
                    'total' => 'Total',
              ],
            ],

            'payment' => [
                'create' => 'Create payment monthly',
                'edit' => 'Edit payment monthly',
                'management' => 'Payment monthly management',

                'table' => [
                    'name' => 'Name',
                    'sort' => 'Sort',
                    'user' => 'User',
                    'start' => 'Initial',
                    'end' => 'Final',
                    'price' => 'Price',
                    'tag' => 'Tag',
                    'comment' => 'Comment',
                    'last_updated' => 'Last updated',
                    'generated_by' => 'Generated by',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'type' => [
                'create' => 'Create class type',
                'edit' => 'Edit class type',
                'management' => 'Class type management',

                'table' => [
                    'id' => 'Id',
                    'name' => 'Name',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'customer' => [
                'create' => 'Assign student',
                'edit' => 'Edit ',
                'management' => 'Student management',

                'table' => [
                    'name' => 'Name',
                    'section' => 'Section',
                    'student' => 'Student',
                    'class' => 'Class',
                    'class_type' => 'Class type',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                ],
            ],

            'expense' => [
                'create' => 'Create expense',
                'edit' => 'Edit expense',
                'add_stock' => 'Add stock',
                'management' => 'Expense management',

                'table' => [
                    'id' => 'ID',
                    'name' => 'Concept',
                    'image' => 'Image',
                    'code' => 'Code',
                    'quantity' => 'Quantity',
                    'actually_quantity' => 'Actual quantity',
                    'add_quantity' => 'Add quantity',
                    'price' => 'Price',
                    'comment' => 'Comment',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'income' => [
                'create' => 'Create income',
                'edit' => 'Edit income',
                'add_stock' => 'Add stock',
                'management' => 'Income management',

                'table' => [
                    'id' => 'ID',
                    'name' => 'Concept',
                    'image' => 'Image',
                    'code' => 'Code',
                    'quantity' => 'Quantity',
                    'actually_quantity' => 'Acutal quantity',
                    'add_quantity' => 'Add quantity',
                    'price' => 'Price',
                    'comment' => 'Comment',
                    'sort' => 'Sort',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],


            'cash_out' => [
                'create' => 'Create cash out',
                'edit' => 'Edit cash out',
                'edit_quantity' => 'Edit initual quantity',
                'management' => 'Cash out management',

                'table' => [
                    'id' => 'ID',
                    'name' => 'Concept',
                    'image' => 'Image',
                    'code' => 'Code',
                    'quantity' => 'Quantity',
                    'initial_quantity' => 'Initial quantity',
                    'actually_quantity' => 'Current quantity',
                    'cash_out_initial' => 'Initial cash out',
                    'cash_out_final' => 'Final cash out',
                    'withdrawal' => 'Withdrawal',
                    'cash_out_remaining' => 'Remainging cash out',
                    'add_quantity' => 'Add quantity',
                    'price' => 'Price',
                    'comment' => 'Comment',
                    'sort' => 'Sort',
                    'sales' => 'Sales',
                    'inscriptions' => 'Inscriptions',
                    'monthly_payments' => 'Monthly payments',
                    'incomes' => 'Incomes',
                    'expenses' => 'Expenses',
                    'make_cash_out' => 'Make cash out',
                    'last_updated' => 'Last updated',
                    'created' => 'Created',
                    'total' => 'Total',
                ],
            ],

            'users' => [
                'active' => 'Active Users',
                'all_permissions' => 'All Permissions',
                'change_password' => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'management' => 'User Management',
                'no_permissions' => 'No Permissions',
                'no_roles' => 'No Roles to set.',
                'permissions' => 'Permissions',
                'user_actions' => 'Acciones de',
                'user' => 'User',
                'school' => 'School',
                'table' => [
                    'confirmed' => 'Confirmed',
                    'created' => 'Created',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Name',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted' => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'abilities' => 'Abilities',
                    'roles' => 'Roles',
                    'social' => 'Social',
                    'total' => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history' => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'Avatar',
                            'confirmed' => 'Confirmed',
                            'created_at' => 'Created At',
                            'deleted_at' => 'Deleted At',
                            'email' => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Last Updated',
                            'name' => 'Name',
                            'first_name' => 'First Name',
                            'last_name' => 'Last Name',
                            'status' => 'Status',
                            'timezone' => 'Timezone',
                            'phone' => 'Phone',
                            'age' => 'Age',
                            'years_old' => 'yeras old',
                            'address' => 'Address',
                            'blood' => 'Blood type',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'Login',
            'login_button' => 'Login',
            'login_with' => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button' => 'Register',
            'remember_me' => 'Remember Me',
            'welcome_to' => 'Welcome to ',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'schedule' => [
            'box_title' => 'Schedule',
            'our_schedule' => 'Our schedule',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password' => 'Forgot Your Password?',
            'reset_password_box_title' => 'Reset Password',
            'reset_password_button' => 'Reset Password',
            'update_password_button' => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'hi' => 'Hi, I am',
                'avatar' => 'Avatar',
                'upload' => 'Upload',
                'phone' => 'Phone',
                'age' => 'Age',
                'school' => 'School',
                'grade' => 'Grade',
                'address' => 'Address',
                'blood' => 'Blood type',
                'created_at' => 'Created At',
                'edit_information' => 'Edit Information',
                'email' => 'E-mail',
                'last_updated' => 'Last Updated',
                'name' => 'Name',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],
    ],
];
