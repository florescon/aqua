<?php

Breadcrumbs::for('admin.setting.general.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.setting.management'), route('admin.setting.general.index'));
});

Breadcrumbs::for('admin.setting.school.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.school.management'), route('admin.setting.school.index'));
});

Breadcrumbs::for('admin.setting.regulation.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.regulation.management'), route('admin.setting.regulation.index'));
});

Breadcrumbs::for('admin.setting.regulation.create', function ($trail) {
    $trail->parent('admin.setting.regulation.index');
    $trail->push(__('labels.backend.access.regulation.create'), route('admin.setting.regulation.create'));
});

Breadcrumbs::for('admin.setting.method.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.method.management'), route('admin.setting.method.index'));
});

Breadcrumbs::for('admin.setting.method.show', function ($trail, $id) {
    $trail->parent('admin.setting.method.index');
    $trail->push(__('labels.backend.access.method.history'), route('admin.setting.method.show', $id));
});
