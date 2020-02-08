<?php

Breadcrumbs::for('admin.class.type.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.type.management'), route('admin.class.type.index'));
});

Breadcrumbs::for('admin.class.section.index', function ($trail) {
    $trail->parent('admin.class.type.index');
    $trail->push(__('labels.backend.access.section.management'), route('admin.class.section.index'));
});

Breadcrumbs::for('admin.class.class.index', function ($trail) {
    $trail->parent('admin.class.type.index');
    $trail->push(__('labels.backend.access.class.management'), route('admin.class.class.index'));
});

Breadcrumbs::for('admin.class.tag.index', function ($trail) {
    $trail->parent('admin.class.type.index');
    $trail->push(__('labels.backend.access.tag.management'), route('admin.class.tag.index'));
});
