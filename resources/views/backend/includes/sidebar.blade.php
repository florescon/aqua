<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Active::checkUriPattern('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <li class="nav-title">
                @lang('menus.backend.sidebar.system')
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{
                    active_class(Active::checkUriPattern('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Active::checkUriPattern('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Active::checkUriPattern('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Active::checkUriPattern('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{
                    active_class(Active::checkUriPattern('admin/log-viewer*'), 'open')
                }}">
                        <a class="nav-link nav-dropdown-toggle {{
                            active_class(Active::checkUriPattern('admin/log-viewer*'))
                        }}" href="#">
                        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/log-viewer'))
                        }}" href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/log-viewer/logs*'))
                        }}" href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @can('clientes')
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Active::checkUriPattern('admin/customer'))
                }}" href="{{ route('admin.customer.index') }}">
                    <i class="nav-icon far fa-user-circle"> </i>
                    @lang('menus.backend.sidebar.customers')
                </a>
            </li>
            @endcan

            @canany(['secciones', 'tipo de clase', 'etiquetas de clases', 'clases'])
            <li class="nav-item nav-dropdown {{
                active_class(Active::checkUriPattern('admin/class*'), 'open')
            }}">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Active::checkUriPattern('admin/class*'))
                }}" href="#">
                    <i class="nav-icon far fa-address-book"></i>
                    @lang('menus.backend.sidebar.classroom')
                </a>

                <ul class="nav-dropdown-items">

                    @can('secciones')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/class/section*'))
                        }}" href="{{ route('admin.class.section.index') }}">
                            @lang('menus.backend.sidebar.sections')
                        </a>
                    </li>
                    @endcan

                    @can('tipo de clase')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/class/type*'))
                        }}" href="{{ route('admin.class.type.index') }}">
                            @lang('menus.backend.sidebar.classroom_type')
                        </a>
                    </li>
                    @endcan

                    @can('etiquetas de clases')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/class/tags'))
                        }}" href="{{ route('admin.class.tag.index') }}">
                            @lang('menus.backend.sidebar.tags')
                        </a>
                    </li>
                    @endcan

                    @can('clases')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/class/class*'))
                        }}" href="{{ route('admin.class.class.index') }}">
                            @lang('menus.backend.sidebar.classroom')
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            <li class="divider"></li>

            @canany(['suscripciones', 'etiquetas de mensualidades'])
            <li class="nav-item nav-dropdown {{
                active_class(Active::checkUriPattern('admin/subscription*'), 'open')
            }}">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Active::checkUriPattern('admin/subscription*'))
                }}" href="#">
                    <i class="nav-icon fa fa-credit-card"> </i>
                    @lang('menus.backend.sidebar.subscriptions')
                </a>

                <ul class="nav-dropdown-items">

                    @can('etiquetas de mensualidades')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/subscription/tags'))
                        }}" href="{{ route('admin.subscription.tag.index') }}">
                            @lang('menus.backend.sidebar.tags')
                        </a>
                    </li>
                    @endcan

                    @can('suscripciones')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/subscription/subscription*'))
                        }}" href="{{ route('admin.subscription.subscription.index') }}">
                            @lang('menus.backend.sidebar.subscriptions')
                        </a>
                    </li>
                    @endcan

                    @can('mensualidades')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/subscription/payment*'))
                        }}" href="{{ route('admin.subscription.payment.index') }}">
                            @lang('menus.backend.sidebar.payments_monthly')
                        </a>
                    </li>
                    @endcan
               </ul>
            </li>
            @endcanany


            @canany(['cms soporte', 'cms galeria', 'cms personal', 'cms paginas', 'cms horario'])
            <li class="nav-item nav-dropdown {{
                active_class(Active::checkUriPattern('admin/cms*'), 'open')
            }}">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Active::checkUriPattern('admin/cms*'))
                }}" href="#">
                    <i class="nav-icon fa fa-cloud"> </i>
                    @lang('menus.backend.sidebar.cms')
                </a>

                <ul class="nav-dropdown-items">

                    @can('cms soporte')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/cms/support*'))
                        }}" href="{{ route('admin.cms.support.index') }}">
                            @lang('menus.backend.sidebar.cms_support')
                        </a>
                    </li>
                    @endcan

                    @can('cms galeria')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/cms/gallery*'))
                        }}" href="{{ route('admin.cms.gallery.index') }}">
                            @lang('menus.backend.sidebar.cms_gallery')
                        </a>
                    </li>
                    @endcan

                    @can('cms personal')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/cms/staff*'))
                        }}" href="{{ route('admin.cms.staff.index') }}">
                            @lang('menus.backend.sidebar.cms_staff')
                        </a>
                    </li>
                    @endcan

                    @can('cms paginas')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/cms/pages*'))
                        }}" href="{{ route('admin.cms.pages.index') }}">
                            @lang('menus.backend.sidebar.cms_pages')
                        </a>
                    </li>
                    @endcan

                    @can('cms horario')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/cms/schedule*'))
                        }}" href="{{ route('admin.cms.schedule.index') }}">
                            @lang('menus.backend.sidebar.cms_schedule')
                        </a>
                    </li>
                    @endcan
               </ul>
            </li>
            @endcanany


            @canany(['productos', 'servicios', 'generar venta', 'ver ventas'])
            <li class="nav-item nav-dropdown {{
                active_class(Active::checkUriPattern('admin/inventory*'), 'open')
            }}">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Active::checkUriPattern('admin/inventory*'))
                }}" href="#">
                    <i class="nav-icon fa fa-shopping-cart"> </i>
                    @lang('menus.backend.sidebar.inventory')
                </a>

                <ul class="nav-dropdown-items">

                    @can('productos')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/inventory/product'))
                        }}" href="{{ route('admin.inventory.product.index') }}">
                            @lang('menus.backend.sidebar.products')
                        </a>
                    </li>
                    @endcan

                    @can('servicios')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/inventory/service'))
                        }}" href="{{ route('admin.inventory.service.index') }}">
                            @lang('menus.backend.sidebar.services')
                        </a>
                    </li>
                    @endcan
                    
                    @can('generar venta')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/inventory/sell*'))
                        }}" href="{{ route('admin.inventory.sell.index') }}">
                            @lang('menus.backend.sidebar.sells')
                        </a>
                    </li>
                    @endcan
               </ul>
            </li>
            @endcanany


            @canany(['egresos', 'ingresos', 'caja chica', 'corte de caja'])
            <li class="nav-item nav-dropdown {{
                active_class(Active::checkUriPattern('admin/transaction*'), 'open')
            }}">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Active::checkUriPattern('admin/transaction*'))
                }}" href="#">
                    <i class="nav-icon fa fa-dollar-sign"> </i>
                    @lang('menus.backend.sidebar.transactions')
                </a>

                <ul class="nav-dropdown-items">

                    @can('egresos')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/transaction/expense'))
                        }}" href="{{ route('admin.transaction.expense.index') }}">
                            @lang('menus.backend.sidebar.expenses')
                        </a>
                    </li>
                    @endcan

                    @can('ingresos')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/transaction/income*'))
                        }}" href="{{ route('admin.transaction.income.index') }}">
                            @lang('menus.backend.sidebar.incomes')
                        </a>
                    </li>
                    @endcan

                    @can('caja chica')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/transaction/small*'))
                        }}" href="{{ route('admin.transaction.small.index') }}">
                            @lang('menus.backend.sidebar.small_box')
                        </a>
                    </li>
                    @endcan

                    @can('corte de caja')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/transaction/cash*'))
                        }}" href="{{ route('admin.transaction.cash.index') }}">
                            @lang('menus.backend.sidebar.cash_out')
                        </a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="">&nbsp;
                        </a>
                    </li>
               </ul>
            </li>
            @endcanany


            @canany(['configuraciones generales', 'instituciones', 'reglamento', 'metodos de pago'])
            <li class="nav-item nav-dropdown {{
                active_class(Active::checkUriPattern('admin/setting*'), 'open')
            }}">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Active::checkUriPattern('admin/setting*'))
                }}" href="#">
                    <i class="nav-icon fa fa-cogs"> </i>
                    @lang('menus.backend.sidebar.settings')
                </a>

                <ul class="nav-dropdown-items">

                    @can('metodos de pago')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/setting/method*'))
                        }}" href="{{ route('admin.setting.method.index') }}">
                            @lang('menus.backend.sidebar.payments_methods')
                        </a>
                    </li>
                    @endcan

                    @can('configuraciones generales')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/setting/general'))
                        }}" href="{{ route('admin.setting.general.index') }}">
                            @lang('menus.backend.sidebar.general')
                        </a>
                    </li>
                    @endcan
                    @can('instituciones')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/setting/school*'))
                        }}" href="{{ route('admin.setting.school.index') }}">
                            @lang('menus.backend.sidebar.schools')
                        </a>
                    </li>
                    @endcan
                    @can('reglamento')
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/setting/regulation'))
                        }}" href="{{ route('admin.setting.regulation.index') }}">
                            @lang('menus.backend.sidebar.regulation')
                        </a>
                    </li>
                    @endcan

                    <li class="nav-item">
                        <a class="">&nbsp;
                        </a>
                    </li>

               </ul>
            </li>
            @endcanany


        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
