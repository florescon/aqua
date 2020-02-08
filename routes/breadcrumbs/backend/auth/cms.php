<?php

Breadcrumbs::for('admin.cms.support.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.cms_support.management'), route('admin.cms.support.index'));
});

Breadcrumbs::for('admin.cms.support.edit', function ($trail, $id) {
    $trail->parent('admin.cms.support.index');
    $trail->push(__('labels.backend.access.cms_support.edit'), route('admin.cms.support.edit', $id));
});

Breadcrumbs::for('admin.cms.gallery.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.cms_gallery.management'), route('admin.cms.gallery.index'));
});

Breadcrumbs::for('admin.cms.staff.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.cms_staff.management'), route('admin.cms.staff.index'));
});

Breadcrumbs::for('admin.cms.pages.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.cms_page.management'), route('admin.cms.pages.index'));
});

Breadcrumbs::for('admin.cms.pages.edit', function ($trail, $id) {
    $trail->parent('admin.cms.pages.index');
    $trail->push(__('labels.backend.access.cms_page.edit'), route('admin.cms.pages.edit', $id));
});

Breadcrumbs::for('admin.cms.schedule.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.cms_schedule.management'), route('admin.cms.schedule.index'));
});
