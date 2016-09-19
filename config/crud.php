<?php

return [

    'model_path' => app_path('Models'),
    'model_template' => app_path('templates/crud/model.txt'),

    'controller_path' => app_path('Http/Controllers/Backend'),
    'controller_template' => app_path('templates/crud/controller.txt'),

    'repository_path' => app_path('Repositories/Backend'),
    'repository_template' => app_path('templates/crud/repository.txt'),
    'repository_contract_template' => app_path('templates/crud/contract.txt'),

    'view_path' => resource_path('views/backend'),
    'view_index_template' => app_path('templates/crud/view_index.txt'),
    'view_show_template' => app_path('templates/crud/view_show.txt'),
    'view_create_template' => app_path('templates/crud/view_create.txt'),
    'view_edit_template' => app_path('templates/crud/view_edit.txt'),
    'view_form_template' => app_path('templates/crud/view_form.txt'),

    'request_path' => app_path('Http/Requests/Backend'),
    'request_manage_template' => app_path('templates/crud/request_manage.txt'),
    'request_store_template' => app_path('templates/crud/request_store.txt'),
    'request_update_template' => app_path('templates/crud/request_update.txt')

];
