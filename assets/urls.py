from django.urls import path

import assets
from . import views

urlpatterns = [
    path('', assets.views.index, name='assets_list'),
    path('view/<int:asset_id>', assets.views.view, name='assets_view'),
    path('describe/<int:asset_id>/ai', assets.views.generate_ai_attributes, name='assets_describe'),
    path('create/', assets.views.create, name='assets_create'),
    path('delete/<int:asset_id>/', assets.views.delete, name='assets_delete'),
]